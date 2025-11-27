<?php
// app/models/AguaModel.php

class AguaModel
{
    /**
     * @var mysqli
     */
    private $conn;

    public function __construct($connection)
    {
        // Usamos SIEMPRE la conexión que viene de index.php (Database::connect)
        $this->conn = $connection;
    }

    /* =====================================================
        OBTENER DATOS DE AMBAS TABLAS
    ===================================================== */
    public function obtenerDatos()
    {
        $registros = $this->conn->query(
            "SELECT * FROM registro_agua ORDER BY periodo_mensual DESC"
        );
        $consumos = $this->conn->query(
            "SELECT * FROM consumo_agua ORDER BY mes DESC"
        );

        return [
            'registros_agua' => $registros ? $registros->fetch_all(MYSQLI_ASSOC) : [],
            'consumos_agua'  => $consumos ? $consumos->fetch_all(MYSQLI_ASSOC) : []
        ];
    }

    /* =====================================================
        REGISTRO DE AGUA (registro_agua)
    ===================================================== */

    public function crearRegistro($data)
    {
        $v = fn($k) => (float)($data[$k] ?? 0);
        $periodo = trim($data['periodo_mensual'] ?? '');

        if (empty($periodo) || !strtotime($periodo)) {
            return false;
        }

        $sql = "INSERT INTO registro_agua
                (periodo_mensual, metros_cubicos_descargados, dbo_mg_l, sst_mg_l, nt_mg_l, percapita)
                VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($sql)) {
            $mc   = $v('metros_cubicos_descargados');
            $dbo  = $v('dbo_mg_l');
            $sst  = $v('sst_mg_l');
            $nt   = $v('nt_mg_l');
            $perc = $v('percapita');

            $stmt->bind_param("sddddd", $periodo, $mc, $dbo, $sst, $nt, $perc);
            $stmt->execute();
            $stmt->close();
        }

        $this->actualizarTotalesRegistro();
        return true;
    }

    public function editarRegistro($data)
    {
        $v = fn($k) => (float)($data[$k] ?? 0);
        $id = (int)($data['id'] ?? 0);
        $periodo = trim($data['periodo_mensual'] ?? '');

        if ($id <= 0 || empty($periodo) || !strtotime($periodo)) {
            return false;
        }

        $sql = "UPDATE registro_agua SET
                    periodo_mensual = ?,
                    metros_cubicos_descargados = ?,
                    dbo_mg_l = ?,
                    sst_mg_l = ?,
                    nt_mg_l = ?,
                    percapita = ?
                WHERE id = ?";

        if ($stmt = $this->conn->prepare($sql)) {
            $mc   = $v('metros_cubicos_descargados');
            $dbo  = $v('dbo_mg_l');
            $sst  = $v('sst_mg_l');
            $nt   = $v('nt_mg_l');
            $perc = $v('percapita');

            $stmt->bind_param("sdddddi", $periodo, $mc, $dbo, $sst, $nt, $perc, $id);
            $stmt->execute();
            $stmt->close();
        }

        $this->actualizarTotalesRegistro();
        return true;
    }

    public function eliminarRegistro($id)
    {
        $id = (int)$id;
        if ($id <= 0) {
            return false;
        }

        $sql = "DELETE FROM registro_agua WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        $this->actualizarTotalesRegistro();
        return true;
    }

    /* =====================================================
        CONSUMO DE AGUA (consumo_agua)
    ===================================================== */

    public function crearConsumo($data)
    {
        $v = fn($k) => (float)($data[$k] ?? 0);

        // Si viene un mes desde el formulario, lo intentamos usar
        $mesForm = trim($data['mes'] ?? '');

        $mes = null;

        if (!empty($mesForm) && strtotime($mesForm)) {
            $mesNorm = date('Y-m-d', strtotime($mesForm));

            // Verificamos que exista en registro_agua (por la FK)
            if ($stmt = $this->conn->prepare("SELECT 1 FROM registro_agua WHERE periodo_mensual = ?")) {
                $stmt->bind_param("s", $mesNorm);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $mes = $mesNorm;
                }
                $stmt->close();
            }
        }

        // Si no se pudo usar el mes del formulario, tomamos el último periodo registrado
        if ($mes === null) {
            $res = $this->conn->query("SELECT periodo_mensual FROM registro_agua ORDER BY periodo_mensual DESC LIMIT 1");
            if (!$res || $res->num_rows === 0) {
                return false; // no hay registro_agua asociado
            }
            $row = $res->fetch_assoc();
            $mes = $row['periodo_mensual'];
        }

        $sql = "INSERT INTO consumo_agua
                (mes, metros_cubicos, costo, percapita, consumo_agua_riego)
                VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($sql)) {
            $mc     = $v('metros_cubicos');
            $costo  = $v('costo');
            $perc   = $v('percapita');
            // Aquí puedes ajustar la fórmula; por ahora tomamos todo como riego
            $riego  = max(0, $mc);

            $stmt->bind_param("sdddd", $mes, $mc, $costo, $perc, $riego);
            $stmt->execute();
            $stmt->close();
        }

        $this->actualizarTotalesConsumo();
        return true;
    }

    public function editarConsumo($data)
    {
        $v  = fn($k) => (float)($data[$k] ?? 0);
        $id = (int)($data['id'] ?? 0);

        if ($id <= 0) {
            return false;
        }

        // Obtenemos el mes actual (para no romper la FK si el usuario cambia algo raro)
        $mes = null;
        if ($stmt = $this->conn->prepare("SELECT mes FROM consumo_agua WHERE id = ?")) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($mes);
            $stmt->fetch();
            $stmt->close();
        }

        if (!$mes) {
            return false;
        }

        // Intentamos actualizar mes si viene uno nuevo Y existe en registro_agua
        $mesForm = trim($data['mes'] ?? '');
        if (!empty($mesForm) && strtotime($mesForm)) {
            $mesNorm = date('Y-m-d', strtotime($mesForm));
            if ($stmt = $this->conn->prepare("SELECT 1 FROM registro_agua WHERE periodo_mensual = ?")) {
                $stmt->bind_param("s", $mesNorm);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $mes = $mesNorm;
                }
                $stmt->close();
            }
        }

        $sql = "UPDATE consumo_agua SET
                    mes = ?,
                    metros_cubicos = ?,
                    costo = ?,
                    percapita = ?,
                    consumo_agua_riego = ?
                WHERE id = ?";

        if ($stmt = $this->conn->prepare($sql)) {
            $mc     = $v('metros_cubicos');
            $costo  = $v('costo');
            $perc   = $v('percapita');
            $riego  = max(0, $mc);

            $stmt->bind_param("sddddi", $mes, $mc, $costo, $perc, $riego, $id);
            $stmt->execute();
            $stmt->close();
        }

        $this->actualizarTotalesConsumo();
        return true;
    }

    public function eliminarConsumo($id)
    {
        $id = (int)$id;
        if ($id <= 0) {
            return false;
        }

        $sql = "DELETE FROM consumo_agua WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        $this->actualizarTotalesConsumo();
        return true;
    }

    /* =====================================================
        TOTALES REGISTRO (registro_agua)
    ===================================================== */
    private function actualizarTotalesRegistro()
    {
        $resultado = $this->conn->query("SELECT id, periodo_mensual, metros_cubicos_descargados FROM registro_agua");
        if (!$resultado) {
            return;
        }

        $filas = $resultado->fetch_all(MYSQLI_ASSOC);
        if (empty($filas)) {
            return;
        }

        $totalesAnuales   = []; // [año] => suma m3
        $totalesCuatrimes = []; // ["año-cuatri"] => suma m3

        foreach ($filas as $row) {
            $date = $row['periodo_mensual'];
            $mc   = (float)$row['metros_cubicos_descargados'];

            $time = strtotime($date);
            if (!$time) continue;

            $year  = (int)date('Y', $time);
            $month = (int)date('m', $time);

            if ($month >= 1 && $month <= 4)       $cuatri = 1;
            elseif ($month >= 5 && $month <= 8)   $cuatri = 2;
            else                                  $cuatri = 3;

            $keyYear   = $year;
            $keyCuatri = $year . '-' . $cuatri;

            if (!isset($totalesAnuales[$keyYear]))   $totalesAnuales[$keyYear]   = 0.0;
            if (!isset($totalesCuatrimes[$keyCuatri])) $totalesCuatrimes[$keyCuatri] = 0.0;

            $totalesAnuales[$keyYear]   += $mc;
            $totalesCuatrimes[$keyCuatri] += $mc;
        }

        foreach ($filas as $row) {
            $id   = (int)$row['id'];
            $date = $row['periodo_mensual'];

            $time = strtotime($date);
            if (!$time) continue;

            $year  = (int)date('Y', $time);
            $month = (int)date('m', $time);

            if ($month >= 1 && $month <= 4)       $cuatri = 1;
            elseif ($month >= 5 && $month <= 8)   $cuatri = 2;
            else                                  $cuatri = 3;

            $keyYear   = $year;
            $keyCuatri = $year . '-' . $cuatri;

            $totalAnual   = $totalesAnuales[$keyYear]   ?? 0.0;
            $totalCuatri  = $totalesCuatrimes[$keyCuatri] ?? 0.0;

            if ($stmt = $this->conn->prepare("
                UPDATE registro_agua
                SET total_cuatri = ?, total_metros_cubicos_descargados = ?
                WHERE id = ?
            ")) {
                $stmt->bind_param("ddi", $totalCuatri, $totalAnual, $id);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    /* =====================================================
        TOTALES CONSUMO (consumo_agua)
    ===================================================== */
    private function actualizarTotalesConsumo()
    {
        $resultado = $this->conn->query("SELECT id, mes, metros_cubicos, costo FROM consumo_agua");
        if (!$resultado) {
            return;
        }

        $filas = $resultado->fetch_all(MYSQLI_ASSOC);
        if (empty($filas)) {
            return;
        }

        $totalesAnualesMc   = []; // [año] => suma m3
        $totalesAnualesCost = []; // [año] => suma costo
        $totalesCuatriMc    = []; // ["año-cuatri"] => suma m3

        foreach ($filas as $row) {
            $date  = $row['mes'];
            $mc    = (float)$row['metros_cubicos'];
            $costo = (float)$row['costo'];

            $time = strtotime($date);
            if (!$time) continue;

            $year  = (int)date('Y', $time);
            $month = (int)date('m', $time);

            if ($month >= 1 && $month <= 4)       $cuatri = 1;
            elseif ($month >= 5 && $month <= 8)   $cuatri = 2;
            else                                  $cuatri = 3;

            $keyYear   = $year;
            $keyCuatri = $year . '-' . $cuatri;

            if (!isset($totalesAnualesMc[$keyYear]))   $totalesAnualesMc[$keyYear]   = 0.0;
            if (!isset($totalesAnualesCost[$keyYear])) $totalesAnualesCost[$keyYear] = 0.0;
            if (!isset($totalesCuatriMc[$keyCuatri]))  $totalesCuatriMc[$keyCuatri]  = 0.0;

            $totalesAnualesMc[$keyYear]   += $mc;
            $totalesAnualesCost[$keyYear] += $costo;
            $totalesCuatriMc[$keyCuatri]  += $mc;
        }

        foreach ($filas as $row) {
            $id   = (int)$row['id'];
            $date = $row['mes'];

            $time = strtotime($date);
            if (!$time) continue;

            $year  = (int)date('Y', $time);
            $month = (int)date('m', $time);

            if ($month >= 1 && $month <= 4)       $cuatri = 1;
            elseif ($month >= 5 && $month <= 8)   $cuatri = 2;
            else                                  $cuatri = 3;

            $keyYear   = $year;
            $keyCuatri = $year . '-' . $cuatri;

            $totalMcAnual   = $totalesAnualesMc[$keyYear]   ?? 0.0;
            $totalCostAnual = $totalesAnualesCost[$keyYear] ?? 0.0;
            $totalMcCuatri  = $totalesCuatriMc[$keyCuatri]  ?? 0.0;

            if ($stmt = $this->conn->prepare("
                UPDATE consumo_agua
                SET cuatrimestral = ?, total_metros_cubicos = ?, total_costo = ?
                WHERE id = ?
            ")) {
                $stmt->bind_param("dddi", $totalMcCuatri, $totalMcAnual, $totalCostAnual, $id);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
}
