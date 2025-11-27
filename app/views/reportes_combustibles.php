<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h3 class="text-center text-success mb-4">
        Reporte de Combustibles
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Resumen por Año y Tipo de Combustible</h5>
        </div>
        <div class="card-body">
            <?php if (empty($datos)): ?>
                <div class="alert alert-warning text-center">No hay datos para mostrar.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-success">
                            <tr>
                                <th>Año</th>
                                <th>Tipo</th>
                                <th>Litros Totales</th>
                                <th>CO₂ Generado (kg)</th>
                                <th>Costo Total ($)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($datos as $row): ?>
                            <tr>
                                <td><?= $row['anio'] ?></td>
                                <td><?= ucfirst($row['tipo_combustible']) ?></td>
                                <td><?= number_format($row['litros'], 2) ?></td>
                                <td><?= number_format($row['co2'], 2) ?></td>
                                <td>$<?= number_format($row['costos'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card shadow mb-5">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Gráfica de Litros por Combustible</h5>
        </div>
        <div class="card-body">
            <canvas id="graficaCombustiblesReporte" height="120"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const datos = <?= json_encode($datos) ?>;

    const etiquetas = datos.map(d => d.tipo_combustible + " (" + d.anio + ")");
    const litros = datos.map(d => d.litros);

    const ctx = document.getElementById("graficaCombustiblesReporte");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: etiquetas,
            datasets: [{
                label: "Litros Totales",
                data: litros,
                backgroundColor: "#28a745aa",
                borderColor: "#28a745",
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>

<?php include 'partials/footer.php'; ?>
