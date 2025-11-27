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
    //  Página principal de reportes (tarjetas)
    // ======================================================
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }
        include __DIR__ . '/../views/reportes.php';
    }
    // ======================================================
    //  REPORTES INDIVIDUALES 
    // ======================================================
    public function comunidad() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $datos = $this->model->reporteComunidad();
        include __DIR__ . '/../views/reportes_comunidad.php';
    }

    public function combustibles() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $datos = $this->model->reporteCombustibles();
        include __DIR__ . '/../views/reportes_combustibles.php';
    }

    public function agua() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $datos = $this->model->reporteAgua();
        include __DIR__ . '/../views/reportes_agua.php';
    }

    public function electricidad() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $datos = $this->model->reporteElectricidad();
        include __DIR__ . '/../views/reportes_electricidad.php';
    }

    public function capacitacion() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $datos = $this->model->reporteCapacitacion();
        include __DIR__ . '/../views/reportes_capacitacion.php';
    }

    public function rsu() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $datos = $this->model->reporteRSU();
        include __DIR__ . '/../views/reportes_rsu.php';
    }

    // ======================================================
    //  REPORTE GENERAL (VISTA WEB) CON FILTRO POR AÑO
    // ======================================================
    public function general() {

        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?view=login");
            exit();
        }

        // Año seleccionado desde la URL (?view=reportes_general&year=2024)
        $anioSeleccionado = isset($_GET['year']) && $_GET['year'] !== ''
            ? (int)$_GET['year']
            : null;

        // Años disponibles para llenar el combo
        $aniosDisponibles = $this->model->getAniosDisponibles();

        // Armar datos según haya filtro o no
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

        $data = [
            'combustibles_total_co2' => $comb_total_co2,
            'combustibles'           => $combustibles,
            'rsu'                    => $rsu,
            'comunidad'              => $comunidad,
            'agua'                   => $agua,
            'electricidad'           => $electricidad,
            'capacitacion'           => $capacitacion
        ];

        // Variables adicionales para la vista (filtro)
        $anioSeleccionadoVista = $anioSeleccionado;
        $aniosDisponiblesVista = $aniosDisponibles;

        include __DIR__ . '/../views/reportes_general.php';
    }

    // ======================================================
    //  ENDPOINT PARA GUARDAR LA GRÁFICA COMO PNG
    // ======================================================
    public function guardarGrafica() {
        // Solo aceptar POST con JSON
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido';
            return;
        }

        $raw = file_get_contents('php://input');
        $json = json_decode($raw, true);

        if (!$json || !isset($json['imagen'])) {
            http_response_code(400);
            echo 'Datos inválidos';
            return;
        }

        $imagenBase64 = $json['imagen'];

        // Quitar encabezado data:image/png;base64,
        if (strpos($imagenBase64, 'base64,') !== false) {
            $partes = explode('base64,', $imagenBase64, 2);
            $imagenBase64 = $partes[1];
        }

        $binario = base64_decode($imagenBase64);

        if ($binario === false) {
            http_response_code(400);
            echo 'No se pudo decodificar la imagen';
            return;
        }

        $ruta = __DIR__ . '/../../public/descargas/grafica_general.png';
        if (!is_dir(dirname($ruta))) {
            @mkdir(dirname($ruta), 0777, true);
        }

        file_put_contents($ruta, $binario);

        header('Content-Type: application/json');
        echo json_encode(['ok' => true]);
    }

    // ======================================================
    //  GENERAR PDF DEL REPORTE GENERAL (USA FILTRO)
    // ======================================================
    public function pdf_general() {

    // (Opcional, por seguridad)
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?view=login");
        exit();
    }

    // 1. Obtener todos los datos que usa el reporte general
    $data = [
        'combustibles_total_co2' => $this->model->totalCO2Combustibles(),
        'combustibles'           => $this->model->reporteCombustibles(),
        'rsu'                    => $this->model->reporteRSU(),
        'agua'                   => $this->model->reporteAgua(),
        'electricidad'           => $this->model->reporteElectricidad(),
        'comunidad'              => $this->model->reporteComunidad(),
        'capacitacion'           => $this->model->reporteCapacitacion()
    ];

    // 2. Generar el HTML usando la vista pdf_reportes_general.php
    ob_start();
    include __DIR__ . '/../views/pdf/pdf_reportes_general.php';
    $html = ob_get_clean();

    // 3. Crear y configurar Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html, 'UTF-8');
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // 4. Obtener el binario del PDF
    $output = $dompdf->output();

    // 5. Guardar una copia en /public/descargas/
    $carpetaDescargas = __DIR__ . '/../../public/descargas/';

    if (!is_dir($carpetaDescargas)) {
        mkdir($carpetaDescargas, 0777, true);
    }

    $filename = 'Reporte_General_' . date('Y-m-d_H-i-s') . '.pdf';
    $rutaArchivo = $carpetaDescargas . $filename;

    file_put_contents($rutaArchivo, $output);

    // 6. Enviar también el PDF al navegador
    header("Content-Type: application/pdf");
    // inline = lo abre en el navegador; cámbialo a attachment si quieres descarga forzada
    header("Content-Disposition: inline; filename=\"$filename\"");
    echo $output;
}

}
