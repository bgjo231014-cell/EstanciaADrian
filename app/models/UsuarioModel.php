<?php
require_once(__DIR__ . '/Model.php');

/**
 * Clase UsuarioModel
 * Gestiona la interacción con la tabla 'Usuario' en la base de datos 'Estancia'.
 */
class UsuarioModel extends Model
{
    protected $table = 'Usuario';
    protected $idField = 'idUsuario';

    /**
     * Obtiene todos los usuarios con su rol.
     */
    public function getAllUsersWithRole()
    {
        $sql = "
            SELECT 
                u.idUsuario,
                u.Nombre,
                u.ApellidoPaterno,
                u.ApellidoMaterno,
                u.Telefono,
                u.Correo,
                r.Nombre AS NombreRol,
                u.Estado
            FROM Usuario u
            JOIN Rol r ON u.idRol = r.idRol
            ORDER BY u.ApellidoPaterno, u.ApellidoMaterno, u.Nombre
        ";

        $result = $this->db->query($sql);

        if (!$result) {
            error_log("❌ Error al obtener usuarios: " . $this->db->error);
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Crea un nuevo usuario.
     */
public function createUser($data)
{
    $sql = "
        INSERT INTO Usuario 
        (Nombre, ApellidoPaterno, ApellidoMaterno, Telefono, Correo, Pass, Cargo, CreadoPor, idRol, Estado) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        error_log("Error en prepare(): " . $this->db->error);
        return false;
    }

    $apellidoMaterno = $data['ApellidoMaterno'] ?? null;
    $telefono        = $data['Telefono'] ?? null;
    $cargo           = $data['Cargo'] ?? null;
    $creadoPor       = $data['CreadoPor'] ?? null;
    $estado          = $data['Estado'] ?? 'Activo';

    //  SIN cifrado: se guarda tal cual viene
    $passwordPlain = $data['Pass'];

    $stmt->bind_param(
        "sssssssiis",
        $data['Nombre'],
        $data['ApellidoPaterno'],
        $apellidoMaterno,
        $telefono,
        $data['Correo'],
        $passwordPlain,
        $cargo,
        $creadoPor,
        $data['idRol'],
        $estado
    );

    $ok = $stmt->execute();
    if (!$ok) {
        error_log(" Error al insertar usuario: " . $stmt->error);
    }

    $stmt->close();
    return $ok;
}

    /**
     * Actualiza la información de un usuario existente.
     */
public function updateUsuario($id, $data)
{
    // Base SQL
    $sql = "
        UPDATE Usuario 
        SET 
            Nombre = ?, 
            ApellidoPaterno = ?, 
            ApellidoMaterno = ?, 
            Telefono = ?, 
            Correo = ?, 
            idRol = ?
    ";

    $params = [];
    $types  = "sssssi";

    $params[] = $data['Nombre'];
    $params[] = $data['ApellidoPaterno'];
    $params[] = $data['ApellidoMaterno'];
    $params[] = $data['Telefono'];
    $params[] = $data['Correo'];
    $params[] = $data['idRol'];

    // Si viene contraseña nueva → Guardar texto plano
    if (!empty($data['Pass'])) {
        $sql .= ", Pass = ?";
        $types .= "s";
        $params[] = $data['Pass'];  // texto plano
    }

    $sql .= " WHERE idUsuario = ?";
    $types .= "i";
    $params[] = $id;

    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        error_log(" Error en prepare(): " . $this->db->error);
        return false;
    }

    $stmt->bind_param($types, ...$params);

    $ok = $stmt->execute();
    if (!$ok) {
        error_log("Error al actualizar usuario: " . $stmt->error);
    }

    $stmt->close();
    return $ok;
}

    /**
     * Cambia el estado de un usuario (Activo/Inactivo)
     */
    public function toggleEstado($id, $estado)
    {
        $sql = "UPDATE Usuario SET Estado = ? WHERE idUsuario = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            error_log(" Error en prepare(): " . $this->db->error);
            return false;
        }

        $stmt->bind_param("si", $estado, $id);
        $ok = $stmt->execute();

        if (!$ok) {
            error_log("Error al actualizar estado: " . $stmt->error);
        }

        $stmt->close();
        return $ok;
    }

    /**
     * Obtiene todos los roles disponibles.
     */
    public function getRoles()
    {
        $result = $this->db->query("SELECT * FROM Rol ORDER BY idRol");
        if (!$result) {
            error_log(" Error al obtener roles: " . $this->db->error);
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }
        /**
     * Elimina un usuario por su ID.
     * @param int $id ID del usuario a eliminar.
     * @return bool true si se eliminó correctamente, false en caso contrario.
     */
    public function deleteUsuario($id)
    {
        $sql = "DELETE FROM Usuario WHERE idUsuario = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            error_log(" Error en prepare() al eliminar usuario: " . $this->db->error);
            return false;
        }

        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();

        if (!$ok) {
            error_log(" Error al eliminar usuario: " . $stmt->error);
        }

        $stmt->close();
        return $ok;
    }

}
?>
