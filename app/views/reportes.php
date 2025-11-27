<?php
include 'partials/header.php';

// Seguridad
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php?view=login");
    exit();
}
?>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h2 class="text-success">📊 Reportes del Sistema</h2>
        <p class="lead text-secondary">
            Elige un módulo para generar y descargar reportes ambientales.
        </p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">

        <div class="col">
            <div class="card h-100 shadow-sm border-success">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Combustibles</h5>
                    <p class="card-text">Consumo mensual, anual y emisiones generadas.</p>
<a href="index.php?controller=reportes&action=combustibles" class="btn btn-success">
    Ver Reporte
</a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-warning">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">Residuos Sólidos (RSU)</h5>
                    <p class="card-text">Materiales reciclados, CO₂ evitado y toneladas generadas.</p>
                    <a href="index.php?controller=reportes&action=rsu" class="btn btn-warning text-white">
                        Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-info">
                <div class="card-body text-center">
                    <h5 class="card-title text-info">Comunidad</h5>
                    <p class="card-text">Participación institucional y personal.</p>
                    <a href="index.php?controller=reportes&action=comunidad" class="btn btn-info text-white">
                        Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Agua</h5>
                    <p class="card-text">Consumo, costos y calidad del agua descargada.</p>
                    <a href="index.php?controller=reportes&action=agua" class="btn btn-primary">
                        Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-secondary">
                <div class="card-body text-center">
                    <h5 class="card-title text-secondary">Electricidad</h5>
                    <p class="card-text">Consumo energético, costos y eficiencia ambiental.</p>
                    <a href="index.php?controller=reportes&action=electricidad" class="btn btn-secondary">
                        Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm border-danger">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger">Capacitación</h5>
                    <p class="card-text">Estadísticas de formación y asistencia institucional.</p>
                    <a href="index.php?controller=reportes&action=capacitacion" class="btn btn-danger">
                        Ver Reporte
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
    <div class="card h-100 shadow-sm border-dark">
        <div class="card-body text-center">
            <h5 class="card-title text-dark">Reporte General</h5>
            <p class="card-text">Resumen completo de todas las gestiones ambientales.</p>
            <a href="index.php?view=reportes_general" class="btn btn-dark">
                Ver Reporte General
            </a>
        </div>
    </div>
</div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
