<?php
// Usaremos la clase DashboardController para el proyecto Estancia

class DashboardController {
    private $connection;
    // Asumimos que el proyecto Estancia necesita la conexión en el constructor.
    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
     * Muestra el panel principal.
     * La lógica de Estancia ya maneja la redirección si no hay sesión.
     * Decide qué vista cargar basándose en el rol del usuario (idRol).
     */
    public function index() {
        session_start();

        // 1. Control de Autenticación
        if (!isset($_SESSION['usuario'])) {
            // Se usa el ruteo de Estancia: index.php?controller=login
            header("Location: index.php?controller=login");
            exit;
        }

        // 2. Lógica de Roles (usando idRol del proyecto Estancia)
        $idRol = $_SESSION['usuario']['idRol'];

        // NOTA: Aquí se podría integrar la lógica para obtener datos de los Modelos
        // de CECAM_MVC si se necesitan en el dashboard (ej: conteo de registros).
        // Por ahora, solo cargamos la vista adecuada.

        if ($idRol == 1) {
            // Administrador
            // NOTA: Se asume que la vista para el Administrador ahora incluirá
            // las tarjetas y enlaces de CECAM_MVC.
            include "app/views/dashboard_admin.php";
        } elseif ($idRol == 2) {
            // Personal
            include "app/views/dashboard_personal.php";
        } else {
            // Cualquier otro rol (Ej: Invitado o Default)
            include "app/views/dashboard_default.php"; // Si tienes una vista general
        }
    }

    // Manteniendo la función personal() y admin() de Estancia para rutas específicas
    public function admin() {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idRol'] != 1) {
            header("Location: index.php?controller=login");
            exit;
        }
        include "app/views/dashboard_admin.php";
    }

    public function personal() {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idRol'] != 2) {
            header("Location: index.php?controller=login");
            exit;
        }
        include "app/views/dashboard_personal.php";
    }

    /**
     * Función logout() importada de CECAM_MVC.
     */
    public function logout() {
        session_start();
        session_destroy();
        // Redirigir a la página de inicio (Login)
        header("Location: index.php");
        exit();
    }
}
?>
