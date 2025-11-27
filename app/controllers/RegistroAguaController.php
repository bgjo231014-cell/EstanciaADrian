<?php
require_once __DIR__ . '/../models/RegistroAguaModel.php';

class RegistroAguaController {
    private $model;

    public function __construct() {
        $this->model = new RegistroAguaModel();
        // Aseguramos que la sesión esté iniciada para mensajes de estado
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // Lógica de seguridad: solo administradores pueden acceder
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
             unset($_SESSION['mensaje']);
             header("Location: index.php?view=login");
             exit();
        }

        $registros = $this->model->obtenerRegistros();
        // Incluimos la vista, asumiendo que es views/registro_agua.php
        include __DIR__ . '/../views/registro_agua.php';
        // Limpiamos el mensaje después de mostrarlo en la vista
        unset($_SESSION['mensaje']);
    }

    /**
     * Sanitiza los datos de entrada para Registro de Agua.
     * @param int $method Constante INPUT_POST o INPUT_GET.
     * @return array|bool Array con datos sanitizados o false si falla la validación.
     */
    private function sanitizarDatos($method) {
        $datos = [];

        // Mes (string)
        $datos['mes'] = filter_input($method, 'mes', FILTER_SANITIZE_STRING);

        // Valores numéricos (float)
        $datos['cant_lluvia_mm']      = filter_input($method, 'cant_lluvia_mm', FILTER_VALIDATE_FLOAT);
        $datos['aguas_residuales_m3'] = filter_input($method, 'aguas_residuales_m3', FILTER_VALIDATE_FLOAT);
        $datos['agua_tratada_m3']     = filter_input($method, 'agua_tratada_m3', FILTER_VALIDATE_FLOAT);
        $datos['agua_reutilizada_m3'] = filter_input($method, 'agua_reutilizada_m3', FILTER_VALIDATE_FLOAT);

        // Si es edición, se espera un ID (integer)
        if ($method === INPUT_POST && isset($_POST['id'])) {
            $datos['id'] = filter_input($method, 'id', FILTER_VALIDATE_INT);
            if ($datos['id'] === false || $datos['id'] <= 0) {
                 $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'ID de registro inválido para Registro de Agua.'];
                 return false;
            }
        }

        // Comprobación básica de campos requeridos
        if (empty($datos['mes']) || $datos['cant_lluvia_mm'] === false) {
             $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Error de validación: Debe especificar el mes y la cantidad de lluvia.'];
             return false;
        }

        // Asegurar que los valores float sean 0.0 si son nulos o inválidos
        foreach ($datos as $key => $value) {
            if (($value === false || $value === null) && $key !== 'mes' && $key !== 'id') {
                $datos[$key] = 0.0;
            }
        }

        return $datos;
    }


    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $this->sanitizarDatos(INPUT_POST);

            if ($datos !== false) {
                if ($this->model->agregarRegistro($datos)) {
                    $_SESSION['mensaje'] = ['tipo' => 'exito', 'texto' => 'Registro de agua (Lluvia/Residuales) agregado exitosamente.'];
                } else {
                    $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Hubo un error al agregar el registro en la base de datos.'];
                }
            }
        }
        header("Location: index.php?view=registro_agua");
        exit();
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $this->sanitizarDatos(INPUT_POST);

            if ($datos !== false) {
                if ($this->model->actualizarRegistro($datos)) {
                    $_SESSION['mensaje'] = ['tipo' => 'exito', 'texto' => 'Registro de agua (Lluvia/Residuales) actualizado exitosamente.'];
                } else {
                    $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Hubo un error al actualizar el registro en la base de datos.'];
                }
            }
        }
        header("Location: index.php?view=registro_agua");
        exit();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if ($id !== false && $id > 0) {
                if ($this->model->eliminarRegistro($id)) {
                    $_SESSION['mensaje'] = ['tipo' => 'exito', 'texto' => 'Registro de agua eliminado exitosamente.'];
                } else {
                    $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'Hubo un error al eliminar el registro.'];
                }
            } else {
                $_SESSION['mensaje'] = ['tipo' => 'error', 'texto' => 'ID de registro inválido para eliminar.'];
            }
        }
        header("Location: index.php?view=registro_agua");
        exit();
    }
}
