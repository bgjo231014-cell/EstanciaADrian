<?php

require_once "config/database.php";

class SancionModel {

    private $conn;

    public function __construct() {

        $database = new Database();
        $this->conn = $database->connect();
    }

    public function buscarPorMatricula($matricula) {

        $sql = "SELECT * FROM sanciones
                WHERE matricula = ?
                ORDER BY fecha_incidencia DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $matricula);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_all(MYSQLI_ASSOC);
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
}