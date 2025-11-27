<?php
// Asegúrate de que esta ruta sea correcta para tu configuración de conexión
// Asumimos que Database::connect('Estancia') puede seleccionar la DB 'Estancia'

class AuthModel {
    private $conn;
    private $db_name = 'Estancia'; // Define la base de datos de gestión de usuarios

    /**
     * Constructor: establece la conexión con la base de datos 'Estancia'.
     */
    public function __construct() {
        // Asumimos que la clase Database maneja la selección de la base de datos
        $db = new Database();
        $this->conn = $db->connect($this->db_name);
    }

    /**
     * Cierra la conexión a la base de datos.
     */
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    // --- MÉTODOS DE AUTENTICACIÓN (LOGIN) ---

    /**
     * Verifica las credenciales de un usuario y devuelve sus datos si son válidas.
     * @param string $correo Correo del usuario.
     * @param string $pass Contraseña ingresada.
     * @return array|bool Datos del usuario o false si la autenticación falla.
     */
    public function autenticarUsuario($correo, $pass) {
        $sql = "SELECT 
                    u.idUsuario, u.Nombre, u.ApellidoPaterno, u.ApellidoMaterno, u.Correo, u.Pass,
                    r.Nombre AS Rol
                FROM Usuario u
                JOIN Rol r ON u.idRol = r.idRol
                WHERE u.Correo = ? AND u.Estado = 'Activo'";

        if (!$stmt = $this->conn->prepare($sql)) {
            error_log("Error al preparar autenticarUsuario: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        if ($usuario && password_verify($pass, $usuario['Pass'])) {
            // Eliminar el hash de la contraseña antes de devolver los datos
            unset($usuario['Pass']);
            return $usuario;
        }

        return false;
    }


    // --- MÉTODOS DE GESTIÓN DE USUARIOS (CRUD) ---

    /**
     * Obtiene todos los usuarios y su rol.
     * @return array Lista de usuarios.
     */
    public function obtenerTodosLosUsuarios() {
        $sql = "SELECT 
                    u.idUsuario, u.Nombre, u.ApellidoPaterno, u.ApellidoMaterno, 
                    u.Telefono, u.Correo, u.Cargo, u.Estado, u.FechaRegistro,
                    r.Nombre AS Rol
                FROM Usuario u
                JOIN Rol r ON u.idRol = r.idRol
                ORDER BY u.idUsuario DESC";

        if ($result = $this->conn->query($sql)) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            error_log("Error al obtener todos los usuarios: " . $this->conn->error);
            return [];
        }
    }
    
    /**
     * Obtiene todos los roles disponibles.
     * @return array Lista de roles.
     */
    public function obtenerRoles() {
        $sql = "SELECT idRol, Nombre FROM Rol ORDER BY idRol ASC";
        if ($result = $this->conn->query($sql)) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            error_log("Error al obtener roles: " . $this->conn->error);
            return [];
        }
    }

    /**
     * Registra un nuevo usuario.
     * @param array $data Datos del usuario (incluye Correo, Pass (sin hash), Nombre, etc.).
     * @param int $creadoPor ID del usuario que crea este nuevo registro.
     * @return bool True en éxito, false en caso de error.
     */
    public function registrarUsuario($data, $creadoPor) {
        // Encriptar la contraseña
        $hashed_pass = password_hash($data['Pass'], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO Usuario (
                    Nombre, ApellidoPaterno, ApellidoMaterno, Telefono, Correo, Pass, Cargo, idRol, CreadoPor, Estado
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if (!$stmt = $this->conn->prepare($sql)) {
            error_log("Error al preparar registrarUsuario: " . $this->conn->error);
            return false;
        }
        
        $estado = 'Activo'; // Nuevo usuario por defecto es 'Activo'

        $stmt->bind_param("sssssssiis", 
            $data['Nombre'], $data['ApellidoPaterno'], $data['ApellidoMaterno'], 
            $data['Telefono'], $data['Correo'], $hashed_pass, $data['Cargo'], 
            $data['idRol'], $creadoPor, $estado
        );

        if (!$stmt->execute()) {
            error_log("Error al ejecutar registrarUsuario: " . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    /**
     * Actualiza los datos de un usuario existente (excepto la contraseña, a menos que se proporcione una nueva).
     * @param array $data Datos del usuario a actualizar.
     * @return bool True en éxito, false en caso de error.
     */
    public function actualizarUsuario($data) {
        $fields = [
            'Nombre = ?', 'ApellidoPaterno = ?', 'ApellidoMaterno = ?', 
            'Telefono = ?', 'Correo = ?', 'Cargo = ?', 'idRol = ?', 'Estado = ?'
        ];
        $params = [
            $data['Nombre'], $data['ApellidoPaterno'], $data['ApellidoMaterno'], 
            $data['Telefono'], $data['Correo'], $data['Cargo'], $data['idRol'], $data['Estado']
        ];
        $types = "ssssssis";

        // Si se proporciona una nueva contraseña, la incluimos en la actualización
        if (!empty($data['Pass'])) {
            $hashed_pass = password_hash($data['Pass'], PASSWORD_DEFAULT);
            $fields[] = 'Pass = ?';
            $params[] = $hashed_pass;
            $types .= "s";
        }
        
        $sql = "UPDATE Usuario SET " . implode(', ', $fields) . " WHERE idUsuario = ?";

        // Añadir el ID del usuario al final de los parámetros
        $params[] = $data['idUsuario'];
        $types .= "i";

        if (!$stmt = $this->conn->prepare($sql)) {
            error_log("Error al preparar actualizarUsuario: " . $this->conn->error);
            return false;
        }
        
        // Agregar el tipo de dato al inicio de los parámetros y enlazar
        array_unshift($params, $types);
        call_user_func_array([$stmt, 'bind_param'], $this->refValues($params));

        if (!$stmt->execute()) {
            error_log("Error al ejecutar actualizarUsuario: " . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    /**
     * Helper para manejar referencias para call_user_func_array en bind_param.
     */
    private function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }
}
