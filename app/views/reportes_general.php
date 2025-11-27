<?php
include 'partials/header.php';

// Seguridad
if (session_status() === PHP_SESSION_NONE) { session_start(); }
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

// Filtro de años
$anioSeleccionado = $anioSeleccionadoVista ?? null;
$aniosDisponibles = $aniosDisponiblesVista ?? [];
?>

<div class="container mt-4">

    <!-- Botón Descargar PDF -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-success mb-0"> Reporte General del Sistema Ambiental</h2>

        <?php
        $pdfUrl = "index.php?controller=reportes&action=pdf_general";
        if (!empty($anioSeleccionado)) {
            $pdfUrl .= "&year=" . urlencode($anioSeleccionado);
        }
        ?>
        <a href="<?= $pdfUrl ?>"
           class="btn btn-danger btn-sm"
           id="btnDescargarPdf"
           target="_blank">
            Descargar PDF
        </a>
    </div>

    <p class="text-center text-secondary mb-4">
        Resumen consolidado de combustibles, RSU, agua, electricidad, comunidad y capacitación.
    </p>

    <!-- ============================= -->
    <!--       FILTRO POR AÑO          -->
    <!-- ============================= -->
    <form method="get" class="row g-2 mb-4">
        <input type="hidden" name="view" value="reportes_general">

        <div class="col-auto">
            <label for="year" class="col-form-label">Filtrar por año:</label>
        </div>
        <div class="col-auto">
            <select name="year" id="year" class="form-select form-select-sm">
                <option value="">Todos</option>
                <?php foreach ($aniosDisponibles as $anio): ?>
                    <option value="<?= $anio ?>"
                        <?= ($anioSeleccionado == $anio ? 'selected' : '') ?>>
                        <?= $anio ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-success btn-sm" type="submit">Aplicar</button>
        </div>
    </form>

    <?php if ($anioSeleccionado): ?>
        <p class="text-center text-muted">
            Mostrando información del año <strong><?= htmlspecialchars($anioSeleccionado) ?></strong>.
        </p>
    <?php else: ?>
        <p class="text-center text-muted">
            Mostrando información de <strong>todos los años</strong> disponibles.
        </p>
    <?php endif; ?>

    <!-- ============================= -->
    <!--       DASHBOARD RESUMIDO     -->
    <!-- ============================= -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">

        <div class="col">
            <div class="card shadow-sm border-success">
                <div class="card-body text-center">
                    <h6 class="text-success">CO₂ por Combustibles</h6>
                    <h4><?= number_format($comb_total_co2,2) ?> kg</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-warning">
                <div class="card-body text-center">
                    <h6 class="text-warning">RSU Generado</h6>
                    <h4><?= $rsu ? number_format($rsu['total_kg'],2) : '0' ?> kg</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-primary">
                <div class="card-body text-center">
                    <h6 class="text-primary">Consumo de Agua</h6>
                    <h4><?= $agua ? number_format($agua['total_m3'],2) : '0' ?> m³</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-secondary">
                <div class="card-body text-center">
                    <h6 class="text-secondary">Uso de Electricidad</h6>
                    <h4><?= $elec ? number_format($elec['total_kw'],2) : '0' ?> kW</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-info">
                <div class="card-body text-center">
                    <h6 class="text-info">Personal Promedio Comunidad</h6>
                    <h4><?= $com ? number_format($com['promedio_personal'],2) : '0' ?></h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-danger">
                <div class="card-body text-center">
                    <h6 class="text-danger">Capacitación Total</h6>
                    <h4><?= $cap ? number_format($cap['total_capacitados'],2) : '0' ?></h4>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================= -->
    <!--     GRÁFICA COMPARATIVA      -->
    <!-- ============================= -->
    <div class="card shadow mb-5">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Comparación Global por Indicadores Ambientales</h5>
        </div>
        <div class="card-body">
            <canvas id="graficaGeneral" height="140"></canvas>
        </div>
    </div>


    <!-- ============================= -->
    <!--       TABLAS DETALLADAS      -->
    <!-- COMBUSTIBLES -->
    <div class="card shadow mb-5">
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
                <?php foreach($data['combustibles'] as $c): ?>
                    <tr>
                        <td><?= $c['anio'] ?></td>
                        <td><?= ucfirst($c['tipo_combustible']) ?></td>
                        <td><?= number_format($c['litros'],2) ?></td>
                        <td><?= number_format($c['co2'],2) ?></td>
                        <td>$<?= number_format($c['costos'],2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- RSU -->
    <div class="card shadow mb-5">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">RSU (Residuos Sólidos Urbanos)</h5>
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
                <?php foreach($data['rsu'] as $r): ?>
                    <tr>
                        <td><?= $r['anio'] ?></td>
                        <td><?= number_format($r['total_kg'],2) ?></td>
                        <td><?= number_format($r['total_tn'],2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- AGUA -->
    <div class="card shadow mb-5">
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
                <?php foreach($data['agua'] as $a): ?>
                    <tr>
                        <td><?= $a['anio'] ?></td>
                        <td><?= number_format($a['total_m3'],2) ?></td>
                        <td><?= number_format($a['total_costo'],2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- ELECTRICIDAD -->
    <div class="card shadow mb-5">
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
                <?php foreach($data['electricidad'] as $e): ?>
                    <tr>
                        <td><?= $e['anio'] ?></td>
                        <td><?= number_format($e['total_kw'],2) ?></td>
                        <td><?= number_format($e['total_costo'],2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- COMUNIDAD -->
    <div class="card shadow mb-5">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Comunidad</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-info">
                    <tr>
                        <th>Año</th>
                        <th>Promedio de Personal</th>
                        <th>Total Personal</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data['comunidad'] as $c): ?>
                    <tr>
                        <td><?= $c['año'] ?></td>
                        <td><?= number_format($c['promedio_personal'],2) ?></td>
                        <td><?= number_format($c['total_personal'],2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- CAPACITACIÓN -->
    <div class="card shadow mb-5">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Capacitación</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-danger">
                    <tr>
                        <th>Año</th>
                        <th>Total Capacitados</th>
                        <th>Hombres</th>
                        <th>Mujeres</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data['capacitacion'] as $c): ?>
                    <tr>
                        <td><?= $c['año'] ?></td>
                        <td><?= number_format($c['total_capacitados'],2) ?></td>
                        <td><?= $c['hombres'] ?></td>
                        <td><?= $c['mujeres'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ============================= -->
<!--        SCRIPT GRÁFICA        -->
<!-- ============================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("graficaGeneral");

    const dataValores = [
        <?= $comb_total_co2 ?>,
        <?= $rsu ? $rsu['total_kg'] : 0 ?>,
        <?= $agua ? $agua['total_m3'] : 0 ?>,
        <?= $elec ? $elec['total_kw'] : 0 ?>,
        <?= $com ? $com['promedio_personal'] : 0 ?>,
        <?= $cap ? $cap['total_capacitados'] : 0 ?>
    ];

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
                backgroundColor: ['#28a745aa','#ffc107aa','#0d6efdaa','#6c757daa','#17a2b8aa','#dc3545aa'],
                borderColor: ['#28a745','#ffc107','#0d6efd','#6c757d','#17a2b8','#dc3545'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    type: 'logarithmic',
                    beginAtZero: true
                }
            }
        }
    });
});

// ===== Enviar la gráfica al servidor antes de abrir el PDF =====
document.getElementById('btnDescargarPdf').addEventListener("click", function (e) {
    const enlace = this;
    const canvas = document.getElementById("graficaGeneral");
    if (!canvas) return;

    const imagenBase64 = canvas.toDataURL("image/png");

    e.preventDefault(); // Evitar que abra el PDF de inmediato

    fetch("index.php?controller=reportes&action=guardarGrafica", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ imagen: imagenBase64 })
    }).then(() => {
        // Cuando ya se guardó la imagen, abrimos el PDF en nueva pestaña
        window.open(enlace.href, "_blank");
    }).catch(err => {
        console.error("Error al guardar gráfica:", err);
        // Si falla, aún así intentamos abrir el PDF
        window.open(enlace.href, "_blank");
    });
});
</script>

<?php include 'partials/footer.php'; ?>
