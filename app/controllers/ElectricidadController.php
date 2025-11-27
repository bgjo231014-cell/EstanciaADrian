<?php
require_once __DIR__ . '/../models/ElectricidadModel.php';

class ElectricidadController {
    private $model;
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->model = new ElectricidadModel($this->connection);
    }

    private function verificarSesion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['idRol']) || $_SESSION['idRol'] != 1) {
            header("Location: index.php?view=login");
            exit();
        }
    }

    public function index() {
        $this->verificarSesion();

        $registros = $this->model->obtenerRegistros();
        include __DIR__ . '/../views/electricidad.php';
    }

    public function agregar() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'mes_elec' => $_POST['mes_elec'],
                'cons_kw_mes_elec' => $_POST['cons_kw_mes_elec'],
                'costo_elec' => $_POST['costo_elec'],
                'cons_percap_elec' => $_POST['cons_percap_elec'],
                'ener_sud1_elec' => $_POST['ener_sud1_elec'],
                'ener_sl172_elec' => $_POST['ener_sl172_elec'],
                'ener_scid_elec' => $_POST['ener_scid_elec']
            ];
            $this->model->agregarRegistro($datos);
        }

        header("Location: index.php?view=electricidad");
    }

    public function editar() {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'id_elec' => $_POST['id_elec'],
                'mes_elec' => $_POST['mes_elec'],
                'cons_kw_mes_elec' => $_POST['cons_kw_mes_elec'],
                'costo_elec' => $_POST['costo_elec'],
                'cons_percap_elec' => $_POST['cons_percap_elec'],
                'ener_sud1_elec' => $_POST['ener_sud1_elec'],
                'ener_sl172_elec' => $_POST['ener_sl172_elec'],
                'ener_scid_elec' => $_POST['ener_scid_elec']
            ];
            $this->model->actualizarRegistro($datos);
        }

        header("Location: index.php?view=electricidad");
    }

    public function eliminar() {
        $this->verificarSesion();

        if (isset($_GET['id'])) {
            $this->model->eliminarRegistro($_GET['id']);
        }

        header("Location: index.php?view=electricidad");
    }
}
?>
