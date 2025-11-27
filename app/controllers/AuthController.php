<?php
require_once __DIR__ . '/../models/AuthModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new AuthModel();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Muestra la vista de login.
     */
    public function loginView() {
        if (isset($_SESSION['usuario'])) {
            // Si ya está logueado, redirigir al dashboard (o home)
            header("Location: index.php?view=dashboard");
            exit();
        }
        // Asumiendo que existe views/login.php
        include __DIR__ . '/../views/login.php';
        unset($_SESSION['mensaje']);
    }

    /**
     * Procesa el formulario de inicio de sesión.
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
            $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

            if (empty($correo) || empty($pass)) {
                $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Debe ingresar su correo y contraseña.'];
                header("Location: index.php?view=login");
                exit();
            }

            $usuario = $this->model->autenticarUsuario($correo, $pass);

            if ($usuario) {
                // Autenticación exitosa
                $_SESSION['usuario'] = $usuario;
                $_SESSION['mensaje'] = ['tipo' => 'exito', 'texto' => 'Bienvenido, ' . $usuario['Nombre'] . '.'];
                header("Location: index.php?view=dashboard"); // Redirigir al dashboard
                exit();
            } else {
                // Autenticación fallida
                $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Correo o contraseña incorrectos, o usuario inactivo.'];
                header("Location: index.php?view=login");
                exit();
            }
        }
        header("Location: index.php?view=login");
        exit();
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout() {
        // Destruir la sesión
        session_unset();
        session_destroy();
        
        $_SESSION['mensaje'] = ['tipo' => 'exito', 'texto' => 'Sesión cerrada exitosamente.'];
        header("Location: index.php?view=login");
        exit();
    }

    // --- MÉTODOS DE GESTIÓN DE USUARIOS (VISTA y CRUD) ---

    /**
     * Muestra la vista de gestión de usuarios (solo para Administradores).
     */
    public function index() {
        // Lógica de seguridad: solo Administradores pueden gestionar usuarios
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['Rol'] !== 'Administrador') {
             $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Acceso denegado. Se requiere ser Administrador.'];
             header("Location: index.php?view=dashboard");
             exit();
        }

        $usuarios = $this->model->obtenerTodosLosUsuarios();
        $roles = $this->model->obtenerRoles();
        
        // Asumiendo que existe views/usuarios.php
        include __DIR__ . '/../views/usuarios.php';
        unset($_SESSION['mensaje']);
    }

    /**
     * Procesa el formulario de registro de un nuevo usuario.
     */
    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validación de seguridad de Administrador
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['Rol'] !== 'Administrador') {
                 $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Acción denegada.'];
                 header("Location: index.php?view=usuarios");
                 exit();
            }

            $data = $this->sanitizarDatos(INPUT_POST);
            
            if ($data !== false) {
                // ID del Administrador que está creando el usuario
                $creadoPor = $_SESSION['usuario']['idUsuario']; 

                if ($this->model->registrarUsuario($data, $creadoPor)) {
                    $_SESSION['mensaje'] = ['tipo' => 'exito', 'texto' => 'Usuario registrado exitosamente.'];
                } else {
                    $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Error al registrar el usuario. El correo podría ya estar en uso.'];
                }
            }
        }
        header("Location: index.php?view=usuarios");
        exit();
    }
    
    /**
     * Procesa el formulario de edición de un usuario existente.
     */
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validación de seguridad de Administrador
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['Rol'] !== 'Administrador') {
                 $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Acción denegada.'];
                 header("Location: index.php?view=usuarios");
                 exit();
            }
            
            $data = $this->sanitizarDatos(INPUT_POST, true); // Pasar true para indicar modo edición
            
            if ($data !== false) {
                if ($this->model->actualizarUsuario($data)) {
                    $_SESSION['mensaje'] = ['tipo' => 'exito', 'texto' => 'Usuario actualizado exitosamente.'];
                } else {
                    $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Error al actualizar el usuario.'];
                }
            }
        }
        header("Location: index.php?view=usuarios");
        exit();
    }


    /**
     * Sanitiza y valida los datos de usuario.
     * @param int $method Constante INPUT_POST.
     * @param bool $isEdit Indica si se está en modo edición (requiere idUsuario).
     * @return array|bool Array con datos sanitizados o false si falla la validación.
     */
    private function sanitizarDatos($method, $isEdit = false) {
        $datos = [];
        
        // Validación de ID en modo edición
        if ($isEdit) {
            $datos['idUsuario'] = filter_input($method, 'idUsuario', FILTER_VALIDATE_INT);
            if ($datos['idUsuario'] === false || $datos['idUsuario'] <= 0) {
                 $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'ID de usuario inválido para edición.'];
                 return false;
            }
        }

        // Datos requeridos
        $datos['Nombre'] = filter_input($method, 'Nombre', FILTER_SANITIZE_STRING);
        $datos['ApellidoPaterno'] = filter_input($method, 'ApellidoPaterno', FILTER_SANITIZE_STRING);
        $datos['Correo'] = filter_input($method, 'Correo', FILTER_SANITIZE_EMAIL);
        $datos['idRol'] = filter_input($method, 'idRol', FILTER_VALIDATE_INT);
        $datos['Estado'] = filter_input($method, 'Estado', FILTER_SANITIZE_STRING);

        // Campos opcionales/no siempre requeridos
        $datos['ApellidoMaterno'] = filter_input($method, 'ApellidoMaterno', FILTER_SANITIZE_STRING);
        $datos['Telefono'] = filter_input($method, 'Telefono', FILTER_SANITIZE_STRING);
        $datos['Cargo'] = filter_input($method, 'Cargo', FILTER_SANITIZE_STRING);
        
        // Contraseña: solo requerida al agregar, opcional al editar
        $datos['Pass'] = filter_input($method, 'Pass', FILTER_SANITIZE_STRING);


        // Comprobación de campos requeridos
        if (empty($datos['Nombre']) || empty($datos['ApellidoPaterno']) || empty($datos['Correo']) || 
            $datos['idRol'] === false || $datos['idRol'] === null || empty($datos['Estado'])) {
             $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Error de validación: Faltan campos obligatorios (Nombre, Apellido Paterno, Correo, Rol, Estado).'];
             return false;
        }

        // Si estamos agregando, la contraseña es obligatoria
        if (!$isEdit && empty($datos['Pass'])) {
             $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Error de validación: La contraseña es obligatoria para un nuevo usuario.'];
             return false;
        }
        
        // Validar Estado
        if (!in_array($datos['Estado'], ['Activo', 'Inactivo'])) {
             $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Error de validación: El estado del usuario es inválido.'];
             return false;
        }

        return $datos;
    }
}
