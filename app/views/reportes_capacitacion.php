<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h3 class="text-center text-danger mb-4">
        Reporte de Capacitación
    </h3>

    <!-- ====== TABLA ====== -->
    <div class="card shadow mb-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Resumen por Año</h5>
        </div>

        <div class="card-body">
            <?php if (empty($datos)): ?>
                <div class="alert alert-warning text-center">No hay datos para mostrar.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-danger">
                            <tr>
                                <th>Año</th>
                                <th>Total Capacitados</th>
                                <th>Hombres</th>
                                <th>Mujeres</th>
                                <th>% Hombres</th>
                                <th>% Mujeres</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($datos as $row): 
                            $total = (float)$row['total_capacitados'];
                            $h = (float)$row['hombres'];
                            $m = (float)$row['mujeres'];

                            $porcH = $total > 0 ? ($h / $total) * 100 : 0;
                            $porcM = $total > 0 ? ($m / $total) * 100 : 0;
                        ?>
                            <tr>
                                <td><?= $row['año'] ?></td>
                                <td><?= number_format($total, 0) ?></td>
                                <td><?= number_format($h, 0) ?></td>
                                <td><?= number_format($m, 0) ?></td>
                                <td><?= number_format($porcH, 1) ?>%</td>
                                <td><?= number_format($porcM, 1) ?>%</td>
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
            <h5 class="mb-0">Gráfica: Hombres vs Mujeres Capacitados por Año</h5>
        </div>
        <div class="card-body">
            <canvas id="graficaCapacitacion" height="120"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const datos = <?= json_encode($datos) ?>;

    const etiquetas = datos.map(d => d.año);
    const hombres = datos.map(d => d.hombres);
    const mujeres = datos.map(d => d.mujeres);

    const ctx = document.getElementById("graficaCapacitacion");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: etiquetas,
            datasets: [
                {
                    label: "Hombres",
                    data: hombres,
                    backgroundColor: "#007bffaa",
                    borderColor: "#0056b3",
                    borderWidth: 2
                },
                {
                    label: "Mujeres",
                    data: mujeres,
                    backgroundColor: "#e91e63aa",
                    borderColor: "#c2185b",
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
