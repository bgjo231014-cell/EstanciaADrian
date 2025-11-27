<?php

class ElectricidadModel
{
    /**
     * @var mysqli
     */
    private $conn;

    // Constructor: recibe la conexión creada en index.php
    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    /* =====================================================
        1️⃣ OBTENER TODOS LOS REGISTROS
    ===================================================== */
    public function obtenerRegistros()
    {
        $sql = "SELECT * FROM electricidad ORDER BY mes_elec DESC";

        $result = $this->conn->query($sql);
        if (!$result) {
            error_log("Error al obtener registros de electricidad: " . $this->conn->error);
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* =====================================================
        2️⃣ AGREGAR REGISTRO
    ===================================================== */
    public function agregarRegistro($data)
    {
        $sql = "INSERT INTO electricidad 
                (mes_elec, cons_kw_mes_elec, costo_elec, cons_percap_elec, 
                 ener_sud1_elec, ener_sl172_elec, ener_scid_elec)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Error en prepare() INSERT electricidad: " . $this->conn->error);
            return false;
        }

        $mes = trim($data['mes_elec'] ?? '');
        if (empty($mes) || !strtotime($mes)) {
            return false;
        }

        $cons_kw_mes_elec = (float)($data['cons_kw_mes_elec'] ?? 0);
        $costo_elec       = (float)($data['costo_elec'] ?? 0);
        $cons_percap_elec = (float)($data['cons_percap_elec'] ?? 0);
        $ener_sud1_elec   = (float)($data['ener_sud1_elec'] ?? 0);
        $ener_sl172_elec  = (float)($data['ener_sl172_elec'] ?? 0);
        $ener_scid_elec   = (float)($data['ener_scid_elec'] ?? 0);

        $stmt->bind_param(
            "sdddddd",
            $mes,
            $cons_kw_mes_elec,
            $costo_elec,
            $cons_percap_elec,
            $ener_sud1_elec,
            $ener_sl172_elec,
            $ener_scid_elec
        );

        if (!$stmt->execute()) {
            error_log("Error al ejecutar INSERT electricidad: " . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    /* =====================================================
        3️⃣ ACTUALIZAR REGISTRO
    ===================================================== */
    public function actualizarRegistro($data)
    {
        $sql = "UPDATE electricidad SET 
                    mes_elec = ?, 
                    cons_kw_mes_elec = ?, 
                    costo_elec = ?, 
                    cons_percap_elec = ?, 
                    ener_sud1_elec = ?, 
                    ener_sl172_elec = ?, 
                    ener_scid_elec = ?
                WHERE id_elec = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Error en prepare() UPDATE electricidad: " . $this->conn->error);
            return false;
        }

        $id = (int)($data['id_elec'] ?? 0);
        if ($id <= 0) {
            return false;
        }

        $mes = trim($data['mes_elec'] ?? '');
        if (empty($mes) || !strtotime($mes)) {
            return false;
        }

        $cons_kw_mes_elec = (float)($data['cons_kw_mes_elec'] ?? 0);
        $costo_elec       = (float)($data['costo_elec'] ?? 0);
        $cons_percap_elec = (float)($data['cons_percap_elec'] ?? 0);
        $ener_sud1_elec   = (float)($data['ener_sud1_elec'] ?? 0);
        $ener_sl172_elec  = (float)($data['ener_sl172_elec'] ?? 0);
        $ener_scid_elec   = (float)($data['ener_scid_elec'] ?? 0);

        $stmt->bind_param(
            "sddddddi",
            $mes,
            $cons_kw_mes_elec,
            $costo_elec,
            $cons_percap_elec,
            $ener_sud1_elec,
            $ener_sl172_elec,
            $ener_scid_elec,
            $id
        );

        if (!$stmt->execute()) {
            error_log("Error al ejecutar UPDATE electricidad: " . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    /* =====================================================
        4️⃣ ELIMINAR REGISTRO
    ===================================================== */
    public function eliminarRegistro($id)
    {
        $id = (int)$id;
        if ($id <= 0) {
            return false;
        }

        $stmt = $this->conn->prepare("DELETE FROM electricidad WHERE id_elec = ?");
        if (!$stmt) {
            error_log("Error en prepare() DELETE electricidad: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            error_log("Error al ejecutar DELETE electricidad: " . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    /* =====================================================
        5️⃣ OBTENER UN REGISTRO POR ID (opcional)
    ===================================================== */
    public function obtenerRegistroPorId($id)
    {
        $id = (int)$id;
        if ($id <= 0) {
            return null;
        }

        $stmt = $this->conn->prepare("SELECT * FROM electricidad WHERE id_elec = ?");
        if (!$stmt) {
            error_log("Error en prepare() SELECT por ID electricidad: " . $this->conn->error);
            return null;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result  = $stmt->get_result();
        $registro = $result->fetch_assoc();
        $stmt->close();

        return $registro ?: null;
    }
}
