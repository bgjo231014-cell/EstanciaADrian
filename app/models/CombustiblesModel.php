<?php

class CombustiblesModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }


    //  MÉTODO 1: obtenerRegistros()
    //  Consulta y devuelve todos los registros de la tabla 'combustibles'.
    public function obtenerRegistros() {
        $stmt = $this->conn->prepare("SELECT * FROM combustibles ORDER BY id ASC");
        if (!$stmt) {
            die("Error en prepare(): " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //  MÉTODO 2: agregarRegistro($data)
    //  Inserta un nuevo registro en la tabla 'combustibles' usando sentencias preparadas.
    public function agregarRegistro($data) {
        $sql = "INSERT INTO combustibles 
                (mes, tipo_combustible, litros_combustible_mes, litros_combustible_anio, costos, factores_emision, co2_generado)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die(" Error en prepare(): " . $this->conn->error);
        }

        // Variables con valores del formulario o controlador
        $mes                    = $data['mes'] ?? '';
        $tipo_combustible       = $data['tipo_combustible'] ?? '';
        $litros_mes             = $data['litros_combustible_mes'] ?? 0;
        $litros_anio            = $data['litros_combustible_anio'] ?? 0;
        $costos                 = $data['costos'] ?? 0;
        $factores_emision       = $data['factores_emision'] ?? 0;
        $co2_generado           = $data['co2_generado'] ?? 0;

        // Vinculación de los parámetros
        $stmt->bind_param(
            "ssddddd",
            $mes,
            $tipo_combustible,
            $litros_mes,
            $litros_anio,
            $costos,
            $factores_emision,
            $co2_generado
        );

        // Ejecución del INSERT
        if (!$stmt->execute()) {
            die(" Error al ejecutar INSERT: " . $stmt->error);
        }

        return true;
    }

    //  MÉTODO 3: actualizarRegistro($data)
    //  Permite modificar un registro existente en la tabla 'combustibles' según su ID.
    public function actualizarRegistro($data) {
        $sql = "UPDATE combustibles SET 
                    mes = ?, 
                    tipo_combustible = ?, 
                    litros_combustible_mes = ?, 
                    litros_combustible_anio = ?, 
                    costos = ?, 
                    factores_emision = ?, 
                    co2_generado = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die(" Error en prepare(): " . $this->conn->error);
        }

        $stmt->bind_param(
            "ssdddddi",
            $data['mes'],
            $data['tipo_combustible'],
            $data['litros_combustible_mes'],
            $data['litros_combustible_anio'],
            $data['costos'],
            $data['factores_emision'],
            $data['co2_generado'],
            $data['id']
        );

        // Ejecución de la actualización
        if (!$stmt->execute()) {
            die(" Error al actualizar: " . $stmt->error);
        }

        return true;
    }

    //  MÉTODO 4: eliminarRegistro($id)
    //  Elimina un registro específico de la tabla 'combustibles' según su ID.
    public function eliminarRegistro($id) {
        $stmt = $this->conn->prepare("DELETE FROM combustibles WHERE id = ?");
        if (!$stmt) {
            die(" Error en prepare(): " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);

        // Ejecución del DELETE
        if (!$stmt->execute()) {
            die(" Error al eliminar: " . $stmt->error);
        }

        return true;
    }

    //  MÉTODO 5: obtenerRegistroPorId($id)
    //  Recupera un solo registro de la tabla 'combustibles' según su ID.
    public function obtenerRegistroPorId($id) {
        $sql = "SELECT * FROM combustibles WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die(" Error en prepare(): " . $this->conn->error);
        }
        
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
