<?php
require_once __DIR__ . '/../models/CombustiblesModel.php';

class CombustiblesController {
    private $model;

    public function __construct($connection) {
    $this->model = new CombustiblesModel($connection);
}


    // Muestra la vista principal
public function index() {

    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?view=login");
        exit();
    }

    $registros = $this->model->obtenerRegistros();
    include __DIR__ . '/../views/combustibles.php';
}


    // Agregar nuevo registro
    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'mes'                    => $_POST['mes'],
                'tipo_combustible'       => $_POST['tipo_combustible'],
                'litros_combustible_mes' => $_POST['litros_combustible_mes'],
                'litros_combustible_anio'=> $_POST['litros_combustible_anio'],
                'costos'                 => $_POST['costos'],
                'factores_emision'       => $_POST['factores_emision'],
                'co2_generado'           => $_POST['co2_generado']
            ];
            $this->model->agregarRegistro($datos);
        }
        header("Location: index.php?view=combustibles");
    }

    // Editar registro
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'id'                     => $_POST['id'],
                'mes'                    => $_POST['mes'],
                'tipo_combustible'       => $_POST['tipo_combustible'],
                'litros_combustible_mes' => $_POST['litros_combustible_mes'],
                'litros_combustible_anio'=> $_POST['litros_combustible_anio'],
                'costos'                 => $_POST['costos'],
                'factores_emision'       => $_POST['factores_emision'],
                'co2_generado'           => $_POST['co2_generado']
            ];
            $this->model->actualizarRegistro($datos);
        }
        header("Location: index.php?view=combustibles");
    }

    // Eliminar registro
    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->model->eliminarRegistro($_GET['id']);
        }
        header("Location: index.php?view=combustibles");
    }
}
?>
