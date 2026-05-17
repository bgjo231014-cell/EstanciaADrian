<?php
// app/controllers/CapacitacionController.php

require_once __DIR__ . '/../models/CapacitacionModel.php';

class CapacitacionController
{
    private $capacitacionModel;

    public function __construct()
    {
        $this->capacitacionModel = new CapacitacionModel();
    }

    private function asegurarSesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function validarLogin()
    {
        $this->asegurarSesion();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }
    }

    public function index()
    {
        $this->validarLogin();

        $capacitaciones = $this->capacitacionModel->getAll();
        include __DIR__ . '/../views/capacitacion.php';
    }

    public function agregar()
    {
        $this->validarLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->mapPostData($_POST);

            if (!$this->validarDatosBasicos($data)) {
                header("Location: index.php?view=capacitacion");
                exit();
            }

            $this->capacitacionModel->insert($data);

            $_SESSION['mensaje'] = 'Registro de capacitación agregado correctamente.';
            header("Location: index.php?view=capacitacion");
            exit();
        }

        header("Location: index.php?view=capacitacion");
        exit();
    }

    public function crear()
    {
        $this->agregar();
    }

    public function editar()
    {
        $this->validarLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id_capacitacion']) ? (int)$_POST['id_capacitacion'] : 0;

            if ($id <= 0) {
                $_SESSION['mensaje'] = 'Error: no se recibió el ID de capacitación.';
                header("Location: index.php?view=capacitacion");
                exit();
            }

            $data = $this->mapPostData($_POST);

            if (!$this->validarDatosBasicos($data)) {
                header("Location: index.php?view=capacitacion");
                exit();
            }

            $this->capacitacionModel->update($id, $data);

            $_SESSION['mensaje'] = 'Registro de capacitación actualizado correctamente.';
            header("Location: index.php?view=capacitacion");
            exit();
        }

        header("Location: index.php?view=capacitacion");
        exit();
    }

    public function eliminar()
    {
        $this->validarLogin();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id > 0) {
            $this->capacitacionModel->delete($id);
            $_SESSION['mensaje'] = 'Registro eliminado correctamente.';
        } else {
            $_SESSION['mensaje'] = 'Error: ID no proporcionado.';
        }

        header("Location: index.php?view=capacitacion");
        exit();
    }

    private function mapPostData($post)
    {
        return [
            'año' => isset($post['año']) ? (int)$post['año'] : 0,
            'mes' => trim($post['mes'] ?? ''),
            'descripcion' => trim($post['descripcion'] ?? ''),

            'admvos' => $this->num($post, 'admvos'),
            'ptcs' => $this->num($post, 'ptcs'),
            'honorarios' => $this->num($post, 'honorarios'),
            'pa' => $this->num($post, 'pa'),
            'docentes' => $this->num($post, 'docentes'),
            'jardineros' => $this->num($post, 'jardineros'),
            'servicio_limpieza' => $this->num($post, 'servicio_limpieza'),
            'seguridad' => $this->num($post, 'seguridad'),
            'visitantes' => $this->num($post, 'visitantes'),
            'personas_externas_capacitadas' => $this->num($post, 'personas_externas_capacitadas'),

            'cantidad_hombres' => $this->num($post, 'cantidad_hombres'),
            'cantidad_mujeres' => $this->num($post, 'cantidad_mujeres')
        ];
    }

    private function validarDatosBasicos($data)
    {
        $mesesValidos = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];

        if ($data['año'] < 2000 || $data['año'] > 2100) {
            $_SESSION['mensaje'] = 'Error: el año debe estar entre 2000 y 2100.';
            return false;
        }

        $mes = strtolower(trim($data['mes']));

        if (!in_array($mes, $mesesValidos)) {
            $_SESSION['mensaje'] = 'Error: el mes debe ser válido. Ejemplo: enero, febrero, marzo.';
            return false;
        }

        return true;
    }

    private function num($data, $key)
    {
        if (!isset($data[$key]) || $data[$key] === '') {
            return 0;
        }

        return (float)$data[$key];
    }
}
?>