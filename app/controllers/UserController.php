<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UserController {

    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
    }

    /**
     * Muestra la lista de usuarios en el dashboard.
     */
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica si hay sesión activa
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=login&action=index");
            exit;
        }

        // Obtiene usuarios del modelo
        $usuariosBD = $this->usuarioModel->getAllUsersWithRole();

        // Mapea los nombres de las columnas al formato que la vista espera
        $usuarios = array_map(function ($u) {
            return [
                'id' => $u['idUsuario'] ?? '',
                'nombre' => $u['Nombre'] ?? '',
                'apellido_paterno' => $u['ApellidoPaterno'] ?? '',
                'apellido_materno' => $u['ApellidoMaterno'] ?? '',
                'telefono' => $u['Telefono'] ?? '',
                'correo' => $u['Correo'] ?? '',
                'rol' => $u['NombreRol'] ?? '',
                'Anos' => $u['Anos'] ?? '', // Por si se usa luego
            ];
        }, $usuariosBD ?? []);

        include __DIR__ . '/../views/gestion_usuarios.php';
    }

    /**
     * Inserta un nuevo usuario (desde el modal)
     */
    public function insert() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'Nombre' => $_POST['nombre'] ?? '',
                'ApellidoPaterno' => $_POST['apellido_paterno'] ?? '',
                'ApellidoMaterno' => $_POST['apellido_materno'] ?? '',
                'Telefono' => $_POST['telefono'] ?? '',
                'Correo' => $_POST['correo'] ?? '',
                'Pass' => !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '',
                'Cargo' => $_POST['cargo'] ?? '',
                'CreadoPor' => $_SESSION['usuario']['idUsuario'] ?? null,
                'idRol' => $this->mapRol($_POST['rol'] ?? ''),
                'Estado' => 'Activo'
            ];

            $resultado = $this->usuarioModel->createUser($data);

            $_SESSION['mensaje'] = $resultado
                ? "Usuario agregado correctamente"
                : " Error al agregar usuario";

            header("Location: index.php?controller=user&action=index");
            exit;
        }
    }

    /**
     * Actualiza un usuario existente
     */
    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                $_SESSION['mensaje'] = "Error: no se especificó usuario a editar.";
                header("Location: index.php?controller=user&action=index");
                exit;
            }

            $data = [
                'Nombre' => $_POST['nombre'] ?? '',
                'ApellidoPaterno' => $_POST['apellido_paterno'] ?? '',
                'ApellidoMaterno' => $_POST['apellido_materno'] ?? '',
                'Telefono' => $_POST['telefono'] ?? '',
                'Correo' => $_POST['correo'] ?? '',
                'idRol' => $this->mapRol($_POST['rol'] ?? '')
            ];

            // Si hay nueva contraseña
            if (!empty($_POST['password'])) {
                $data['Pass'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
            }

            $resultado = $this->usuarioModel->updateUsuario($id, $data);

            $_SESSION['mensaje'] = $resultado
                ? " Usuario actualizado correctamente"
                : " Error al actualizar usuario";

            header("Location: index.php?controller=user&action=index");
            exit;
        }
    }

    /**
     * Elimina un usuario
     */
    public function delete()
{
    if (!isset($_GET['id'])) {
        die("❌ Falta el ID del usuario.");
    }

    $id = intval($_GET['id']);
    $usuarioModel = new UsuarioModel();

    if ($usuarioModel->deleteUsuario($id)) {
        header("Location: index.php?view=gestion_usuarios&msg=Usuario eliminado correctamente");
        exit;
    } else {
        header("Location: index.php?view=gestion_usuarios&error=No se pudo eliminar el usuario");
        exit;
    }
}


    /**
     * Traduce los nombres de rol a su idRol correspondiente.
     */
    private function mapRol($rolNombre) {
        switch (strtolower($rolNombre)) {
            case 'administrador': return 1;
            case 'cecam': return 2;
            case 'universitario': return 3;
            default: return null;
        }
    }
}
?>
