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

        // Año: solo número entero
        $data['año'] = isset($post['año']) ? (int) $post['año'] : 0;

        // Meses como texto
        $data['mes_1'] = trim($post['mes_1'] ?? '');
        $data['mes_2'] = trim($post['mes_2'] ?? '');
        $data['mes_3'] = trim($post['mes_3'] ?? '');

        // Todos los campos numéricos
        $camposNumericos = [
            'admvo_1','admvo_2','admvo_3',
            'ptc_1','ptc_2','ptc_3',
            'honorarios_1','honorarios_2','honorarios_3',
            'pa_1','pa_2','pa_3',
            'jardin_1','jardin_2','jardin_3',
            'limpieza_1','limpieza_2','limpieza_3',
            'mantto_1','mantto_2','mantto_3',
            'vigilancia_1','vigilancia_2','vigilancia_3',
            'licenciatura_1','licenciatura_2','licenciatura_3',
            'posgrado_1','posgrado_2','posgrado_3'
        ];

        foreach ($camposNumericos as $campo) {
            $valor = $post[$campo] ?? '';
            $data[$campo] = ($valor === '' ? 0 : floatval($valor));
        }

        return $data;
    }
}
