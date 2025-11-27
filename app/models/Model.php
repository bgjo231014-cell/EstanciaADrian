<?php
require_once(__DIR__ . '/../../config/database.php');

class Model
{
    protected $db;

    public function __construct($connection = null)
    {
        if ($connection) {
            // Usa la conexión existente
            $this->db = $connection;
        } else {
            // Crea una nueva conexión
            $database = new Database();
            $this->db = $database->connect();
        }
    }
}
