<?php
class InvitadoModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function registrarInvitado($nombre, $apellidoP, $apellidoM, $telefono, $correo, $passHash) {
        $sql = "INSERT INTO Usuario 
                (Nombre, ApellidoPaterno, ApellidoMaterno, Telefono, Correo, Pass, Cargo, FechaRegistro, CreadoPor, Estado, idRol)
                VALUES (?, ?, ?, ?, ?, ?, NULL, NOW(), NULL, 'Activo', 3)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $nombre, $apellidoP, $apellidoM, $telefono, $correo, $passHash);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
