<?php
require_once __DIR__ . '/../models/ProgramacionModel.php';

class ProgramacionController {
    private $model;

    public function __construct() {
        $this->model = new ProgramacionModel();
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $programaciones = $this->model->obtenerProgramaciones();
        include __DIR__ . '/../views/programacion.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crearProgramacion($_POST);
        }
        header("Location: index.php?view=programacion");
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_programacion'])) {
            $this->model->actualizarProgramacion($_POST);
        }
        header("Location: index.php?view=programacion");
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->model->eliminarProgramacion($_GET['id']);
        }
        header("Location: index.php?view=programacion");
    }
}
?>
