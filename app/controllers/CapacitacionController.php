<?php
require_once __DIR__ . '/../models/CapacitacionModel.php';

class CapacitacionController
{
    private $capacitacionModel;

    public function __construct()
    {
        $this->capacitacionModel = new CapacitacionModel();
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $capacitaciones = $this->capacitacionModel->getAll();
        include __DIR__ . '/../views/capacitacion.php';
    }

    public function agregar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = $this->mapPostData($_POST);

            // APLICAR CÁLCULOS AUTOMÁTICOS
            $data = $this->calcularTotales($data);

            $this->capacitacionModel->insert($data);

            $_SESSION['mensaje'] = '✅ Registro de capacitación agregado correctamente.';
            header("Location: index.php?view=capacitacion");
            exit;
        }
    }

    public function editar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id_capacitacion'] ?? null;

            if (!$id) {
                $_SESSION['mensaje'] = '❌ Error: no se recibió el ID de capacitación.';
                header("Location: index.php?view=capacitacion");
                exit;
            }

            $data = $this->mapPostData($_POST);

            // APLICAR CÁLCULOS AUTOMÁTICOS
            $data = $this->calcularTotales($data);

            $this->capacitacionModel->update($id, $data);

            $_SESSION['mensaje'] = '✅ Registro de capacitación actualizado correctamente.';
            header("Location: index.php?view=capacitacion");
            exit;
        }
    }

    public function eliminar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->capacitacionModel->delete($id);
            $_SESSION['mensaje'] = '✅ Registro eliminado correctamente.';
        } else {
            $_SESSION['mensaje'] = '❌ Error: ID no proporcionado.';
        }

        header("Location: index.php?view=capacitacion");
        exit;
    }

    /**
     * -------------------------------
     *  MAPEO DE POST → COLUMNAS
     * -------------------------------
     */
    private function mapPostData($post)
    {
        $fields = [
            'año','mes_1','mes_2','mes_3',
            'admvo1','admvo2','admvo3',
            'PTC1','PTC2','PTC3',
            'Honorarios1','Honorarios2','Honorarios3',
            'PA1','PA2','PA3',
            'Servicios1','Servicios2','Servicios3',
            'Alumnos1','Alumnos2','Alumnos3',
            'Visitantes1','Visitantes2','Visitantes3',
            'personas_externas_capacitadas1','personas_externas_capacitadas2','personas_externas_capacitadas3',
            'cantidad_hombres','cantidad_mujeres'
        ];

        $data = [];
        foreach ($fields as $f) {
            $data[$f] = $post[$f] ?? 0;
        }

        return $data;
    }


    /**
     * ----------------------------------
     * CÁLCULOS AUTOMÁTICOS DEL SISTEMA
     * ----------------------------------
     */
    private function calcularTotales($d)
    {
        // 1️⃣ Totales por mes
        $d['Cantidad_totalCapa1'] =
            $d['admvo1'] + $d['PTC1'] + $d['Honorarios1'] + $d['PA1'] +
            $d['Servicios1'] + $d['Alumnos1'] + $d['Visitantes1'] +
            $d['personas_externas_capacitadas1'];

        $d['Cantidad_totalCapa2'] =
            $d['admvo2'] + $d['PTC2'] + $d['Honorarios2'] + $d['PA2'] +
            $d['Servicios2'] + $d['Alumnos2'] + $d['Visitantes2'] +
            $d['personas_externas_capacitadas2'];

        $d['Cantidad_totalCapa3'] =
            $d['admvo3'] + $d['PTC3'] + $d['Honorarios3'] + $d['PA3'] +
            $d['Servicios3'] + $d['Alumnos3'] + $d['Visitantes3'] +
            $d['personas_externas_capacitadas3'];

        // 2️⃣ Total empírico
        $d['Total_empirico'] =
            $d['Cantidad_totalCapa1'] +
            $d['Cantidad_totalCapa2'] +
            $d['Cantidad_totalCapa3'];

        // 3️⃣ Totales verdaderos
        $d['Calculo_total_verdadero1'] = $d['Cantidad_totalCapa1'];
        $d['Calculo_total_verdadero2'] = $d['Cantidad_totalCapa2'];
        $d['Calculo_total_verdadero3'] = $d['Cantidad_totalCapa3'];

        $d['total_verdaderoFinal'] =
            $d['Calculo_total_verdadero1'] +
            $d['Calculo_total_verdadero2'] +
            $d['Calculo_total_verdadero3'];

        // 4️⃣ Porcentajes
        if ($d['total_verdaderoFinal'] > 0) {
            $d['porcentaje_hombres'] = round(($d['cantidad_hombres'] / $d['total_verdaderoFinal']) * 100, 2);
            $d['porcentaje_mujeres'] = round(($d['cantidad_mujeres'] / $d['total_verdaderoFinal']) * 100, 2);
        } else {
            $d['porcentaje_hombres'] = 0;
            $d['porcentaje_mujeres'] = 0;
        }

        return $d;
    }
}
?>
