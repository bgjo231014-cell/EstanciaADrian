<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ===========================================
// ARCHIVO PRINCIPAL (Router General)
// ===========================================

// Iniciar sesión global si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Rutas base
$basePath        = __DIR__;
$controllersPath = $basePath . '/app/controllers/';
$viewsPath       = $basePath . '/app/views/';
$configPath      = $basePath . '/config/';

// ===========================================
//  Conexión a la base de datos (clase Database)
// ===========================================
require_once $configPath . 'database.php';
$db = new Database();
$connection = $db->connect();

// ===========================================
//  Parámetros de URL
// ===========================================
$controllerName = strtolower($_GET['controller'] ?? '');
$action         = $_GET['action'] ?? '';
$view           = $_GET['view'] ?? 'home';

// ===========================================
//  Cargar controlador vía ?controller=
// ===========================================
if (!empty($controllerName)) {
    $controllerFile = $controllersPath . ucfirst($controllerName) . 'Controller.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;

        $controllerClass = ucfirst($controllerName) . 'Controller';
        $controllerInstance = new $controllerClass($connection);

        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            echo "Error 404: Acción '$action' no encontrada en el controlador '$controllerName'";
        }
    } else {
        echo "Error 404: Controlador '$controllerName' no encontrado.";
    }
    exit;
}

// ===========================================
//  Cargar vista/controlador con ?view=
// ===========================================
switch ($view) {

    // =======================================
    //  MODULO: GESTIÓN DE CAPACITACIÓN 
    // =======================================
    case 'capacitacion':
    require_once $controllersPath . 'CapacitacionController.php';
    $controller = new CapacitacionController($connection);

    if ($action === 'crear') {
        $controller->crear();
    } elseif ($action === 'agregar') {
        $controller->agregar();
    } elseif ($action === 'editar') {
        $controller->editar();
    } elseif ($action === 'eliminar') {
        $controller->eliminar();
    } else {
        $controller->index();
    }
    break;

    // =======================================
    //  MODULO: GESTIÓN DE COMUNIDAD
    // =======================================
    case 'comunidad':
        require_once $controllersPath . 'ComunidadController.php';
        $controller = new ComunidadController($connection);

        if ($action === 'crear') {
            $controller->crear();
        } elseif ($action === 'editar') {
            $controller->editar();
        } elseif ($action === 'eliminar') {
            $controller->eliminar();
        } else {
            $controller->index();
        }
        break;

    // =======================================
    //  GESTIÓN DE USUARIOS
    // =======================================
case 'gestion_usuarios':
    require_once $controllersPath . 'UsuarioController.php';
    $controller = new UsuarioController($connection);
    $controller->index();
    break;


    // =======================================
    //  MODULO: GESTIÓN DE AGUA 
    // =======================================
    case 'agua':
        require_once $controllersPath . 'AguaController.php';
        $controller = new AguaController($connection);

        if ($action === 'crearRegistro')        $controller->crearRegistro();
        elseif ($action === 'editarRegistro')   $controller->editarRegistro();
        elseif ($action === 'eliminarRegistro') $controller->eliminarRegistro();
        elseif ($action === 'crearConsumo')     $controller->crearConsumo();
        elseif ($action === 'editarConsumo')    $controller->editarConsumo();
        elseif ($action === 'eliminarConsumo')  $controller->eliminarConsumo();
        else                                    $controller->index();
        break;
    // =======================================
    //  MODULO: GESTIÓN DE ELECTRICIDAD 
    // =======================================
    case 'electricidad':
        require_once $controllersPath . 'ElectricidadController.php';
        $controller = new ElectricidadController($connection);

        if ($action === 'agregar')        $controller->agregar();
        elseif ($action === 'editar')     $controller->editar();
        elseif ($action === 'eliminar')   $controller->eliminar();
        else                              $controller->index();
        break;
    // =======================================
    //  MODULO: GESTIÓN DE SANCIONES
    // =======================================
    case 'sanciones':
        require_once $controllersPath . 'SancionController.php';
        $controller = new SancionController($connection);

        if ($action === 'agregar')              $controller->agregar();
        elseif ($action === 'editar')           $controller->editar();
        elseif ($action === 'eliminar')         $controller->eliminar();
        elseif ($action === 'liberar')          $controller->liberarHoras();
        elseif ($action === 'historial')        $controller->historial();
        elseif ($action === 'congelar')         $controller->congelar();
        elseif ($action === 'reactivar')        $controller->reactivar();
        else                                    $controller->admin();
        break;

    // =======================================
    //  CONSULTA PÚBLICA DE SANCIONES
    // =======================================
    case 'consulta_sancion':
    require_once $controllersPath . 'SancionController.php';
    $controller = new SancionController($connection);
    $controller->consultaPublica();
    break;

                // =======================================
    //  MODULO: GESTIÓN DE RSU
    // =======================================
    case 'rsu':
        require_once $controllersPath . 'RSUController.php';
        $controller = new RSUController($connection);

        if ($action === 'crear') {
            // POST desde el modal "Agregar Registro RSU"
            $controller->crear();
        } elseif ($action === 'editar') {
            // POST desde el modal "Editar Registro RSU"
            $controller->editar();
        } elseif ($action === 'eliminar') {
            // GET desde el enlace "Eliminar"
            $controller->eliminar();
        } else {
            // Carga normal de la vista rsu
            $controller->index();
        }
        break;

// =======================================
//  MODULO: GESTIÓN DE COMBUSTIBLES
// =======================================
case 'combustibles':
    require_once $controllersPath . 'CombustiblesController.php';
    $controller = new CombustiblesController($connection);

    if     ($action === 'agregar')  $controller->agregar();
    elseif ($action === 'editar')   $controller->editar();
    elseif ($action === 'eliminar') $controller->eliminar();
    else                            $controller->index();
    break;

case 'reportes':
    require_once $controllersPath . 'ReportesController.php';
    $controller = new ReportesController($connection);
    $controller->index();
    break;
case 'reportes_general':
    require_once $controllersPath . 'ReportesController.php';
    $controller = new ReportesController($connection);
    $controller->general();
    break;

 // Respaldo
case 'backup':
    require_once __DIR__ . '/app/controllers/BackupController.php';
    $controller = new BackupController();

    if ($action === 'generar') {
        $controller->generar();
    } else {
        $controller->index();
    }
    break;

// Restauración
case 'restore':
    require_once __DIR__ . '/app/controllers/RestoreController.php';
    $controller = new RestoreController();

    if ($action === 'restaurar') {
        $controller->restaurar();
    } else {
        $controller->index();
    }
    break;



    // =======================================
    //  VISTAS NORMALES
    // =======================================
    default:
        $viewFile = $viewsPath . $view . '.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            echo "Error 404: Vista '$view' no encontrada.";
        }
        break;
}
