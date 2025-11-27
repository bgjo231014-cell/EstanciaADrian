<?php

class LoginModel
{
    private $db;

    public function __construct($connection)
    {
        $this->db = $connection;
    }

    public function verificarUsuario($correo, $password)
    {
        $sql = "
            SELECT u.*, r.Nombre AS rol
            FROM Usuario u
            JOIN Rol r ON u.idRol = r.idRol
            WHERE u.Correo = ?
              AND u.Estado = 'Activo'
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            error_log('❌ Error prepare LoginModel: ' . $this->db->error);
            return false;
        }

        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result  = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        if (!$usuario) {
            return false; // correo no existe
        }

        // 🔓 Comparación directa SIN encriptar
        if ($usuario['Pass'] === $password) {
            return $usuario;
        }

        return false;
    }
}
