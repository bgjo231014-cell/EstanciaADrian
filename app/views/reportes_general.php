<?php include 'partials/header.php'; ?>

<?php
// Seguridad
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php?view=login");
    exit();
}

// Variables que vienen del controlador
$comb_total_co2 = $data['combustibles_total_co2'] ?? 0;
$rsu  = $data['rsu'][0]          ?? null;
$agua = $data['agua'][0]         ?? null;
$elec = $data['electricidad'][0] ?? null;
$cap  = $data['capacitacion'][0] ?? null;
$com  = $data['comunidad'][0]    ?? null;

// Filtros
$anioSeleccionado = $anioSeleccionadoVista ?? null;
$mesSeleccionado  = $mesSeleccionadoVista ?? null;
$aniosDisponibles = $aniosDisponiblesVista ?? [];
$datosMensuales   = $datosMensualesVista ?? [];

$meses = [
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
];

// URL PDF
$pdfUrl = "index.php?controller=reportes&action=pdf_general";

if (!empty($anioSeleccionado)) {
    $pdfUrl .= "&year=" . urlencode($anioSeleccionado);
}

// =============================
// RESUMEN POR AÑO
// =============================
$resumenPorAnio = [];

foreach ($datosMensuales as $row) {
    $anio = $row['anio'] ?? '';
    $indicador = $row['indicador'] ?? '';
    $unidad = $row['unidad'] ?? '';

    $key = $anio . '-' . $indicador;

    if (!isset($resumenPorAnio[$key])) {
        $resumenPorAnio[$key] = [
            'anio' => $anio,
            'indicador' => $indicador,
            'total' => 0,
            'unidad' => $unidad
        ];
    }

    $resumenPorAnio[$key]['total'] += (float)($row['total'] ?? 0);
}

// =============================
// RESUMEN POR CUATRIMESTRE
// =============================
$datosOrdenados = $datosMensuales;

usort($datosOrdenados, function($a, $b) {
    if (($a['indicador'] ?? '') === ($b['indicador'] ?? '')) {
        if (($a['anio'] ?? 0) == ($b['anio'] ?? 0)) {
            return ((int)($a['mes_num'] ?? 0)) <=> ((int)($b['mes_num'] ?? 0));
        }

        return ((int)($a['anio'] ?? 0)) <=> ((int)($b['anio'] ?? 0));
    }

    return strcmp(($a['indicador'] ?? ''), ($b['indicador'] ?? ''));
});

$porIndicador = [];

foreach ($datosOrdenados as $row) {
    $indicador = $row['indicador'] ?? 'Sin indicador';
    $porIndicador[$indicador][] = $row;
}
?>

<style>
@media print {
    .no-print,
    nav,
    footer,
    .btn,
    form,
    script {
        display: none !important;
    }

    body {
        background: white !important;
    }

    .card {
        box-shadow: none !important;
        border: 1px solid #ccc !important;
        page-break-inside: avoid;
    }

    .container {
        width: 100% !important;
        max-width: 100% !important;
    }

    body.imprimir-filtrado .seccion-reporte {
        display: none !important;
    }

    body.imprimir-dashboard .seccion-dashboard,
    body.imprimir-resumen-mes .seccion-resumen-mes,
    body.imprimir-resumen-anio .seccion-resumen-anio,
    body.imprimir-resumen-cuatrimestre .seccion-resumen-cuatrimestre,
    body.imprimir-grafica .seccion-grafica,
    body.imprimir-combustibles .seccion-combustibles,
    body.imprimir-rsu .seccion-rsu,
    body.imprimir-agua .seccion-agua,
    body.imprimir-electricidad .seccion-electricidad,
    body.imprimir-comunidad .seccion-comunidad,
    body.imprimir-capacitacion .seccion-capacitacion {
        display: block !important;
    }
}
</style>

<div class="container mt-4">

    <!-- ENCABEZADO -->
    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <h2 class="text-success mb-0">
            Reporte General del Sistema Ambiental
        </h2>

        <a href="<?= $pdfUrl ?>"
           class="btn btn-danger btn-sm"
           id="btnDescargarPdf"
           target="_blank">
            Descargar PDF
        </a>
    </div>

    <p class="text-center text-secondary mb-4">
        Resumen consolidado de combustibles, RME, agua, electricidad, comunidad y capacitación.

        <a href="index.php?view=dashboard_admin" class="btn btn-secondary no-print">
            Regresar al Panel
        </a>
    </p>

    <!-- FILTROS POR AÑO Y MES -->
    <form method="get" class="row g-2 mb-4 no-print">
        <input type="hidden" name="view" value="reportes_general">

        <div class="col-auto">
            <label for="year" class="col-form-label">Filtrar por año:</label>
        </div>

        <div class="col-auto">
            <select name="year" id="year" class="form-select form-select-sm">
                <option value="">Todos</option>
                <?php foreach ($aniosDisponibles as $anio): ?>
                    <option value="<?= htmlspecialchars($anio) ?>"
                        <?= ($anioSeleccionado == $anio ? 'selected' : '') ?>>
                        <?= htmlspecialchars($anio) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-auto">
            <label for="month" class="col-form-label">Filtrar por mes:</label>
        </div>

        <div class="col-auto">
            <select name="month" id="month" class="form-select form-select-sm">
                <option value="">Todos</option>
                <?php foreach ($meses as $num => $nombre): ?>
                    <option value="<?= $num ?>"
                        <?= ($mesSeleccionado == $num ? 'selected' : '') ?>>
                        <?= $nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-auto">
            <button class="btn btn-success btn-sm" type="submit">
                Aplicar
            </button>
        </div>

        <div class="col-auto">
            <a href="index.php?view=reportes_general" class="btn btn-secondary btn-sm">
                Limpiar
            </a>
        </div>
    </form>

    <!-- FILTRO PARA IMPRIMIR POR SECCIÓN -->
    <div class="card shadow mb-4 no-print">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Opciones de impresión</h5>
        </div>

        <div class="card-body">
            <div class="row g-3 align-items-end">

                <div class="col-md-6">
                    <label class="form-label">Selecciona qué sección quieres imprimir</label>
                    <select id="filtroImpresion" class="form-select">
                        <option value="todos">Reporte general completo</option>
                        <option value="dashboard">Tarjetas resumen</option>
                        <option value="resumen-mes">Resumen por mes</option>
                        <option value="resumen-anio">Resumen por año</option>
                        <option value="resumen-cuatrimestre">Resumen por cuatrimestre</option>
                        <option value="grafica">Gráfica general</option>
                        <option value="combustibles">Combustibles</option>
                        <option value="rsu">RME</option>
                        <option value="agua">Agua</option>
                        <option value="electricidad">Electricidad</option>
                        <option value="comunidad">Comunidad</option>
                        <option value="capacitacion">Capacitación</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="button" id="btnImprimirSeccion" class="btn btn-danger w-100">
                        Imprimir / Guardar PDF
                    </button>
                </div>

            </div>
        </div>
    </div>

    <?php if ($anioSeleccionado): ?>
        <p class="text-center text-muted">
            Mostrando información del año <strong><?= htmlspecialchars($anioSeleccionado) ?></strong>
            <?php if ($mesSeleccionado): ?>
                y mes <strong><?= htmlspecialchars($meses[$mesSeleccionado] ?? '') ?></strong>
            <?php endif; ?>.
        </p>
    <?php else: ?>
        <p class="text-center text-muted">
            Mostrando información de <strong>todos los años</strong> disponibles.
        </p>
    <?php endif; ?>

    <!-- DASHBOARD RESUMIDO -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4 seccion-reporte seccion-dashboard">

        <div class="col">
            <div class="card shadow-sm border-success">
                <div class="card-body text-center">
                    <h6 class="text-success">CO₂ por Combustibles</h6>
                    <h4><?= number_format((float)$comb_total_co2, 2) ?> kg</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-warning">
                <div class="card-body text-center">
                    <h6 class="text-warning">RME Generado</h6>
                    <h4><?= $rsu ? number_format((float)$rsu['total_kg'], 2) : '0' ?> kg</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-primary">
                <div class="card-body text-center">
                    <h6 class="text-primary">Consumo de Agua</h6>
                    <h4><?= $agua ? number_format((float)$agua['total_m3'], 2) : '0' ?> m³</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-secondary">
                <div class="card-body text-center">
                    <h6 class="text-secondary">Uso de Electricidad</h6>
                    <h4><?= $elec ? number_format((float)$elec['total_kw'], 2) : '0' ?> kW</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-info">
                <div class="card-body text-center">
                    <h6 class="text-info">Personal Promedio Comunidad</h6>
                    <h4><?= $com ? number_format((float)$com['promedio_personal'], 2) : '0' ?></h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-danger">
                <div class="card-body text-center">
                    <h6 class="text-danger">Capacitación Total</h6>
                    <h4><?= $cap ? number_format((float)$cap['total_capacitados'], 2) : '0' ?></h4>
                </div>
            </div>
        </div>

    </div>

    <!-- RESUMEN POR MES -->
    <div class="card shadow mb-5 seccion-reporte seccion-resumen-mes">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Resumen General por Mes</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Año</th>
                        <th>Mes</th>
                        <th>Indicador</th>
                        <th>Total</th>
                        <th>Unidad</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($datosMensuales as $row): ?>
                    <?php
                        $mesNum = (int)($row['mes_num'] ?? 0);
                        $nombreMes = $meses[$mesNum] ?? 'Sin mes';
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['anio'] ?? '') ?></td>
                        <td><?= htmlspecialchars($nombreMes) ?></td>
                        <td><?= htmlspecialchars($row['indicador'] ?? '') ?></td>
                        <td><?= number_format((float)($row['total'] ?? 0), 2) ?></td>
                        <td><?= htmlspecialchars($row['unidad'] ?? '') ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($datosMensuales)): ?>
                    <tr>
                        <td colspan="5">No hay datos mensuales para mostrar.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- RESUMEN POR AÑO -->
    <div class="card shadow mb-5 seccion-reporte seccion-resumen-anio">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Resumen General por Año</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Año</th>
                        <th>Indicador</th>
                        <th>Total</th>
                        <th>Unidad</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($resumenPorAnio as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['anio']) ?></td>
                        <td><?= htmlspecialchars($row['indicador']) ?></td>
                        <td><?= number_format((float)$row['total'], 2) ?></td>
                        <td><?= htmlspecialchars($row['unidad']) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($resumenPorAnio)): ?>
                    <tr>
                        <td colspan="4">No hay datos anuales para mostrar.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- RESUMEN POR CUATRIMESTRE -->
    <div class="card shadow mb-5 seccion-reporte seccion-resumen-cuatrimestre">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Resumen General por Cuatrimestre</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-info">
                    <tr>
                        <th>Indicador</th>
                        <th>Cuatrimestre</th>
                        <th>Periodo</th>
                        <th>Total</th>
                        <th>Promedio</th>
                        <th>Unidad</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($porIndicador as $indicador => $registros): ?>
                    <?php $grupos = array_chunk($registros, 4); ?>

                    <?php foreach ($grupos as $index => $grupo): ?>
                        <?php
                            $total = 0;

                            foreach ($grupo as $registro) {
                                $total += (float)($registro['total'] ?? 0);
                            }

                            $cantidad = count($grupo);
                            $promedio = $cantidad > 0 ? $total / $cantidad : 0;

                            $primero = $grupo[0];
                            $ultimo = $grupo[$cantidad - 1];

                            $mesInicio = $meses[(int)($primero['mes_num'] ?? 0)] ?? '';
                            $mesFin = $meses[(int)($ultimo['mes_num'] ?? 0)] ?? '';

                            $periodo = $mesInicio . ' ' . ($primero['anio'] ?? '') . ' - ' . $mesFin . ' ' . ($ultimo['anio'] ?? '');
                        ?>

                        <tr>
                            <td><?= htmlspecialchars($indicador) ?></td>
                            <td>Cuatrimestre <?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($periodo) ?></td>
                            <td><?= number_format($total, 2) ?></td>
                            <td><?= number_format($promedio, 2) ?></td>
                            <td><?= htmlspecialchars($grupo[0]['unidad'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>

                <?php if (empty($porIndicador)): ?>
                    <tr>
                        <td colspan="6">No hay datos por cuatrimestre para mostrar.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- GRÁFICA COMPARATIVA -->
    <div class="card shadow mb-5 seccion-reporte seccion-grafica">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Comparación Global por Indicadores Ambientales</h5>
        </div>

        <div class="card-body">
            <canvas id="graficaGeneral" height="140"></canvas>
        </div>
    </div>

    <!-- COMBUSTIBLES -->
    <div class="card shadow mb-5 seccion-reporte seccion-combustibles">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Combustibles</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-success">
                    <tr>
                        <th>Año</th>
                        <th>Tipo</th>
                        <th>Litros Totales</th>
                        <th>CO₂ (kg)</th>
                        <th>Costos ($)</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach (($data['combustibles'] ?? []) as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['anio'] ?? '') ?></td>
                        <td><?= htmlspecialchars(ucfirst($c['tipo_combustible'] ?? '')) ?></td>
                        <td><?= number_format((float)($c['litros'] ?? 0), 2) ?></td>
                        <td><?= number_format((float)($c['co2'] ?? 0), 2) ?></td>
                        <td>$<?= number_format((float)($c['costos'] ?? 0), 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- RME -->
    <div class="card shadow mb-5 seccion-reporte seccion-rsu">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"> RME</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-warning">
                    <tr>
                        <th>Año</th>
                        <th>Total Kg</th>
                        <th>Total Toneladas</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach (($data['rsu'] ?? []) as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r['anio'] ?? '') ?></td>
                        <td><?= number_format((float)($r['total_kg'] ?? 0), 2) ?></td>
                        <td><?= number_format((float)($r['total_tn'] ?? 0), 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- AGUA -->
    <div class="card shadow mb-5 seccion-reporte seccion-agua">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Consumo de Agua</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Año</th>
                        <th>Total m³</th>
                        <th>Total Costos ($)</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach (($data['agua'] ?? []) as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['anio'] ?? '') ?></td>
                        <td><?= number_format((float)($a['total_m3'] ?? 0), 2) ?></td>
                        <td><?= number_format((float)($a['total_costo'] ?? 0), 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ELECTRICIDAD -->
    <div class="card shadow mb-5 seccion-reporte seccion-electricidad">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Electricidad</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>Año</th>
                        <th>Total kW</th>
                        <th>Total Costos ($)</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach (($data['electricidad'] ?? []) as $e): ?>
                    <tr>
                        <td><?= htmlspecialchars($e['anio'] ?? '') ?></td>
                        <td><?= number_format((float)($e['total_kw'] ?? 0), 2) ?></td>
                        <td><?= number_format((float)($e['total_costo'] ?? 0), 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- COMUNIDAD -->
    <div class="card shadow mb-5 seccion-reporte seccion-comunidad">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Comunidad</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-info">
                    <tr>
                        <th>Año</th>
                        <th>Total Registros</th>
                        <th>Promedio de Personal</th>
                        <th>Total Personal</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach (($data['comunidad'] ?? []) as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['anio'] ?? '') ?></td>
                        <td><?= number_format((float)($c['total_registros'] ?? 0), 0) ?></td>
                        <td><?= number_format((float)($c['promedio_personal'] ?? 0), 2) ?></td>
                        <td><?= number_format((float)($c['total_personal'] ?? 0), 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- CAPACITACIÓN -->
    <div class="card shadow mb-5 seccion-reporte seccion-capacitacion">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Capacitación</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-danger">
                    <tr>
                        <th>Año</th>
                        <th>Total Registros</th>
                        <th>Total Capacitados</th>
                        <th>Total Verdadero</th>
                        <th>Hombres</th>
                        <th>Mujeres</th>
                        <th>% Hombres</th>
                        <th>% Mujeres</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach (($data['capacitacion'] ?? []) as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['anio'] ?? '') ?></td>
                        <td><?= number_format((float)($c['total_registros'] ?? 0), 0) ?></td>
                        <td><?= number_format((float)($c['total_capacitados'] ?? 0), 2) ?></td>
                        <td><?= number_format((float)($c['total_verdadero'] ?? 0), 2) ?></td>
                        <td><?= number_format((float)($c['hombres'] ?? 0), 0) ?></td>
                        <td><?= number_format((float)($c['mujeres'] ?? 0), 0) ?></td>
                        <td><?= number_format((float)($c['porcentaje_hombres'] ?? 0), 2) ?>%</td>
                        <td><?= number_format((float)($c['porcentaje_mujeres'] ?? 0), 2) ?>%</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("graficaGeneral");

    const dataValores = [
        <?= (float)$comb_total_co2 ?>,
        <?= $rsu ? (float)$rsu['total_kg'] : 0 ?>,
        <?= $agua ? (float)$agua['total_m3'] : 0 ?>,
        <?= $elec ? (float)$elec['total_kw'] : 0 ?>,
        <?= $com ? (float)$com['promedio_personal'] : 0 ?>,
        <?= $cap ? (float)$cap['total_capacitados'] : 0 ?>
    ];

    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    "Combustibles CO₂ (kg)",
                    "RSU (kg)",
                    "Agua (m³)",
                    "Electricidad (kW)",
                    "Comunidad (Promedio)",
                    "Capacitación Total"
                ],
                datasets: [{
                    label: "Indicadores Ambientales",
                    data: dataValores,
                    backgroundColor: [
                        '#28a745aa',
                        '#ffc107aa',
                        '#0d6efdaa',
                        '#6c757daa',
                        '#17a2b8aa',
                        '#dc3545aa'
                    ],
                    borderColor: [
                        '#28a745',
                        '#ffc107',
                        '#0d6efd',
                        '#6c757d',
                        '#17a2b8',
                        '#dc3545'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    const filtroImpresion = document.getElementById("filtroImpresion");
    const btnImprimir = document.getElementById("btnImprimirSeccion");

    if (btnImprimir && filtroImpresion) {
        btnImprimir.addEventListener("click", () => {
            const seccion = filtroImpresion.value;

            document.body.classList.remove(
                "imprimir-filtrado",
                "imprimir-dashboard",
                "imprimir-resumen-mes",
                "imprimir-resumen-anio",
                "imprimir-resumen-cuatrimestre",
                "imprimir-grafica",
                "imprimir-combustibles",
                "imprimir-rsu",
                "imprimir-agua",
                "imprimir-electricidad",
                "imprimir-comunidad",
                "imprimir-capacitacion"
            );

            if (seccion !== "todos") {
                document.body.classList.add("imprimir-filtrado");
                document.body.classList.add("imprimir-" + seccion);
            }

            window.print();

            setTimeout(() => {
                document.body.classList.remove(
                    "imprimir-filtrado",
                    "imprimir-dashboard",
                    "imprimir-resumen-mes",
                    "imprimir-resumen-anio",
                    "imprimir-resumen-cuatrimestre",
                    "imprimir-grafica",
                    "imprimir-combustibles",
                    "imprimir-rsu",
                    "imprimir-agua",
                    "imprimir-electricidad",
                    "imprimir-comunidad",
                    "imprimir-capacitacion"
                );
            }, 1000);
        });
    }
});
</script>

<?php include 'partials/footer.php'; ?>