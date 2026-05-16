<?php
$resultados = $resultados ?? [];
$matricula = $matricula ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Sanciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="public/css/sanciones.css">
</head>

<body>

<div class="topbar d-flex justify-content-between align-items-center">
    <div>
        <h3 class="m-0">CECAM / Estancia - UPEMOR</h3>
        <small>Consulta Pública de Sanciones</small>
    </div>

    <a href="index.php" class="btn btn-outline-light">
        Volver al inicio
    </a>
</div>

<div class="container">

    <div class="text-center mt-5">
        <h1>Consulta de Sanciones</h1>

        <p>
            Sistema de Gestión de Sanciones y Servicio Comunitario
        </p>
    </div>

    <div class="search-card">

        <h3>Consulta tu estado de sanción</h3>

        <form method="GET" class="row mt-4">

            <input type="hidden" name="view" value="consulta_sancion">

            <div class="col-md-10">

                <input
                    type="text"
                    name="matricula"
                    class="form-control form-control-lg"
                    placeholder="Ingresa tu matrícula"
                    value="<?= htmlspecialchars($matricula) ?>"
                    required
                >

            </div>

            <div class="col-md-2 d-grid">

                <button class="btn btn-success btn-lg">
                    Buscar
                </button>

            </div>

        </form>

    </div>

    <?php if(!empty($resultados)): ?>

        <?php foreach($resultados as $r): ?>

            <?php
                $estadoClass = 'pendiente';

                if($r['estado_sancion'] === 'En proceso'){
                    $estadoClass = 'proceso';
                }

                if($r['estado_sancion'] === 'Liberado'){
                    $estadoClass = 'liberado';
                }

                if($r['estado_sancion'] === 'Congelado'){
                    $estadoClass = 'congelado';
                }
            ?>

            <div class="resultado-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h2>
                            <?= htmlspecialchars($r['nombre_alumno']) ?>
                        </h2>

                        <p class="text-muted">
                            Matrícula:
                            <?= htmlspecialchars($r['matricula']) ?>
                        </p>

                    </div>

                    <div>

                        <span class="badge-estado <?= $estadoClass ?>">
                            <?= htmlspecialchars($r['estado_sancion']) ?>
                        </span>

                    </div>

                </div>

                <hr>

                <div class="row mt-4">

                    <div class="col-md-4">
                        <strong>Carrera</strong>

                        <p>
                            <?= htmlspecialchars($r['carrera']) ?>
                        </p>
                    </div>

                    <div class="col-md-4">

                        <strong>Grupo</strong>

                        <p>
                            <?= htmlspecialchars($r['grupo']) ?>
                        </p>

                    </div>

                    <div class="col-md-4">

                        <strong>Tipo de incidencia</strong>

                        <p>
                            <?= htmlspecialchars($r['tipo_incidencia']) ?>
                        </p>

                    </div>

                </div>

                <div class="row mt-4 text-center">

                    <div class="col-md-3 stat">

                        <h2 class="text-warning">
                            <?= (int)($r['horas_totales'] ?? 0) ?>
                        </h2>

                        <p>Horas Totales</p>

                    </div>

                    <div class="col-md-3 stat">

                        <h2 class="text-success">
                            <?= (int)($r['horas_liberadas'] ?? 0) ?>
                        </h2>

                        <p>Horas Liberadas</p>

                    </div>

                    <div class="col-md-3 stat">

                        <h2 class="text-danger">
                            <?= (int)($r['horas_restantes'] ?? 0) ?>
                        </h2>

                        <p>Horas Restantes</p>

                    </div>

                    <div class="col-md-3 stat">

                        <h2 class="text-primary">
                            <?= (int)($r['horas_penalizacion'] ?? 0) ?>
                        </h2>

                        <p>Horas por retraso</p>

                    </div>

                </div>

                <?php if(($r['horas_penalizacion'] ?? 0) > 0): ?>

                    <div class="warning-box">

                        <strong>Atención:</strong>

                        Se han agregado horas automáticas
                        por exceder el tiempo límite de liberación.

                    </div>

                <?php endif; ?>

            </div>

        <?php endforeach; ?>

    <?php elseif($matricula !== ''): ?>

        <div class="alert alert-danger mt-4">
            No se encontraron sanciones para esa matrícula.
        </div>

    <?php endif; ?>

</div>

</body>
</html>