<?php
// ======================= FORMATEADOR DE FECHAS EN ESPAÑOL ======================
function fecha_ES($fecha)
{
    if (!$fecha) return '';
    $ts = strtotime($fecha);
    if (!$ts) return $fecha;

    $meses = [
        'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
        'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
    ];

    $dia  = date('j', $ts);
    $mesN = (int) date('n', $ts) - 1;
    $anio = date('Y', $ts);

    $mes = $meses[$mesN] ?? '';
    return "$dia de $mes de $anio";
}

function mes_anio_ES($fecha)
{
    if (!$fecha) return '';
    $ts = strtotime($fecha);
    if (!$ts) return $fecha;

    $meses = [
        'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
        'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
    ];

    $mesN = (int) date('n', $ts) - 1;
    $anio = date('Y', $ts);
    $mes = $meses[$mesN] ?? '';

    return "$mes $anio";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión RSU - CECAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/rsu.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header class="bg-success text-white text-center py-3">
    <h3>CECAM - Gestión de Residuos Sólidos Urbanos (RSU)</h3>
</header>

<div class="container mt-4">

    <!-- ENCABEZADO -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Registros de Residuos Sólidos</h4>
        <div class="d-flex gap-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Registro</button>
            <a href="index.php?view=dashboard_admin" class="btn btn-secondary">Regresar al Panel</a>
        </div>
    </div>

    <!-- BUSCADOR -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group search-container">
                <span class="input-group-text"></span>
                <input type="month" id="searchInput" class="form-control" placeholder="Buscar por mes...">
            </div>
        </div>
    </div>

    <!-- SECCIÓN -->
    <div class="section-header">Materiales Reciclados por Mes</div>

    <!-- TABLA 1 -->
    <div class="tabla-container">
        <table class="table table-striped text-center align-middle tabla-rsu tabla-rsu-1">
            <thead class="table-success">
                <tr>
                    <th>Mes</th>
                    <th>Papel</th>
                    <th>Periódico</th>
                    <th>Toallas</th>
                    <th>Cartón</th>
                    <th>PET</th>
                    <th>Otros Plásticos</th>
                    <th>Vidrio</th>
                    <th>Aluminio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $r): ?>
                <tr data-mes="<?= date('Y-m-d', strtotime($r['mes'])) ?>">
                    <td><strong><?= $r['mes'] ?></strong></td>
                    <td><?= number_format($r['papel_kg'], 2) ?> kg</td>
                    <td><?= number_format($r['periodico_kg'], 2) ?> kg</td>
                    <td><?= number_format($r['toalla_manos_kg'], 2) ?> kg</td>
                    <td><?= number_format($r['carton_kg'], 2) ?> kg</td>
                    <td><?= number_format($r['pet_kg'], 2) ?> kg</td>
                    <td><?= number_format($r['otros_plasticos_kg'], 2) ?> kg</td>
                    <td><?= number_format($r['vidrio_kg'], 2) ?> kg</td>
                    <td><?= number_format($r['aluminio_kg'], 2) ?> kg</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- TABLA 2 -->
    <div class="tabla-container mt-3">
        <table class="table table-striped text-center align-middle tabla-rsu tabla-rsu-2">
            <thead class="table-success">
                <tr>
                    <th>Hojalata</th>
                    <th>Fierro</th>
                    <th>Total Mes</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $r): ?>
                <tr 
                    data-id="<?= $r['id'] ?>"
                    data-mes="<?= date('Y-m-d', strtotime($r['mes'])) ?>"
                    data-papel_kg="<?= $r['papel_kg'] ?>"
                    data-periodico_kg="<?= $r['periodico_kg'] ?>"
                    data-toalla_manos_kg="<?= $r['toalla_manos_kg'] ?>"
                    data-carton_kg="<?= $r['carton_kg'] ?>"
                    data-pet_kg="<?= $r['pet_kg'] ?>"
                    data-otros_plasticos_kg="<?= $r['otros_plasticos_kg'] ?>"
                    data-vidrio_kg="<?= $r['vidrio_kg'] ?>"
                    data-aluminio_kg="<?= $r['aluminio_kg'] ?>"
                    data-hojalata_kg="<?= $r['hojalata_kg'] ?>"
                    data-fierro_kg="<?= $r['fierro_kg'] ?>"
                >
                    <td><?= number_format($r['hojalata_kg'], 2) ?> kg</td>
                    <td><?= number_format($r['fierro_kg'], 2) ?> kg</td>
                    <td><span class="badge-total"><?= number_format($r['total_registro'], 2) ?> kg</span></td>
                    <!-- fecha_creacion ya formateada correctamente -->
                    <td><small><?= fecha_ES($r['fecha_creacion']) ?></small></td>

                    <td>
                        <div class="btn-group-vertical btn-group-sm">
                            <button 
                                class="btn btn-warning btn-sm btnEditar"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditar">
                                Editar
                            </button>

                            <a href="index.php?view=rsu&action=eliminar&id=<?= $r['id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Estás seguro?');">
                                Eliminar
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- MÉTRICAS -->
    <div class="section-header mt-5">Métricas Ambientales y Acumulados</div>

    <div class="tabla-container">
        <table class="table table-striped text-center align-middle tabla-metricas">
            <thead class="table-info">
                <tr>
                    <th>Mes</th>
                    <th>Total del Mes</th>
                    <th>Total Cuatrimestre</th>
                    <th>kg CO₂/persona/cuatrimestre</th>
                    <th>Tn cuatrimestre</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $totalGeneral = 0;
            foreach ($registros as $r) $totalGeneral += $r['total_registro'];
            ?>

            <?php foreach ($registros as $r): ?>
            <tr data-mes="<?= date('Y-m-d', strtotime($r['mes'])) ?>">
                <td><strong><?= mes_anio_ES($r['mes']) ?></strong></td>
                <td><span class="badge bg-primary"><?= number_format($r['total_registro'], 2) ?> kg</span></td>
                <td><span class="badge bg-success"><?= number_format($r['total_cuatrimestre'], 2) ?> kg</span></td>
                <td><span class="badge-co2"><?= number_format($r['kg_co2_persona_cuatrimestre'], 2) ?> kg CO₂</span></td>
                <td><span class="badge-toneladas"><?= number_format($r['tn_cuatrimestre'], 2) ?> tn</span></td>
            </tr>
            <?php endforeach; ?>
            </tbody>

            <tfoot class="table-dark">
                <tr>
                    <td><strong>TOTAL GENERAL</strong></td>
                    <td><strong><?= number_format($totalGeneral, 2) ?> kg</strong></td>
                    <td>-</td>
                    <td>-</td>
                    <td><strong><?= number_format($totalGeneral / 1000, 2) ?> tn</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- TARJETAS -->
    <div class="impacto-container mt-4">
        <div class="row">
            <div class="col-md-3"><div class="impacto-card total-reciclado">
                <h3><?= number_format($totalGeneral, 2) ?> kg</h3><p>Total Reciclado</p></div></div>

            <div class="col-md-3"><div class="impacto-card co2-evitado">
                <h3><?= number_format($totalGeneral / 2.5, 2) ?> kg</h3><p>CO₂ Evitado</p></div></div>

            <div class="col-md-3"><div class="impacto-card toneladas">
                <h3><?= number_format($totalGeneral / 1000, 2) ?> tn</h3><p>En Toneladas</p></div></div>

            <div class="col-md-3"><div class="impacto-card registros">
                <h3><?= count($registros) ?></h3><p>Registros</p></div></div>
        </div>
    </div>

    <!-- GRÁFICA -->
    <div class="grafica-container fade-in mt-5">
        <div class="grafica-header">
            <h4>Distribución de Materiales Reciclados</h4>
            <p>Análisis visual de los residuos por tipo</p>
        </div>

        <div class="grafica-wrapper">
            <canvas id="graficaMateriales"></canvas>
        </div>
    </div>
</div>

<!-- ===================== MODAL AGREGAR ===================== -->
<div class="modal fade" id="modalAgregar">
    <div class="modal-dialog modal-lg">
        <form id="formAgregarRsu" method="POST" action="index.php?view=rsu&action=crear" class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5>Agregar Registro RSU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <?php
                    $inputs = [
                        'Mes'              => 'mes|date|required',
                        'Papel (kg)'       => 'papel_kg|number|required',
                        'Periódico (kg)'   => 'periodico_kg|number|required',
                        'Toallas (kg)'     => 'toalla_manos_kg|number|required',
                        'Cartón (kg)'      => 'carton_kg|number|required',
                        'PET (kg)'         => 'pet_kg|number|required',
                        'Otros Plásticos (kg)' => 'otros_plasticos_kg|number|required',
                        'Vidrio (kg)'      => 'vidrio_kg|number|required',
                        'Aluminio (kg)'    => 'aluminio_kg|number|required',
                        'Hojalata (kg)'    => 'hojalata_kg|number|required',
                        'Fierro (kg)'      => 'fierro_kg|number|required'
                    ];
                    ?>

                    <?php foreach ($inputs as $label => $info):
                        [$name, $type, $req] = array_pad(explode('|', $info), 3, '');
                    ?>
                        <div class="col-md-6">
                            <label class="form-label"><?= $label ?></label>
                            <input
                                type="<?= $type ?>"
                                class="form-control"
                                name="<?= $name ?>"
                                step="0.01"
                                min="0"
                                <?php if ($name === 'mes'): ?>
                                    min="2000-01-01"
                                    max="2100-12-31"
                                <?php endif; ?>
                                <?= $req === 'required' ? 'required' : '' ?>
                            >
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- ===================== MODAL EDITAR ===================== -->
<div class="modal fade" id="modalEditar">
    <div class="modal-dialog modal-lg">
        <form id="formEditarRsu" method="POST" action="index.php?view=rsu&action=editar" class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5>Editar Registro RSU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="edit_id">

                <div class="row g-3">
                    <?php foreach ($inputs as $label => $info):
                        [$name, $type] = explode('|', $info);
                    ?>
                        <div class="col-md-6">
                            <label class="form-label"><?= $label ?></label>
                            <input
                                type="<?= $type ?>"
                                class="form-control"
                                name="<?= $name ?>"
                                id="edit_<?= $name ?>"
                                step="0.01"
                                min="0"
                                <?php if ($name === 'mes'): ?>
                                    min="2000-01-01"
                                    max="2100-12-31"
                                <?php endif; ?>
                                required
                            >
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<footer class="text-center bg-light border-top py-3 mt-4">
    © 2025 CECAM | Sistema de Gestión Ambiental
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ===================== VALIDACIÓN EN LA VISTA ===================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    function validarFormularioRSU(form) {
        const camposNumericos = [
            'papel_kg', 'periodico_kg', 'toalla_manos_kg', 'carton_kg',
            'pet_kg', 'otros_plasticos_kg', 'vidrio_kg', 'aluminio_kg',
            'hojalata_kg', 'fierro_kg'
        ];

        // Validar fecha
        const inputMes = form.querySelector('input[name="mes"]');
        if (!inputMes || !inputMes.value) {
            alert("El campo 'Mes' es obligatorio.");
            if (inputMes) inputMes.focus();
            return false;
        }
        const fecha = new Date(inputMes.value);
        if (isNaN(fecha.getTime())) {
            alert("El campo 'Mes' debe ser una fecha válida.");
            inputMes.focus();
            return false;
        }
        const year = fecha.getFullYear();
        if (year < 2000 || year > 2100) {
            alert("El año del campo 'Mes' debe estar entre 2000 y 2100.");
            inputMes.focus();
            return false;
        }

        // Validar campos numéricos
        for (const nombre of camposNumericos) {
            const input = form.querySelector('input[name="' + nombre + '"]');
            if (!input) continue;

            const valorTexto = input.value.trim();

            if (valorTexto === '') {
                alert("El campo '" + nombre.replace('_kg', '') + "' no puede estar vacío.");
                input.focus();
                return false;
            }

            const valorNum = Number(valorTexto);
            if (isNaN(valorNum)) {
                alert("El campo '" + nombre.replace('_kg', '') + "' debe ser numérico.");
                input.focus();
                return false;
            }

            if (valorNum < 0) {
                alert("El campo '" + nombre.replace('_kg', '') + "' no puede ser negativo.");
                input.focus();
                return false;
            }
        }

        return true;
    }

    const formAgregar = document.getElementById('formAgregarRsu');
    if (formAgregar) {
        formAgregar.addEventListener('submit', function (e) {
            if (!validarFormularioRSU(this)) {
                e.preventDefault();
            }
        });
    }

    const formEditar = document.getElementById('formEditarRsu');
    if (formEditar) {
        formEditar.addEventListener('submit', function (e) {
            if (!validarFormularioRSU(this)) {
                e.preventDefault();
            }
        });
    }

});
</script>

<script src="public/js/rsu.js"></script>
</body>
</html>
