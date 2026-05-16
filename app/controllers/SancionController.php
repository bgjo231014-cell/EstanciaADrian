<?php

require_once __DIR__ . '/../models/SancionModel.php';

class SancionController
{
    private $model;

    public function __construct($connection)
    {
        $this->model = new SancionModel($connection);
    }

    public function admin()
    {
        $sanciones = $this->model->obtenerSanciones();
        require __DIR__ . '/../views/sanciones/admin.php';
    }

    public function consultaPublica()
    {
        $resultados = [];
        $matricula = trim($_GET['matricula'] ?? '');

        if ($matricula !== '') {
            $resultados = $this->model->consultarPorMatricula($matricula);
        }

        require __DIR__ . '/../views/sanciones/consulta.php';
    }

    public function agregar()
    {
        $idAdmin = $_SESSION['idUsuario'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->agregarSancion($_POST, $idAdmin);
        }

        header("Location: index.php?view=sanciones");
        exit;
    }

    public function liberarHoras()
    {
        $idAdmin = $_SESSION['idUsuario'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->registrarLiberacion($_POST, $idAdmin);
        }

        header("Location: index.php?view=sanciones");
        exit;
    }

    public function historial()
    {
        $idSancion = (int)($_GET['id'] ?? 0);
        $historial = $this->model->obtenerHistorial($idSancion);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($historial);
        exit;
    }

    public function congelar()
    {
        $idAdmin = $_SESSION['idUsuario'] ?? null;
        $idSancion = (int)($_POST['id_sancion'] ?? $_GET['id'] ?? 0);
        $motivo = trim($_POST['motivo_congelacion'] ?? 'Penalización congelada por administrador');

        if ($idSancion > 0) {
            $this->model->congelarPenalizacion($idSancion, $motivo, $idAdmin);
        }

        header("Location: index.php?view=sanciones");
        exit;
    }

    public function reactivar()
    {
        $idAdmin = $_SESSION['idUsuario'] ?? null;
        $idSancion = (int)($_GET['id'] ?? 0);

        if ($idSancion > 0) {
            $this->model->reactivarPenalizacion($idSancion, $idAdmin);
        }

        header("Location: index.php?view=sanciones");
        exit;
    }

    public function eliminar()
    {
        $idSancion = (int)($_GET['id'] ?? 0);

        if ($idSancion > 0) {
            $this->model->eliminarSancion($idSancion);
        }

        header("Location: index.php?view=sanciones");
        exit;
    }
}