<?php
class ReportesModel {
    private $db;

    public function __construct($connection) {
        $this->db = $connection;
    }

    // =============================
    // REPORTE COMBUSTIBLES
    // =============================
    public function reporteCombustibles() {
        $sql = "SELECT 
                    YEAR(CONCAT(mes,'-01')) AS anio,
                    tipo_combustible,
                    SUM(litros_combustible_mes) AS litros,
                    SUM(co2_generado) AS co2,
                    SUM(costos) AS costos
                FROM combustibles
                GROUP BY anio, tipo_combustible
                ORDER BY anio DESC";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function reporteCombustiblesPorAnio($anio) {
        $sql = "SELECT 
                    YEAR(CONCAT(mes,'-01')) AS anio,
                    tipo_combustible,
                    SUM(litros_combustible_mes) AS litros,
                    SUM(co2_generado) AS co2,
                    SUM(costos) AS costos
                FROM combustibles
                WHERE YEAR(CONCAT(mes,'-01')) = ?
                GROUP BY anio, tipo_combustible
                ORDER BY anio DESC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return [];

        $stmt->bind_param("i", $anio);
        $stmt->execute();

        $res = $stmt->get_result();
        $datos = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

        $stmt->close();
        return $datos;
    }

    public function totalCO2Combustibles() {
        $sql = "SELECT SUM(co2_generado) AS total_co2 FROM combustibles";

        $res = $this->db->query($sql);
        if (!$res) return 0;

        $row = $res->fetch_assoc();
        return (float)($row['total_co2'] ?? 0);
    }

    public function totalCO2CombustiblesPorAnio($anio) {
        $sql = "SELECT SUM(co2_generado) AS total_co2
                FROM combustibles
                WHERE YEAR(CONCAT(mes,'-01')) = ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return 0;

        $stmt->bind_param("i", $anio);
        $stmt->execute();

        $res = $stmt->get_result();
        $row = $res ? $res->fetch_assoc() : null;

        $stmt->close();
        return (float)($row['total_co2'] ?? 0);
    }

    // =============================
    // REPORTE RSU / RME
    // =============================
    public function reporteRSU() {
        $sql = "SELECT 
                    YEAR(mes) AS anio,
                    SUM(total_registro) AS total_kg,
                    SUM(tn_cuatrimestre) AS total_tn
                FROM rsu
                GROUP BY anio
                ORDER BY anio DESC";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function reporteRSUPorAnio($anio) {
        $sql = "SELECT 
                    YEAR(mes) AS anio,
                    SUM(total_registro) AS total_kg,
                    SUM(tn_cuatrimestre) AS total_tn
                FROM rsu
                WHERE YEAR(mes) = ?
                GROUP BY anio
                ORDER BY anio DESC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return [];

        $stmt->bind_param("i", $anio);
        $stmt->execute();

        $res = $stmt->get_result();
        $datos = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

        $stmt->close();
        return $datos;
    }

    // =============================
    // REPORTE COMUNIDAD
    // =============================
    public function reporteComunidad() {
        $sql = "SELECT 
                    año AS anio,
                    COUNT(*) AS total_registros,
                    SUM(total_personal) AS total_personal,
                    AVG(promedio) AS promedio_personal
                FROM comunidad
                GROUP BY año
                ORDER BY año DESC";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function reporteComunidadPorAnio($anio) {
        $sql = "SELECT 
                    año AS anio,
                    COUNT(*) AS total_registros,
                    SUM(total_personal) AS total_personal,
                    AVG(promedio) AS promedio_personal
                FROM comunidad
                WHERE año = ?
                GROUP BY año
                ORDER BY año DESC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return [];

        $stmt->bind_param("i", $anio);
        $stmt->execute();

        $res = $stmt->get_result();
        $datos = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

        $stmt->close();
        return $datos;
    }

    // =============================
    // REPORTE AGUA
    // =============================
    public function reporteAgua() {
        $sql = "SELECT 
                    YEAR(mes) AS anio,
                    SUM(metros_cubicos) AS total_m3,
                    SUM(costo) AS total_costo
                FROM consumo_agua
                GROUP BY anio
                ORDER BY anio DESC";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function reporteAguaPorAnio($anio) {
        $sql = "SELECT 
                    YEAR(mes) AS anio,
                    SUM(metros_cubicos) AS total_m3,
                    SUM(costo) AS total_costo
                FROM consumo_agua
                WHERE YEAR(mes) = ?
                GROUP BY anio
                ORDER BY anio DESC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return [];

        $stmt->bind_param("i", $anio);
        $stmt->execute();

        $res = $stmt->get_result();
        $datos = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

        $stmt->close();
        return $datos;
    }

    // =============================
    // REPORTE ELECTRICIDAD
    // =============================
    public function reporteElectricidad() {
        $sql = "SELECT 
                    YEAR(mes_elec) AS anio,
                    SUM(cons_kw_mes_elec) AS total_kw,
                    SUM(costo_elec) AS total_costo
                FROM electricidad
                GROUP BY anio
                ORDER BY anio DESC";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function reporteElectricidadPorAnio($anio) {
        $sql = "SELECT 
                    YEAR(mes_elec) AS anio,
                    SUM(cons_kw_mes_elec) AS total_kw,
                    SUM(costo_elec) AS total_costo
                FROM electricidad
                WHERE YEAR(mes_elec) = ?
                GROUP BY anio
                ORDER BY anio DESC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return [];

        $stmt->bind_param("i", $anio);
        $stmt->execute();

        $res = $stmt->get_result();
        $datos = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

        $stmt->close();
        return $datos;
    }

    // =============================
    // REPORTE CAPACITACIÓN
    // =============================
    public function reporteCapacitacion() {
        $sql = "SELECT 
                    año AS anio,
                    COUNT(*) AS total_registros,
                    SUM(cantidad_total_capa) AS total_capacitados,
                    SUM(total_verdadero_final) AS total_verdadero,
                    SUM(cantidad_hombres) AS hombres,
                    SUM(cantidad_mujeres) AS mujeres,
                    CASE 
                        WHEN SUM(cantidad_hombres + cantidad_mujeres) > 0 
                        THEN (SUM(cantidad_hombres) / SUM(cantidad_hombres + cantidad_mujeres)) * 100
                        ELSE 0
                    END AS porcentaje_hombres,
                    CASE 
                        WHEN SUM(cantidad_hombres + cantidad_mujeres) > 0 
                        THEN (SUM(cantidad_mujeres) / SUM(cantidad_hombres + cantidad_mujeres)) * 100
                        ELSE 0
                    END AS porcentaje_mujeres
                FROM capacitacion
                GROUP BY año
                ORDER BY año DESC";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function reporteCapacitacionPorAnio($anio) {
        $sql = "SELECT 
                    año AS anio,
                    COUNT(*) AS total_registros,
                    SUM(cantidad_total_capa) AS total_capacitados,
                    SUM(total_verdadero_final) AS total_verdadero,
                    SUM(cantidad_hombres) AS hombres,
                    SUM(cantidad_mujeres) AS mujeres,
                    CASE 
                        WHEN SUM(cantidad_hombres + cantidad_mujeres) > 0 
                        THEN (SUM(cantidad_hombres) / SUM(cantidad_hombres + cantidad_mujeres)) * 100
                        ELSE 0
                    END AS porcentaje_hombres,
                    CASE 
                        WHEN SUM(cantidad_hombres + cantidad_mujeres) > 0 
                        THEN (SUM(cantidad_mujeres) / SUM(cantidad_hombres + cantidad_mujeres)) * 100
                        ELSE 0
                    END AS porcentaje_mujeres
                FROM capacitacion
                WHERE año = ?
                GROUP BY año
                ORDER BY año DESC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return [];

        $stmt->bind_param("i", $anio);
        $stmt->execute();

        $res = $stmt->get_result();
        $datos = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

        $stmt->close();
        return $datos;
    }

    // =============================
    // REPORTE GENERAL MENSUAL
    // Sirve para:
    // - Filtro por año
    // - Filtro por mes
    // - Resumen por mes
    // - Resumen por año
    // - Resumen por cuatrimestre
    // =============================
    public function reporteGeneralMensual($anio = null, $mes = null) {

        $where = "";

        if (!empty($anio)) {
            $where .= " WHERE anio = " . (int)$anio;
        }

        if (!empty($mes)) {
            $where .= empty($where)
                ? " WHERE mes_num = " . (int)$mes
                : " AND mes_num = " . (int)$mes;
        }

        $sql = "
            SELECT * FROM (

                SELECT 
                    YEAR(CONCAT(mes,'-01')) AS anio,
                    MONTH(CONCAT(mes,'-01')) AS mes_num,
                    'Combustibles CO2' AS indicador,
                    SUM(co2_generado) AS total,
                    'kg CO2' AS unidad
                FROM combustibles
                GROUP BY anio, mes_num

                UNION ALL

                SELECT
                    YEAR(mes) AS anio,
                    MONTH(mes) AS mes_num,
                    'RSU / RME' AS indicador,
                    SUM(total_registro) AS total,
                    'kg' AS unidad
                FROM rsu
                GROUP BY anio, mes_num

                UNION ALL

                SELECT
                    YEAR(mes) AS anio,
                    MONTH(mes) AS mes_num,
                    'Agua' AS indicador,
                    SUM(metros_cubicos) AS total,
                    'm3' AS unidad
                FROM consumo_agua
                GROUP BY anio, mes_num

                UNION ALL

                SELECT
                    YEAR(mes_elec) AS anio,
                    MONTH(mes_elec) AS mes_num,
                    'Electricidad' AS indicador,
                    SUM(cons_kw_mes_elec) AS total,
                    'kW' AS unidad
                FROM electricidad
                GROUP BY anio, mes_num

                UNION ALL

                SELECT
                    año AS anio,
                    CASE LOWER(mes)
                        WHEN 'enero' THEN 1
                        WHEN 'febrero' THEN 2
                        WHEN 'marzo' THEN 3
                        WHEN 'abril' THEN 4
                        WHEN 'mayo' THEN 5
                        WHEN 'junio' THEN 6
                        WHEN 'julio' THEN 7
                        WHEN 'agosto' THEN 8
                        WHEN 'septiembre' THEN 9
                        WHEN 'setiembre' THEN 9
                        WHEN 'octubre' THEN 10
                        WHEN 'noviembre' THEN 11
                        WHEN 'diciembre' THEN 12
                        ELSE 0
                    END AS mes_num,
                    'Comunidad' AS indicador,
                    SUM(total_personal) AS total,
                    'personas' AS unidad
                FROM comunidad
                GROUP BY anio, mes_num

                UNION ALL

                SELECT
                    año AS anio,
                    CASE LOWER(mes)
                        WHEN 'enero' THEN 1
                        WHEN 'febrero' THEN 2
                        WHEN 'marzo' THEN 3
                        WHEN 'abril' THEN 4
                        WHEN 'mayo' THEN 5
                        WHEN 'junio' THEN 6
                        WHEN 'julio' THEN 7
                        WHEN 'agosto' THEN 8
                        WHEN 'septiembre' THEN 9
                        WHEN 'setiembre' THEN 9
                        WHEN 'octubre' THEN 10
                        WHEN 'noviembre' THEN 11
                        WHEN 'diciembre' THEN 12
                        ELSE 0
                    END AS mes_num,
                    'Capacitacion' AS indicador,
                    SUM(cantidad_total_capa) AS total,
                    'personas' AS unidad
                FROM capacitacion
                GROUP BY anio, mes_num

            ) AS reporte

            $where

            ORDER BY anio DESC, mes_num DESC, indicador ASC
        ";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    // =============================
    // AÑOS DISPONIBLES PARA FILTRO
    // =============================
    public function getAniosDisponibles() {
        $years = [];

        // Combustibles
        $sql = "SELECT DISTINCT YEAR(CONCAT(mes,'-01')) AS anio FROM combustibles";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) {
                    $years[] = (int)$row['anio'];
                }
            }
        }

        // RSU
        $sql = "SELECT DISTINCT YEAR(mes) AS anio FROM rsu";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) {
                    $years[] = (int)$row['anio'];
                }
            }
        }

        // Agua
        $sql = "SELECT DISTINCT YEAR(mes) AS anio FROM consumo_agua";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) {
                    $years[] = (int)$row['anio'];
                }
            }
        }

        // Electricidad
        $sql = "SELECT DISTINCT YEAR(mes_elec) AS anio FROM electricidad";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) {
                    $years[] = (int)$row['anio'];
                }
            }
        }

        // Comunidad
        $sql = "SELECT DISTINCT año AS anio FROM comunidad";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) {
                    $years[] = (int)$row['anio'];
                }
            }
        }

        // Capacitación
        $sql = "SELECT DISTINCT año AS anio FROM capacitacion";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) {
                    $years[] = (int)$row['anio'];
                }
            }
        }

        $years = array_values(array_unique($years));
        rsort($years);

        return $years;
    }
}
?>