<?php
// app/controllers/ComunidadController.php

require_once __DIR__ . '/../models/ComunidadModel.php';

class ComunidadController
{
    private $model;

    /**
     * Recibe $connection para ser compatible con index.php,
     * aunque ComunidadModel ya se conecta internamente con Database.
     */
    public function __construct($connection = null)
    {
        $this->model = new ComunidadModel();
    }

    // Pequeño helper para asegurar sesión
    private function asegurarSesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // 1. Mostrar vista principal
    public function index()
    {
        $this->asegurarSesion();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $comunidades = $this->model->obtenerComunidades();
        include __DIR__ . '/../views/comunidad.php';
    }

    // 2. Crear registro
    public function crear()
    {
        $this->asegurarSesion();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $this->procesarFormulario($_POST);
            $this->model->crearComunidad($datos);
        }

        header("Location: index.php?view=comunidad");
        exit();
    }

    // 3. Editar registro
    public function editar()
    {
        $this->asegurarSesion();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_comunidad'])) {
            $datos = $this->procesarFormulario($_POST);
            $datos['id_comunidad'] = (int) $_POST['id_comunidad'];
            $this->model->actualizarComunidad($datos);
        }

        header("Location: index.php?view=comunidad");
        exit();
    }

    // 4. Eliminar
    public function eliminar()
    {
        $this->asegurarSesion();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        if (isset($_GET['id'])) {
            $this->model->eliminarComunidad((int) $_GET['id']);
        }

        header("Location: index.php?view=comunidad");
        exit();
    }

    /* ============================
       Procesa y normaliza el POST
    ============================ */
    private function procesarFormulario($post)
    {
        $data = [];

        // Datos generales
        $data['año'] = isset($post['año']) ? (int) $post['año'] : 0;
        $data['mes'] = trim($post['mes'] ?? '');
        $data['descripcion'] = trim($post['descripcion'] ?? '');

        // Campos numéricos nuevos
        $camposNumericos = [
            'admvos',
            'ptcs',
            'honorarios',
            'pa',
            'jardineros',
            'limpieza',
            'maestros',
            'vigilancias',
            'licenciaturas',
            'posgrados'
        ];

        foreach ($camposNumericos as $campo) {
            $valor = $post[$campo] ?? '';
            $data[$campo] = ($valor === '' ? 0 : floatval($valor));
        }

        return $data;
    }
}