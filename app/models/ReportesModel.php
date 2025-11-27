<?php
class ReportesModel {
    private $db;
    public function __construct($connection) {
        $this->db = $connection;
    }
    // =============================
    // REPORTE COMBUSTIBLES (global)
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
    // Combustibles por año
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
    // Total CO2 combustibles (global)
    public function totalCO2Combustibles() {
        $sql = "SELECT SUM(co2_generado) AS total_co2 FROM combustibles";
        $res = $this->db->query($sql);
        if (!$res) return 0;
        $row = $res->fetch_assoc();
        return (float)($row['total_co2'] ?? 0);
    }
    // Total CO2 combustibles POR año
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
    // REPORTE RSU
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
        $sql = "SELECT año,
                       AVG(promedio) AS promedio_personal,
                       SUM(total_personal_1 + total_personal_2 + total_personal_3) AS total_personal
                FROM comunidad
                GROUP BY año
                ORDER BY año DESC";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function reporteComunidadPorAnio($anio) {
        $sql = "SELECT año,
                       AVG(promedio) AS promedio_personal,
                       SUM(total_personal_1 + total_personal_2 + total_personal_3) AS total_personal
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
                    año,
                    SUM(Calculo_total_verdadero1 + Calculo_total_verdadero2 + Calculo_total_verdadero3)
                        AS total_capacitados,
                    SUM(cantidad_hombres) AS hombres,
                    SUM(cantidad_mujeres) AS mujeres
                FROM capacitacion
                GROUP BY año
                ORDER BY año DESC";

        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function reporteCapacitacionPorAnio($anio) {
        $sql = "SELECT 
                    año,
                    SUM(Calculo_total_verdadero1 + Calculo_total_verdadero2 + Calculo_total_verdadero3)
                        AS total_capacitados,
                    SUM(cantidad_hombres) AS hombres,
                    SUM(cantidad_mujeres) AS mujeres
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
    // AÑOS DISPONIBLES PARA FILTRO
    // =============================
    public function getAniosDisponibles() {
        $years = [];

        // Combustibles
        $sql = "SELECT DISTINCT YEAR(CONCAT(mes,'-01')) AS anio FROM combustibles";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) $years[] = (int)$row['anio'];
            }
        }

        // RSU
        $sql = "SELECT DISTINCT YEAR(mes) AS anio FROM rsu";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) $years[] = (int)$row['anio'];
            }
        }

        // Agua
        $sql = "SELECT DISTINCT YEAR(mes) AS anio FROM consumo_agua";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) $years[] = (int)$row['anio'];
            }
        }

        // Electricidad
        $sql = "SELECT DISTINCT YEAR(mes_elec) AS anio FROM electricidad";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) $years[] = (int)$row['anio'];
            }
        }

        // Comunidad
        $sql = "SELECT DISTINCT año AS anio FROM comunidad";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) $years[] = (int)$row['anio'];
            }
        }

        // Capacitación
        $sql = "SELECT DISTINCT año AS anio FROM capacitacion";
        if ($res = $this->db->query($sql)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['anio'])) $years[] = (int)$row['anio'];
            }
        }

        $years = array_values(array_unique($years));
        rsort($years);

        return $years;
    }
}
