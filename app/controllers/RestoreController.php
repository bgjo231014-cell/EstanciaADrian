<?php
// Incluye el archivo del modelo RestoreModel para poder usarlo
require_once __DIR__ . '/../models/RestoreModel.php';

class RestoreController {
    private $model;  // Declara una propiedad privada para almacenar el modelo
    // Constructor: se ejecuta automáticamente al crear una instancia del controlador
    public function __construct() {
        $this->model = new RestoreModel();  // Crea una nueva instancia del modelo
    }
    // Función para mostrar la página principal de respaldo/restauración
    public function index() {
        include __DIR__ . '/../views/backup_restore.php';  // Carga la vista (interfaz de usuario)
    }
    // Función principal que maneja el proceso de restauración de la base de datos
    public function restaurar() {
        // Verifica si el usuario subió un archivo y no está vacío
        if (!empty($_FILES['archivo']['tmp_name'])) {
            $tmp = $_FILES['archivo']['tmp_name'];  // Obtiene la ubicación temporal del archivo subido
            $this->model->restaurarBD($tmp);  // Llama al modelo para ejecutar la restauración
            // Muestra un mensaje de éxito al usuario
            echo "<script>alert('Restauración realizada correctamente');</script>";
        } else {
            // Muestra un mensaje de error si no se seleccionó archivo
            echo "<script>alert('Debe seleccionar un archivo SQL');</script>";
        }
        // Vuelve a cargar la página (con el mensaje de alerta mostrado)
        include __DIR__ . '/../views/backup_restore.php';
    }
}