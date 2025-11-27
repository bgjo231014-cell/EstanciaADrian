<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h3 class="text-center text-success mb-4">
        Reporte de Comunidad
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Resumen General por Año</h5>
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
                                <th>Promedio de Personal</th>
                                <th>Total Personal (3 Meses)</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($datos as $row): ?>
                            <tr>
                                <td><?= $row['año'] ?></td>
                                <td><?= number_format($row['promedio_personal'], 2) ?></td>
                                <td><?= number_format($row['total_personal'], 0) ?></td>
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

    const datos = <?= json_encode($datos) ?>;

    const etiquetas = datos.map(d => d.año);
    const totales = datos.map(d => d.total_personal);
    const promedios = datos.map(d => d.promedio_personal);

    const ctx = document.getElementById("graficaComunidad");

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
                y: { beginAtZero: true }
            }
        }
    });

});
</script>

<?php include 'partials/footer.php'; ?>
