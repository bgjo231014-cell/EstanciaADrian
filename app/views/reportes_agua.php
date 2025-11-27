<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h3 class="text-center text-primary mb-4">
        Reporte de Consumo de Agua
    </h3>

    <!-- ====== TABLA ====== -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Resumen por Año</h5>
        </div>

        <div class="card-body">
            <?php if (empty($datos)): ?>
                <div class="alert alert-warning text-center">No hay datos para mostrar.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>Año</th>
                                <th>Total de m³ Consumidos</th>
                                <th>Costo Total ($)</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($datos as $row): ?>
                            <tr>
                                <td><?= $row['anio'] ?></td>
                                <td><?= number_format($row['total_m3'], 2) ?></td>
                                <td>$<?= number_format($row['total_costo'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ====== GRÁFICA ====== -->
    <div class="card shadow mb-5">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Gráfica: Consumo Total de Agua (m³)</h5>
        </div>

        <div class="card-body">
            <canvas id="graficaAgua" height="120"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const datos = <?= json_encode($datos) ?>;

    const etiquetas = datos.map(d => d.anio);
    const metros = datos.map(d => d.total_m3);
    const costos = datos.map(d => d.total_costo);

    const ctx = document.getElementById("graficaAgua");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: etiquetas,
            datasets: [
                {
                    label: "m³ Consumidos",
                    data: metros,
                    backgroundColor: "#007bff99",
                    borderColor: "#0056b3",
                    borderWidth: 2
                },
                {
                    label: "Costo Total ($)",
                    data: costos,
                    type: "line",
                    borderColor: "#ff5733",
                    borderWidth: 3,
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
