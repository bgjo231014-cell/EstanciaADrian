<?php
// app/controllers/AguaController.php

require_once __DIR__ . '/../models/AguaModel.php';

class AguaController
{
    private $model;

    public function __construct($connection)
    {
        // Recibe la conexión creada en index.php
        $this->model = new AguaModel($connection);
    }

    private function verificarSesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }
    }

    /* =====================================================
       1️  MOSTRAR VISTA PRINCIPAL
    ===================================================== */
    public function index()
    {
        $this->verificarSesion();

        $datos = $this->model->obtenerDatos();
        $registros_agua = $datos['registros_agua'];
        $consumos_agua  = $datos['consumos_agua'];

        include __DIR__ . '/../views/agua.php';
    }

    /* =====================================================
       2️  REGISTRO DE DESCARGAS
    ===================================================== */
    public function crearRegistro()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crearRegistro($_POST);
        }

        header("Location: index.php?view=agua");
        exit();
    }

    public function editarRegistro()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $this->model->editarRegistro($_POST);
        }

        header("Location: index.php?view=agua");
        exit();
    }

    public function eliminarRegistro()
    {
        $this->verificarSesion();

        if (isset($_GET['id'])) {
            $this->model->eliminarRegistro((int)$_GET['id']);
        }

        header("Location: index.php?view=agua");
        exit();
    }

    /* =====================================================
        3️⃣ CONSUMO Y COSTOS
    ===================================================== */
    public function crearConsumo()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crearConsumo($_POST);
        }

        header("Location: index.php?view=agua");
        exit();
    }

    public function editarConsumo()
    {
        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $this->model->editarConsumo($_POST);
        }

        header("Location: index.php?view=agua");
        exit();
    }

    public function eliminarConsumo()
    {
        $this->verificarSesion();

        if (isset($_GET['id'])) {
            $this->model->eliminarConsumo((int)$_GET['id']);
        }

        header("Location: index.php?view=agua");
        exit();
    }
}
