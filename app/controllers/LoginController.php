<?php
require_once __DIR__ . '/../models/LoginModel.php';

class LoginController {
    private $model;

    public function __construct($connection) {
        $this->model = new LoginModel($connection);
    }

    // Mostrar formulario de login
    public function index() {
        include __DIR__ . '/../views/login.php';
    }

    // Autenticar usuario
    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = trim($_POST['correo'] ?? '');
            $password = trim($_POST['pass'] ?? '');

            $usuario = $this->model->verificarUsuario($correo, $password);

            if ($usuario) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['usuario'] = $usuario;
                $_SESSION['usuario_id'] = $usuario['idUsuario'] ?? null;
                $_SESSION['usuario_tipo'] = $usuario['rol'] ?? null;
                $_SESSION['idRol'] = $usuario['idRol'] ?? null;

                // Redirigir según rol
                switch ($usuario['idRol']) {
                    case 1: // Admin
                        header("Location: index.php?view=dashboard_admin");
                        break;
                    case 2: // Personal
                        header("Location: index.php?view=dashboard_personal");
                        break;
                    default:
                        header("Location: index.php");
                        break;
                }
                exit();
            } else {
                $error = "Correo o contraseña incorrectos.";
                include __DIR__ . '/../views/login.php';
            }
        } else {
            include __DIR__ . '/../views/login.php';
        }
    }

    // Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
