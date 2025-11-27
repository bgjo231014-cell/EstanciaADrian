<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct($connection = null) {
        // UsuarioModel extiende Model y acepta conexión opcional
        $this->model = new UsuarioModel($connection);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function esAdmin() {
        // Puedes ajustar esto si tu sesión guarda el rol diferente
        if (isset($_SESSION['idRol']) && $_SESSION['idRol'] == 1) {
            return true;
        }
        if (isset($_SESSION['usuario']['idRol']) && $_SESSION['usuario']['idRol'] == 1) {
            return true;
        }
        return false;
    }

    public function index() {
        if (!$this->esAdmin()) {
            header("Location: index.php?view=login");
            exit();
        }

        // Usa el método REAL del modelo
        $usuarios = $this->model->getAllUsersWithRole();
        include __DIR__ . '/../views/gestion_usuarios.php';
    }

    public function agregar() {
        if (!$this->esAdmin()) {
            header("Location: index.php?view=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'Nombre'          => $_POST['nombre'] ?? '',
                'ApellidoPaterno' => $_POST['apellido_paterno'] ?? '',
                'ApellidoMaterno' => $_POST['apellido_materno'] ?? null,
                'Telefono'        => $_POST['telefono'] ?? null,
                'Correo'          => $_POST['correo'] ?? '',
                //se guarda tal cual, sin encriptar
                'Pass'            => $_POST['password'] ?? '',
                //  AQUÍ EL CAMBIO: guardamos el texto del rol como Cargo
                'Cargo'           => $_POST['rol'] ?? null,
                'CreadoPor'       => $_SESSION['usuario_id'] ?? null,
                'idRol'           => $this->convertirRol($_POST['rol'] ?? ''),
                'Estado'          => 'Activo',
            ];

            $this->model->createUser($data);
        }

        header("Location: index.php?view=gestion_usuarios");
        exit();
    }

    public function editar() {
        if (!$this->esAdmin()) {
            header("Location: index.php?view=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                header("Location: index.php?view=gestion_usuarios");
                exit();
            }

            $data = [
                'Nombre'          => $_POST['nombre'] ?? '',
                'ApellidoPaterno' => $_POST['apellido_paterno'] ?? '',
                'ApellidoMaterno' => $_POST['apellido_materno'] ?? null,
                'Telefono'        => $_POST['telefono'] ?? null,
                'Correo'          => $_POST['correo'] ?? '',
                'idRol'           => $this->convertirRol($_POST['rol'] ?? ''),
            ];

            // Solo actualiza contraseña si escribiste algo
            if (!empty($_POST['password'])) {
                $data['Pass'] = $_POST['password']; // texto plano
            }

            $this->model->updateUsuario($id, $data);
        }

        header("Location: index.php?view=gestion_usuarios");
        exit();
    }

    public function eliminar() {
        if (!$this->esAdmin()) {
            header("Location: index.php?view=login");
            exit();
        }

        if (isset($_GET['id'])) {
            $this->model->deleteUsuario($_GET['id']);
        }

        header("Location: index.php?view=gestion_usuarios");
        exit();
    }

    private function convertirRol($rolTexto) {
        switch ($rolTexto) {
            case 'Administrador': return 1;
            case 'CECAM':         return 2;
            case 'Universitario': return 3;
            default:              return 3;
        }
    }
}
