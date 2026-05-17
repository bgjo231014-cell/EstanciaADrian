<?php
require_once __DIR__ . '/../models/ReportesModel.php';
require_once __DIR__ . '/../libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class ReportesController {
    private $model;

    public function __construct($connection) {
        $this->model = new ReportesModel($connection);
    }

    // ======================================================
    // Página principal de reportes
    // ======================================================
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        include __DIR__ . '/../views/reportes.php';
    }

    // ======================================================
    // Reporte Comunidad
    // ======================================================
    public function comunidad() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $datos = $this->model->reporteComunidad();
        include __DIR__ . '/../views/reportes_comunidad.php';
    }

    // ======================================================
    // Reporte Combustibles
    // ======================================================
    public function combustibles() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $datos = $this->model->reporteCombustibles();
        include __DIR__ . '/../views/reportes_combustibles.php';
    }

    // ======================================================
    // Reporte Agua
    // ======================================================
    public function agua() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $datos = $this->model->reporteAgua();
        include __DIR__ . '/../views/reportes_agua.php';
    }

    // ======================================================
    // Reporte Electricidad
    // ======================================================
    public function electricidad() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $datos = $this->model->reporteElectricidad();
        include __DIR__ . '/../views/reportes_electricidad.php';
    }

    // ======================================================
    // Reporte Capacitación
    // ======================================================
    public function capacitacion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $datos = $this->model->reporteCapacitacion();
        include __DIR__ . '/../views/reportes_capacitacion.php';
    }

    // ======================================================
    // Reporte RSU / RME
    // ======================================================
    public function rsu() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $datos = $this->model->reporteRSU();
        include __DIR__ . '/../views/reportes_rsu.php';
    }

    // ======================================================
    // Reporte General WEB con filtros por año y mes
    // ======================================================
    public function general() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $anioSeleccionado = isset($_GET['year']) && $_GET['year'] !== ''
            ? (int)$_GET['year']
            : null;

        $mesSeleccionado = isset($_GET['month']) && $_GET['month'] !== ''
            ? (int)$_GET['month']
            : null;

        $aniosDisponibles = $this->model->getAniosDisponibles();

        if ($anioSeleccionado !== null) {
            $combustibles      = $this->model->reporteCombustiblesPorAnio($anioSeleccionado);
            $comb_total_co2    = $this->model->totalCO2CombustiblesPorAnio($anioSeleccionado);
            $rsu               = $this->model->reporteRSUPorAnio($anioSeleccionado);
            $comunidad         = $this->model->reporteComunidadPorAnio($anioSeleccionado);
            $agua              = $this->model->reporteAguaPorAnio($anioSeleccionado);
            $electricidad      = $this->model->reporteElectricidadPorAnio($anioSeleccionado);
            $capacitacion      = $this->model->reporteCapacitacionPorAnio($anioSeleccionado);
        } else {
            $combustibles      = $this->model->reporteCombustibles();
            $comb_total_co2    = $this->model->totalCO2Combustibles();
            $rsu               = $this->model->reporteRSU();
            $comunidad         = $this->model->reporteComunidad();
            $agua              = $this->model->reporteAgua();
            $electricidad      = $this->model->reporteElectricidad();
            $capacitacion      = $this->model->reporteCapacitacion();
        }

        // Datos para resumen por mes, por año y por cuatrimestre
        $datosMensuales = $this->model->reporteGeneralMensual(
            $anioSeleccionado,
            $mesSeleccionado
        );

        $data = [
            'combustibles_total_co2' => $comb_total_co2,
            'combustibles'           => $combustibles,
            'rsu'                    => $rsu,
            'comunidad'              => $comunidad,
            'agua'                   => $agua,
            'electricidad'           => $electricidad,
            'capacitacion'           => $capacitacion
        ];

        $anioSeleccionadoVista = $anioSeleccionado;
        $mesSeleccionadoVista  = $mesSeleccionado;
        $aniosDisponiblesVista = $aniosDisponibles;
        $datosMensualesVista   = $datosMensuales;

        include __DIR__ . '/../views/reportes_general.php';
    }

    // ======================================================
    // PDF GENERAL SIN IMÁGENES PNG, SIN GD, CON BARRAS HTML
    // ======================================================
    public function pdf_general() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        $anioSeleccionado = isset($_GET['year']) && $_GET['year'] !== ''
            ? (int)$_GET['year']
            : null;

        if ($anioSeleccionado !== null) {
            $data = [
                'combustibles_total_co2' => $this->model->totalCO2CombustiblesPorAnio($anioSeleccionado),
                'combustibles'           => $this->model->reporteCombustiblesPorAnio($anioSeleccionado),
                'rsu'                    => $this->model->reporteRSUPorAnio($anioSeleccionado),
                'agua'                   => $this->model->reporteAguaPorAnio($anioSeleccionado),
                'electricidad'           => $this->model->reporteElectricidadPorAnio($anioSeleccionado),
                'comunidad'              => $this->model->reporteComunidadPorAnio($anioSeleccionado),
                'capacitacion'           => $this->model->reporteCapacitacionPorAnio($anioSeleccionado)
            ];
        } else {
            $data = [
                'combustibles_total_co2' => $this->model->totalCO2Combustibles(),
                'combustibles'           => $this->model->reporteCombustibles(),
                'rsu'                    => $this->model->reporteRSU(),
                'agua'                   => $this->model->reporteAgua(),
                'electricidad'           => $this->model->reporteElectricidad(),
                'comunidad'              => $this->model->reporteComunidad(),
                'capacitacion'           => $this->model->reporteCapacitacion()
            ];
        }

        $rsu  = $data['rsu'][0] ?? null;
        $agua = $data['agua'][0] ?? null;
        $elec = $data['electricidad'][0] ?? null;
        $com  = $data['comunidad'][0] ?? null;
        $cap  = $data['capacitacion'][0] ?? null;

        $indicadores = [
            [
                'nombre' => 'Combustibles CO2',
                'valor'  => (float)($data['combustibles_total_co2'] ?? 0),
                'unidad' => 'kg'
            ],
            [
                'nombre' => 'RSU / RME generado',
                'valor'  => $rsu ? (float)($rsu['total_kg'] ?? 0) : 0,
                'unidad' => 'kg'
            ],
            [
                'nombre' => 'Consumo de agua',
                'valor'  => $agua ? (float)($agua['total_m3'] ?? 0) : 0,
                'unidad' => 'm3'
            ],
            [
                'nombre' => 'Electricidad',
                'valor'  => $elec ? (float)($elec['total_kw'] ?? 0) : 0,
                'unidad' => 'kW'
            ],
            [
                'nombre' => 'Comunidad promedio',
                'valor'  => $com ? (float)($com['promedio_personal'] ?? 0) : 0,
                'unidad' => 'personas'
            ],
            [
                'nombre' => 'Capacitacion total',
                'valor'  => $cap ? (float)($cap['total_capacitados'] ?? 0) : 0,
                'unidad' => 'personas'
            ]
        ];

        $maxValor = 0;

        foreach ($indicadores as $ind) {
            if ($ind['valor'] > $maxValor) {
                $maxValor = $ind['valor'];
            }
        }

        if ($maxValor <= 0) {
            $maxValor = 1;
        }

        ob_start();
        include __DIR__ . '/../views/pdf/pdf_reportes_general.php';
        $html = ob_get_clean();

        // Quitar cualquier imagen para que Dompdf no pida extensión GD
        $html = preg_replace('/<img[^>]*>/i', '', $html);
        $html = preg_replace('/data:image\/[^;]+;base64,[^"\']+/i', '', $html);
        $html = preg_replace('/url\([^)]+\.(png|jpg|jpeg|webp|gif)[^)]+\)/i', '', $html);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();

        $carpetaDescargas = __DIR__ . '/../../public/descargas/';

        if (!is_dir($carpetaDescargas)) {
            mkdir($carpetaDescargas, 0777, true);
        }

        $filename = 'Reporte_General_' . date('Y-m-d_H-i-s') . '.pdf';
        $rutaArchivo = $carpetaDescargas . $filename;

        file_put_contents($rutaArchivo, $output);

        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"$filename\"");
        echo $output;
        exit();
    }
}
?>