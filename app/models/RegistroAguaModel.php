<?php
// Asegúrate de que esta ruta sea correcta para tu configuración de conexión

class RegistroAguaModel {
    private $conn;

    /**
     * Constructor: establece la conexión con la base de datos.
     */
    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    /**
     * Cierra la conexión a la base de datos cuando el objeto es destruido.
     */
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    /**
     * Consulta y devuelve todos los registros de la tabla 'registro_agua'.
     * @return array Registros de Agua.
     */
    public function obtenerRegistros() {
        $registros = [];
        $sql = "SELECT * FROM registro_agua ORDER BY id DESC";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->execute();
            $result = $stmt->get_result();
            $registros = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            error_log("Error al preparar la consulta obtenerRegistros RegistroAgua: " . $this->conn->error);
        }
        return $registros;
    }

    /**
     * Inserta un nuevo registro en la tabla 'registro_agua'.
     * @param array $data Contiene los valores a insertar.
     * @return bool True en éxito, false en caso de error.
     */
    public function agregarRegistro($data) {
        // Campos: mes, cant_lluvia_mm, aguas_residuales_m3, agua_tratada_m3, agua_reutilizada_m3
        $sql = "INSERT INTO registro_agua
                (mes, cant_lluvia_mm, aguas_residuales_m3, agua_tratada_m3, agua_reutilizada_m3)
                VALUES (?, ?, ?, ?, ?)";

        if (!$stmt = $this->conn->prepare($sql)) {
            error_log("Error al preparar INSERT en RegistroAgua: " . $this->conn->error);
            return false;
        }

        // Tipo de parámetros: s d d d d (string y 4 doubles/floats)
        $stmt->bind_param("sdddd",
            $data['mes'],
            $data['cant_lluvia_mm'],
            $data['aguas_residuales_m3'],
            $data['agua_tratada_m3'],
            $data['agua_reutilizada_m3']
        );

        if (!$stmt->execute()) {
            error_log("Error al ejecutar INSERT en RegistroAgua: " . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    /**
     * Permite modificar un registro existente en la tabla 'registro_agua' según su ID.
     * @param array $data Contiene los nuevos valores y el 'id' del registro.
     * @return bool True en éxito, false en caso de error.
     */
    public function actualizarRegistro($data) {
        $sql = "UPDATE registro_agua SET
                    mes = ?,
                    cant_lluvia_mm = ?,
                    aguas_residuales_m3 = ?,
                    agua_tratada_m3 = ?,
                    agua_reutilizada_m3 = ?
                WHERE id = ?";

        if (!$stmt = $this->conn->prepare($sql)) {
            error_log("Error al preparar UPDATE en RegistroAgua: " . $this->conn->error);
            return false;
        }

        // Tipo de parámetros: s d d d d i (string, 4 doubles/floats, y un integer para el ID)
        $stmt->bind_param("sddddi",
            $data['mes'],
            $data['cant_lluvia_mm'],
            $data['aguas_residuales_m3'],
            $data['agua_tratada_m3'],
            $data['agua_reutilizada_m3'],
            $data['id']
        );

        if (!$stmt->execute()) {
            error_log("Error al ejecutar UPDATE en RegistroAgua: " . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    /**
     * Elimina un registro específico de la tabla 'registro_agua' usando su ID.
     * @param int $id ID del registro a eliminar.
     * @return bool True en éxito, false en caso de error.
     */
    public function eliminarRegistro($id) {
        if (!$stmt = $this->conn->prepare("DELETE FROM registro_agua WHERE id = ?")) {
            error_log("Error al preparar DELETE en RegistroAgua: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            error_log("Error al ejecutar DELETE en RegistroAgua: " . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }
}
