<?php
// Clase Database: encargada de establecer la conexión con la base de datos unificada 'Estancia'.
class Database {
    // Propiedades privadas con los datos de conexión
    private $host = "localhost";      // Servidor donde se aloja la base de datos
    private $user = "root";           // Usuario de la base de datos
    private $password = "";           // Contraseña del usuario (vacía por defecto en localhost)
    private $dbname = "Estancia";     //  Nombre de la base de datos UNIFICADA

    private $conn;                    // Variable para almacenar la conexión

    /**
     * Método connect(): crea y devuelve la conexión con la base de datos
     * @return mysqli La conexión activa
     */
    public function connect() {
        // Se crea una nueva conexión utilizando la extensión mysqli
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        // Verifica si ocurre algún error al conectar con la base de datos
        if ($this->conn->connect_error) {
            // Si hay un error, se detiene el programa y se muestra el mensaje
            die("Error de conexión a la base de datos: " . $this->conn->connect_error);
        }
        // Se establece el conjunto de caracteres a UTF-8 para soportar tildes y caracteres especiales
        $this->conn->set_charset("utf8mb4");
        // Retorna la conexión activa para ser usada en los modelos
        return $this->conn;
    }
}
?>
