<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h3 class="text-center text-warning mb-4">
        Reporte de Residuos de Manejo Especial (RME)
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Resumen Anual de RME</h5>
        </div>
        <div class="card-body">
            <?php if (empty($datos)): ?>
                <div class="alert alert-warning text-center">No hay datos para mostrar.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-warning">
                            <tr>
                                <th>Año</th>
                                <th>Total Reciclado (kg)</th>
                                <th>Total en Toneladas (tn)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($datos as $row): ?>
                            <tr>
                                <td><?= $row['anio'] ?></td>
                                <td><?= number_format($row['total_kg'], 2) ?></td>
                                <td><?= number_format($row['total_tn'], 2) ?></td>
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
            <h5 class="mb-0">Gráfica  por Año</h5>
        </div>
        <div class="card-body">
            <canvas id="graficaRSUReporte" height="120"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const datos = <?= json_encode($datos) ?>;

    const etiquetas = datos.map(d => d.anio);
    const totalKg = datos.map(d => d.total_kg);
    const totalTn = datos.map(d => d.total_tn);

    const ctx = document.getElementById("graficaRSUReporte");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: etiquetas,
            datasets: [
                {
                    label: "Total Reciclado (kg)",
                    data: totalKg,
                    backgroundColor: "#f1c40faa",
                    borderColor: "#f39c12",
                    borderWidth: 2
                },
                {
                    label: "Total en Toneladas (tn)",
                    data: totalTn,
                    backgroundColor: "#8e44ad88",
                    borderColor: "#8e44ad",
                    borderWidth: 2
                }
            ]
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
