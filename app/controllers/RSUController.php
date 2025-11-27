<?php
// app/controllers/RSUController.php

require_once __DIR__ . '/../models/RSUModel.php';

class RSUController
{
    private $model;

    // Recibe la conexión desde index.php
    public function __construct($connection)
    {
        $this->model = new RSUModel($connection);
    }

    /* =====================================================
       SESIÓN
    ===================================================== */
    private function asegurarSesion()
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
       1️⃣  LISTAR REGISTROS
    ===================================================== */
    public function index()
    {
        $this->asegurarSesion();

        // Traer todos los registros de la tabla rsu
        $registros = $this->model->obtenerRegistros();

        // Cargar la vista (ella hace los foreach)
        include __DIR__ . '/../views/rsu.php';
    }

    /* =====================================================
       2️⃣  CREAR REGISTRO
    ===================================================== */
    public function crear()
    {
        $this->asegurarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->agregarRegistro($_POST);
        }

        header("Location: index.php?view=rsu");
        exit();
    }

    /* =====================================================
       3️⃣  EDITAR REGISTRO
    ===================================================== */
 public function editar()
{
    $this->asegurarSesion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validar ID
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$id || $id <= 0) {
            header("Location: index.php?view=rsu&error=id");
            exit();
        }

        // Colocar el ID validado en $_POST
        $_POST['id'] = $id;

        // Actualizar en BD
        $this->model->actualizarRegistro($_POST);

        // Regresar sin debug
        header("Location: index.php?view=rsu");
        exit();
    }

    header("Location: index.php?view=rsu");
    exit();
}



    /* =====================================================
       4️⃣  ELIMINAR REGISTRO
    ===================================================== */
    public function eliminar()
    {
        $this->asegurarSesion();

        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            if ($id !== false) {
                $this->model->eliminarRegistro($id);
            }
        }

        header("Location: index.php?view=rsu");
        exit();
    }
}
