<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h3 class="text-center text-success mb-4">
        Reporte de Comunidad
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Resumen General por Año</h5>
        </div>

        <div class="card-body">
            <?php if (empty($datos)): ?>
                <div class="alert alert-warning text-center">
                    No hay datos para mostrar.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>Año</th>
                                <th>Total de Registros</th>
                                <th>Promedio de Personal</th>
                                <th>Total Personal</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($datos as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['anio'] ?? '') ?></td>
                                <td><?= number_format((float)($row['total_registros'] ?? 0), 0) ?></td>
                                <td><?= number_format((float)($row['promedio_personal'] ?? 0), 2) ?></td>
                                <td><?= number_format((float)($row['total_personal'] ?? 0), 0) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===================== GRÁFICA ===================== -->
    <div class="card shadow mb-5">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Gráfica: Total de Personal por Año</h5>
        </div>

        <div class="card-body">
            <canvas id="graficaComunidad" height="120"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const datos = <?= json_encode($datos ?? []) ?>;

    const etiquetas = datos.map(d => d.anio);
    const totales = datos.map(d => Number(d.total_personal || 0));
    const promedios = datos.map(d => Number(d.promedio_personal || 0));

    const ctx = document.getElementById("graficaComunidad");

    if (ctx && datos.length > 0) {
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: etiquetas,
                datasets: [
                    {
                        label: "Total de Personal",
                        data: totales,
                        backgroundColor: "#17a2b8aa",
                        borderColor: "#138496",
                        borderWidth: 2
                    },
                    {
                        label: "Promedio del Año",
                        data: promedios,
                        type: "line",
                        borderColor: "#dc3545",
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3
                    }
                ]
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

});
</script>

<?php include 'partials/footer.php'; ?>