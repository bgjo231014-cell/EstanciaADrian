<?php include 'partials/header.php'; ?>

<div class="container mt-4">
    <h3 class="text-center text-danger mb-4">
        Reporte de Capacitación
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Resumen por Año</h5>

            <a href="index.php?view=dashboard_admin" class="btn btn-secondary">
                Regresar al Panel
            </a>
        </div>

        <div class="card-body">
            <?php if (empty($datos)): ?>
                <div class="alert alert-warning text-center">
                    No hay datos para mostrar.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
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
                        <?php foreach ($datos as $row): ?>
                            <?php
                                $totalCapacitados = (float)($row['total_capacitados'] ?? 0);
                                $totalVerdadero = (float)($row['total_verdadero'] ?? 0);
                                $hombres = (float)($row['hombres'] ?? 0);
                                $mujeres = (float)($row['mujeres'] ?? 0);

                                $porcentajeHombres = (float)($row['porcentaje_hombres'] ?? 0);
                                $porcentajeMujeres = (float)($row['porcentaje_mujeres'] ?? 0);
                            ?>

                            <tr>
                                <td><?= htmlspecialchars($row['anio'] ?? '') ?></td>
                                <td><?= number_format((float)($row['total_registros'] ?? 0), 0) ?></td>
                                <td><?= number_format($totalCapacitados, 0) ?></td>
                                <td><?= number_format($totalVerdadero, 0) ?></td>
                                <td><?= number_format($hombres, 0) ?></td>
                                <td><?= number_format($mujeres, 0) ?></td>
                                <td><?= number_format($porcentajeHombres, 2) ?>%</td>
                                <td><?= number_format($porcentajeMujeres, 2) ?>%</td>
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
    const datos = <?= json_encode($datos ?? []) ?>;

    const etiquetas = datos.map(d => d.anio);
    const hombres = datos.map(d => Number(d.hombres || 0));
    const mujeres = datos.map(d => Number(d.mujeres || 0));
    const totales = datos.map(d => Number(d.total_capacitados || 0));

    const ctx = document.getElementById("graficaCapacitacion");

    if (ctx && datos.length > 0) {
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
                    },
                    {
                        label: "Total Capacitados",
                        data: totales,
                        type: "line",
                        borderColor: "#28a745",
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