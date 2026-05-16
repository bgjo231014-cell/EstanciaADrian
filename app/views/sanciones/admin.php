<?php
$sanciones = $sanciones ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Sanciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="public/css/sanciones.css">
</head>

<body>

<div class="topbar d-flex justify-content-between align-items-center">

    <div>
        <h3 class="m-0">CECAM / Estancia - UPEMOR</h3>
        <small>Panel Administrativo de Sanciones</small>
    </div>

    <div class="d-flex gap-2">

        <a href="index.php" class="btn btn-outline-light">
            Inicio
        </a>

        <button
            class="btn btn-light"
            data-bs-toggle="modal"
            data-bs-target="#modalAgregar"
        >
            Nueva sanción
        </button>

    </div>

</div>

<div class="container mt-4">

    <div class="row g-3">

        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h2 class="text-primary">
                        <?= count($sanciones) ?>
                    </h2>

                    <p class="m-0">
                        Total de sanciones
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h2 class="text-danger">
                        <?= count(array_filter($sanciones, fn($s) => $s['estado_sancion'] === 'Pendiente')) ?>
                    </h2>

                    <p class="m-0">
                        Pendientes
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h2 class="text-warning">
                        <?= count(array_filter($sanciones, fn($s) => $s['estado_sancion'] === 'En proceso')) ?>
                    </h2>

                    <p class="m-0">
                        En proceso
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h2 class="text-success">
                        <?= count(array_filter($sanciones, fn($s) => $s['estado_sancion'] === 'Liberado')) ?>
                    </h2>

                    <p class="m-0">
                        Liberadas
                    </p>

                </div>

            </div>

        </div>

    </div>

    <div class="search-card mt-4">

        <div class="row g-3">

            <div class="col-md-4">

                <input
                    type="text"
                    id="searchInput"
                    class="form-control"
                    placeholder="Buscar por matrícula o nombre"
                >

            </div>

            <div class="col-md-3">

                <select id="filterEstado" class="form-select">

                    <option value="">Todos los estados</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Liberado">Liberado</option>
                    <option value="Congelado">Congelado</option>

                </select>

            </div>

        </div>

    </div>

    <div class="resultado-card mt-4">

        <div class="table-responsive">

            <table class="table table-hover align-middle" id="tablaSanciones">

                <thead class="table-success">

                    <tr>

                        <th>ID</th>
                        <th>Matrícula</th>
                        <th>Alumno</th>
                        <th>Carrera</th>
                        <th>Grupo</th>
                        <th>Tipo</th>
                        <th>Horas</th>
                        <th>Liberadas</th>
                        <th>Restantes</th>
                        <th>Penalización</th>
                        <th>Estado</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($sanciones as $s): ?>

                    <?php

                        $estadoClass = 'bg-danger';

                        if($s['estado_sancion'] === 'En proceso'){
                            $estadoClass = 'bg-warning text-dark';
                        }

                        if($s['estado_sancion'] === 'Liberado'){
                            $estadoClass = 'bg-success';
                        }

                        if($s['estado_sancion'] === 'Congelado'){
                            $estadoClass = 'bg-primary';
                        }

                    ?>

                    <tr>

                        <td><?= $s['id_sancion'] ?></td>

                        <td><?= htmlspecialchars($s['matricula']) ?></td>

                        <td><?= htmlspecialchars($s['nombre_alumno']) ?></td>

                        <td><?= htmlspecialchars($s['carrera']) ?></td>

                        <td><?= htmlspecialchars($s['grupo']) ?></td>

                        <td><?= htmlspecialchars($s['tipo_incidencia']) ?></td>

                        <td><?= (int)($s['horas_totales'] ?? 0) ?></td>

                        <td><?= (int)($s['horas_liberadas'] ?? 0) ?></td>

                        <td><?= (int)($s['horas_restantes'] ?? 0) ?></td>

                        <td><?= (int)($s['horas_penalizacion'] ?? 0) ?></td>

                        <td>

                            <span class="badge <?= $estadoClass ?>">
                                <?= htmlspecialchars($s['estado_sancion']) ?>
                            </span>

                        </td>

                        <td>

                            <button
    class="btn btn-sm btn-primary btnLiberar"
    data-id="<?= $s['id_sancion'] ?>"
    data-alumno="<?= htmlspecialchars($s['nombre_alumno'], ENT_QUOTES) ?>"
    data-bs-toggle="modal"
    data-bs-target="#modalLiberar"
>
    Liberar
</button>

<button
    class="btn btn-sm btn-warning"
>
    Editar
</button>

<?php if ((int)$s['penalizacion_congelada'] === 1): ?>

    <a
        href="index.php?view=sanciones&action=reactivar&id=<?= $s['id_sancion'] ?>"
        class="btn btn-sm btn-info"
        onclick="return confirm('¿Reactivar penalización para este alumno?')"
    >
        Reactivar
    </a>

<?php else: ?>

    <button
        class="btn btn-sm btn-secondary btnCongelar"
        data-id="<?= $s['id_sancion'] ?>"
        data-alumno="<?= htmlspecialchars($s['nombre_alumno'], ENT_QUOTES) ?>"
        data-bs-toggle="modal"
        data-bs-target="#modalCongelar"
    >
        Congelar
    </button>

<?php endif; ?>

<a
    href="index.php?view=sanciones&action=historial&id=<?= $s['id_sancion'] ?>"
    class="btn btn-sm btn-dark"
>
    Historial
</a>

<a
    href="index.php?view=sanciones&action=eliminar&id=<?= $s['id_sancion'] ?>"
    class="btn btn-sm btn-danger"
    onclick="return confirm('¿Eliminar sanción?')"
>
    Eliminar
</a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL AGREGAR -->

<div
    class="modal fade"
    id="modalAgregar"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg">

        <form
            method="POST"
            action="index.php?view=sanciones&action=agregar"
            class="modal-content"
        >

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">
                    Nueva Sanción
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label>Matrícula</label>

                        <input
                            type="text"
                            name="matricula"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label>Nombre del alumno</label>

                        <input
                            type="text"
                            name="nombre_alumno"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-4">

                        <label>Carrera</label>

                        <input
                            type="text"
                            name="carrera"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-4">

                        <label>Grupo</label>

                        <input
                            type="text"
                            name="grupo"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-4">

                        <label>Cuatrimestre</label>

                        <input
                            type="text"
                            name="cuatrimestre"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label>Fecha de incidencia</label>

                        <input
                            type="date"
                            name="fecha_incidencia"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label>Tipo de incidencia</label>

                        <input
                            type="text"
                            name="tipo_incidencia"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-12">

                        <label>Descripción</label>

                        <textarea
                            name="descripcion"
                            class="form-control"
                            rows="3"
                            required
                        ></textarea>

                    </div>

                    <div class="col-md-4">

                        <label>Horas base</label>

                        <input
                            type="number"
                            name="horas_base"
                            class="form-control"
                            min="1"
                            required
                        >

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Cancelar
                </button>

                <button class="btn btn-success">
                    Guardar sanción
                </button>

            </div>

        </form>

    </div>

</div>
<!-- MODAL LIBERAR HORAS -->
<div class="modal fade" id="modalLiberar" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="index.php?view=sanciones&action=liberar" class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Liberar horas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id_sancion" id="liberar_id">

                <p>
                    Alumno:
                    <strong id="liberar_alumno"></strong>
                </p>

                <div class="mb-3">
                    <label>Fecha de servicio</label>
                    <input type="date" name="fecha_servicio" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Hora de entrada</label>
                    <input type="time" name="hora_entrada" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Hora de salida</label>
                    <input type="time" name="hora_salida" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Horas liberadas</label>
                    <input type="number" step="0.5" min="0.5" name="horas_liberadas" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Actividad realizada</label>
                    <textarea name="actividad_realizada" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Guardar liberación</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL CONGELAR PENALIZACIÓN -->
<div class="modal fade" id="modalCongelar" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="index.php?view=sanciones&action=congelar" class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title">Congelar penalización</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id_sancion" id="congelar_id">

                <p>
                    Alumno:
                    <strong id="congelar_alumno"></strong>
                </p>

                <div class="mb-3">
                    <label>Motivo de congelación</label>
                    <textarea name="motivo_congelacion" class="form-control" rows="4" required></textarea>
                </div>

                <div class="alert alert-info">
                    Mientras esté congelada, esta sanción no generará penalizaciones por tiempo.
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-secondary">Congelar penalización</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".btnLiberar").forEach(btn => {
        btn.addEventListener("click", () => {

            document.getElementById("liberar_id").value =
                btn.dataset.id;

            document.getElementById("liberar_alumno").textContent =
                btn.dataset.alumno;
        });
    });

    document.querySelectorAll(".btnCongelar").forEach(btn => {
        btn.addEventListener("click", () => {

            document.getElementById("congelar_id").value =
                btn.dataset.id;

            document.getElementById("congelar_alumno").textContent =
                btn.dataset.alumno;
        });
    });

});
</script>
</body>
</html>