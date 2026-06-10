<?php

require_once "config/database.php";

class SancionModel {

    private $conn;

public function __construct($connection = null) {
    if ($connection) {
        $this->conn = $connection;
    } else {
        $database = new Database();
        $this->conn = $database->connect();
    }
}

    public function buscarPorMatricula($matricula)
{
    $sql = "
        SELECT 
            s.*,
            COALESCE((SELECT SUM(m.horas_liberadas)
                      FROM sancion_movimientos m
                      WHERE m.id_sancion = s.id_sancion), 0) AS horas_liberadas,
            COALESCE((SELECT SUM(p.horas_agregadas)
                      FROM sancion_penalizaciones p
                      WHERE p.id_sancion = s.id_sancion), 0) AS horas_penalizacion,
            (s.horas_totales + COALESCE((SELECT SUM(p.horas_agregadas)
                      FROM sancion_penalizaciones p
                      WHERE p.id_sancion = s.id_sancion), 0)) AS horas_totales,
            ((s.horas_totales + COALESCE((SELECT SUM(p.horas_agregadas)
                      FROM sancion_penalizaciones p
                      WHERE p.id_sancion = s.id_sancion), 0))
             - COALESCE((SELECT SUM(m.horas_liberadas)
                      FROM sancion_movimientos m
                      WHERE m.id_sancion = s.id_sancion), 0)) AS horas_restantes
        FROM sanciones s
        WHERE s.matricula = ?
        ORDER BY s.fecha_incidencia DESC
    ";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        error_log("Error en buscarPorMatricula: " . $this->conn->error);
        return [];
    }

    $matricula = trim($matricula);
    $stmt->bind_param("s", $matricula);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $datos = $resultado->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $datos;
}

public function consultarPorMatricula($matricula)
{
    return $this->buscarPorMatricula($matricula);
}

    public function obtenerSanciones()
{
    $sql = "
        SELECT 
            s.*,
            COALESCE((SELECT SUM(m.horas_liberadas) 
                      FROM sancion_movimientos m 
                      WHERE m.id_sancion = s.id_sancion), 0) AS horas_liberadas,

            COALESCE((SELECT SUM(p.horas_agregadas) 
                      FROM sancion_penalizaciones p 
                      WHERE p.id_sancion = s.id_sancion), 0) AS horas_penalizacion,

            (s.horas_totales + COALESCE((SELECT SUM(p.horas_agregadas) 
                      FROM sancion_penalizaciones p 
                      WHERE p.id_sancion = s.id_sancion), 0)) AS horas_totales,

            ((s.horas_totales + COALESCE((SELECT SUM(p.horas_agregadas) 
                      FROM sancion_penalizaciones p 
                      WHERE p.id_sancion = s.id_sancion), 0))
             - COALESCE((SELECT SUM(m.horas_liberadas) 
                      FROM sancion_movimientos m 
                      WHERE m.id_sancion = s.id_sancion), 0)) AS horas_restantes

        FROM sanciones s
        ORDER BY s.fecha_creacion DESC
    ";

    $result = $this->conn->query($sql);

    if (!$result) {
        error_log("Error al obtener sanciones: " . $this->conn->error);
        return [];
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}
public function agregarSancion($data, $idAdmin = null)
{
    $sql = "INSERT INTO sanciones 
            (matricula, nombre_alumno, carrera, grupo, cuatrimestre, fecha_incidencia,
             tipo_incidencia, descripcion, horas_base, horas_totales, creado_por)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        error_log("Error en prepare agregarSancion: " . $this->conn->error);
        return false;
    }

    $matricula = trim($data['matricula'] ?? '');
    $nombre = trim($data['nombre_alumno'] ?? '');
    $carrera = trim($data['carrera'] ?? '');
    $grupo = trim($data['grupo'] ?? '');
    $cuatrimestre = trim($data['cuatrimestre'] ?? '');
    $fecha = trim($data['fecha_incidencia'] ?? '');
    $tipo = trim($data['tipo_incidencia'] ?? '');
    $descripcion = trim($data['descripcion'] ?? '');
    $horas = (float)($data['horas_base'] ?? 0);
    $admin = $idAdmin ? (int)$idAdmin : null;

    if ($matricula === '' || $nombre === '' || $fecha === '' || $tipo === '' || $horas <= 0) {
        return false;
    }

    $stmt->bind_param(
        "ssssssssddi",
        $matricula,
        $nombre,
        $carrera,
        $grupo,
        $cuatrimestre,
        $fecha,
        $tipo,
        $descripcion,
        $horas,
        $horas,
        $admin
    );

    $ok = $stmt->execute();

    if (!$ok) {
        error_log("Error al ejecutar agregarSancion: " . $stmt->error);
    }

    $stmt->close();

    return $ok;
}
public function congelarPenalizacion($idSancion, $motivo, $idAdmin = null)
{
    $idSancion = (int)$idSancion;
    $admin = $idAdmin ? (int)$idAdmin : null;

    $stmt = $this->conn->prepare("
        UPDATE sanciones 
        SET penalizacion_congelada = 1,
            estado_sancion = 'Congelado',
            motivo_congelacion = ?,
            fecha_congelacion = NOW(),
            actualizado_por = ?
        WHERE id_sancion = ?
    ");

    if (!$stmt) return false;

    $stmt->bind_param("sii", $motivo, $admin, $idSancion);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}

public function reactivarPenalizacion($idSancion, $idAdmin = null)
{
    $idSancion = (int)$idSancion;
    $admin = $idAdmin ? (int)$idAdmin : null;

    $stmt = $this->conn->prepare("
        UPDATE sanciones 
        SET penalizacion_congelada = 0,
            motivo_congelacion = NULL,
            fecha_congelacion = NULL,
            actualizado_por = ?
        WHERE id_sancion = ?
    ");

    if (!$stmt) return false;

    $stmt->bind_param("ii", $admin, $idSancion);
    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) {
        $this->actualizarEstadoSancion($idSancion);
    }

    return $ok;
}
public function registrarLiberacion($data, $idAdmin = null)
{
    $sql = "INSERT INTO sancion_movimientos
            (id_sancion, fecha_servicio, hora_entrada, hora_salida, horas_liberadas,
             actividad_realizada, observaciones, registrado_por)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);
    if (!$stmt) return false;

    $idSancion = (int)($data['id_sancion'] ?? 0);
    $fecha = trim($data['fecha_servicio'] ?? '');
    $entrada = trim($data['hora_entrada'] ?? '');
    $salida = trim($data['hora_salida'] ?? '');
    $horas = (float)($data['horas_liberadas'] ?? 0);
    $actividad = trim($data['actividad_realizada'] ?? '');
    $observaciones = trim($data['observaciones'] ?? '');
    $admin = $idAdmin ? (int)$idAdmin : null;

    if ($idSancion <= 0 || $fecha === '' || $entrada === '' || $salida === '' || $horas <= 0) {
        return false;
    }

    $stmt->bind_param("isssdssi", $idSancion, $fecha, $entrada, $salida, $horas, $actividad, $observaciones, $admin);
    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) $this->actualizarEstadoSancion($idSancion);

    return $ok;
}

public function eliminarSancion($idSancion)
{
    $idSancion = (int)$idSancion;
    if ($idSancion <= 0) return false;

    $this->conn->query("DELETE FROM sancion_movimientos WHERE id_sancion = $idSancion");
    $this->conn->query("DELETE FROM sancion_penalizaciones WHERE id_sancion = $idSancion");

    $stmt = $this->conn->prepare("DELETE FROM sanciones WHERE id_sancion = ?");
    if (!$stmt) return false;

    $stmt->bind_param("i", $idSancion);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}

public function obtenerHistorial($idSancion)
{
    $idSancion = (int)$idSancion;

    $stmt = $this->conn->prepare("
        SELECT * FROM sancion_movimientos
        WHERE id_sancion = ?
        ORDER BY fecha_servicio DESC, hora_entrada DESC
    ");

    if (!$stmt) return [];

    $stmt->bind_param("i", $idSancion);
    $stmt->execute();

    $result = $stmt->get_result();
    $datos = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $datos;
}

public function actualizarEstadoSancion($idSancion)
{
    $idSancion = (int)$idSancion;

    $sql = "
        SELECT 
            s.horas_totales,
            s.penalizacion_congelada,
            COALESCE((SELECT SUM(horas_liberadas) FROM sancion_movimientos WHERE id_sancion = s.id_sancion), 0) AS liberadas,
            COALESCE((SELECT SUM(horas_agregadas) FROM sancion_penalizaciones WHERE id_sancion = s.id_sancion), 0) AS penalizadas
        FROM sanciones s
        WHERE s.id_sancion = ?
    ";

    $stmt = $this->conn->prepare($sql);
    if (!$stmt) return false;

    $stmt->bind_param("i", $idSancion);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$data) return false;

    if ((int)$data['penalizacion_congelada'] === 1) {
        $estado = "Congelado";
    } else {
        $total = (float)$data['horas_totales'] + (float)$data['penalizadas'];
        $liberadas = (float)$data['liberadas'];

        if ($liberadas <= 0) $estado = "Pendiente";
        elseif ($liberadas < $total) $estado = "En proceso";
        else $estado = "Liberado";
    }

    $stmt = $this->conn->prepare("UPDATE sanciones SET estado_sancion = ? WHERE id_sancion = ?");
    if (!$stmt) return false;

    $stmt->bind_param("si", $estado, $idSancion);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}
}