<?php
// app/views/capacitacion.php
$capacitaciones = $capacitaciones ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Capacitación - CECAM</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/capa.css">
</head>

<body>

<header class="bg-success text-white text-center py-3">
  <h3>CECAM - Gestión de Capacitación</h3>
</header>

<div class="container mt-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Registros de Capacitación</h4>

    <div class="d-flex gap-2">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">
        Agregar Registro
      </button>

      <a href="index.php?view=dashboard_admin" class="btn btn-secondary">
        Regresar al Panel
      </a>
    </div>
  </div>

  <!-- BUSCADOR -->
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-text">Buscar año</span>
        <input type="number" id="searchInput" class="form-control" placeholder="Ejemplo: 2025">
      </div>
    </div>
  </div>

  <!-- TABLA PRINCIPAL -->
  <!-- TABLA PRINCIPAL 1 -->
<h5 class="bg-warning text-dark p-2 rounded">Capacitaciones - Datos principales</h5>

<div class="table-responsive mb-4">
  <table class="table table-striped text-center align-middle tabla-capacitacion">
    <thead class="table-success">
      <tr>
        <th>Año</th>
        <th>Mes</th>
        <th>Descripción</th>
        <th>Admvos</th>
        <th>PTCs</th>
        <th>Honorarios</th>
        <th>PA</th>
        <th>Docentes</th>
        <th>Jardineros</th>
        <th>Servicio limpieza</th>
        <th>Seguridad</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($capacitaciones as $c): ?>
        <tr
          data-year="<?= (int)($c['año'] ?? 0) ?>"
          data-admvos="<?= htmlspecialchars($c['admvos'] ?? 0, ENT_QUOTES) ?>"
          data-ptcs="<?= htmlspecialchars($c['ptcs'] ?? 0, ENT_QUOTES) ?>"
          data-honorarios="<?= htmlspecialchars($c['honorarios'] ?? 0, ENT_QUOTES) ?>"
          data-pa="<?= htmlspecialchars($c['pa'] ?? 0, ENT_QUOTES) ?>"
          data-docentes="<?= htmlspecialchars($c['docentes'] ?? 0, ENT_QUOTES) ?>"
          data-jardineros="<?= htmlspecialchars($c['jardineros'] ?? 0, ENT_QUOTES) ?>"
          data-servicio_limpieza="<?= htmlspecialchars($c['servicio_limpieza'] ?? 0, ENT_QUOTES) ?>"
          data-seguridad="<?= htmlspecialchars($c['seguridad'] ?? 0, ENT_QUOTES) ?>"
          data-visitantes="<?= htmlspecialchars($c['visitantes'] ?? 0, ENT_QUOTES) ?>"
          data-personas_externas_capacitadas="<?= htmlspecialchars($c['personas_externas_capacitadas'] ?? 0, ENT_QUOTES) ?>"
        >
          <td><?= htmlspecialchars($c['año'] ?? '') ?></td>
          <td><?= htmlspecialchars($c['mes'] ?? '') ?></td>
          <td><?= htmlspecialchars($c['descripcion'] ?? '') ?></td>
          <td><?= htmlspecialchars($c['admvos'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['ptcs'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['honorarios'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['pa'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['docentes'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['jardineros'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['servicio_limpieza'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['seguridad'] ?? 0) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


<!-- TABLA PRINCIPAL 2 -->
<h5 class="bg-warning text-dark p-2 rounded">Capacitaciones - Totales y acciones</h5>

<div class="table-responsive mb-4">
  <table class="table table-striped text-center align-middle tabla-capacitacion">
    <thead class="table-success">
      <tr>
        <th>Año</th>
        <th>Mes</th>
        <th>Visitantes</th>
        <th>Personas externas</th>
        <th>Total capacitación</th>
        <th>Hombres</th>
        <th>Mujeres</th>
        <th>% Hombres</th>
        <th>% Mujeres</th>
        <th>Fecha creación</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($capacitaciones as $c): ?>
        <tr data-year="<?= (int)($c['año'] ?? 0) ?>">
          <td><?= htmlspecialchars($c['año'] ?? '') ?></td>
          <td><?= htmlspecialchars($c['mes'] ?? '') ?></td>
          <td><?= htmlspecialchars($c['visitantes'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['personas_externas_capacitadas'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['cantidad_total_capa'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['cantidad_hombres'] ?? 0) ?></td>
          <td><?= htmlspecialchars($c['cantidad_mujeres'] ?? 0) ?></td>
          <td><?= number_format((float)($c['porcentaje_hombres'] ?? 0), 2) ?>%</td>
          <td><?= number_format((float)($c['porcentaje_mujeres'] ?? 0), 2) ?>%</td>
          <td><?= htmlspecialchars($c['fecha_creacion'] ?? '') ?></td>

          <td>
            <button class="btn btn-warning btn-sm btnEditar"
              data-id_capacitacion="<?= htmlspecialchars($c['id_capacitacion'] ?? '', ENT_QUOTES) ?>"
              data-anio="<?= htmlspecialchars($c['año'] ?? '', ENT_QUOTES) ?>"
              data-mes="<?= htmlspecialchars($c['mes'] ?? '', ENT_QUOTES) ?>"
              data-descripcion="<?= htmlspecialchars($c['descripcion'] ?? '', ENT_QUOTES) ?>"
              data-admvos="<?= htmlspecialchars($c['admvos'] ?? 0, ENT_QUOTES) ?>"
              data-ptcs="<?= htmlspecialchars($c['ptcs'] ?? 0, ENT_QUOTES) ?>"
              data-honorarios="<?= htmlspecialchars($c['honorarios'] ?? 0, ENT_QUOTES) ?>"
              data-pa="<?= htmlspecialchars($c['pa'] ?? 0, ENT_QUOTES) ?>"
              data-docentes="<?= htmlspecialchars($c['docentes'] ?? 0, ENT_QUOTES) ?>"
              data-jardineros="<?= htmlspecialchars($c['jardineros'] ?? 0, ENT_QUOTES) ?>"
              data-servicio_limpieza="<?= htmlspecialchars($c['servicio_limpieza'] ?? 0, ENT_QUOTES) ?>"
              data-seguridad="<?= htmlspecialchars($c['seguridad'] ?? 0, ENT_QUOTES) ?>"
              data-visitantes="<?= htmlspecialchars($c['visitantes'] ?? 0, ENT_QUOTES) ?>"
              data-personas_externas_capacitadas="<?= htmlspecialchars($c['personas_externas_capacitadas'] ?? 0, ENT_QUOTES) ?>"
              data-cantidad_hombres="<?= htmlspecialchars($c['cantidad_hombres'] ?? 0, ENT_QUOTES) ?>"
              data-cantidad_mujeres="<?= htmlspecialchars($c['cantidad_mujeres'] ?? 0, ENT_QUOTES) ?>"
              data-bs-toggle="modal"
              data-bs-target="#modalEditar">
              Editar
            </button>

            <a href="index.php?view=capacitacion&action=eliminar&id=<?= htmlspecialchars($c['id_capacitacion'] ?? '') ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('¿Eliminar este registro?');">
              Eliminar
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div id="noResults" class="alert alert-warning text-center" style="display:none;">
  No se encontraron registros para ese año.
</div>


  <?php
  $ordenMeses = [
      'enero' => 1,
      'febrero' => 2,
      'marzo' => 3,
      'abril' => 4,
      'mayo' => 5,
      'junio' => 6,
      'julio' => 7,
      'agosto' => 8,
      'septiembre' => 9,
      'octubre' => 10,
      'noviembre' => 11,
      'diciembre' => 12
  ];

  $registrosOrdenados = $capacitaciones;

  usort($registrosOrdenados, function ($a, $b) use ($ordenMeses) {
      $anioA = (int)($a['año'] ?? 0);
      $anioB = (int)($b['año'] ?? 0);

      if ($anioA === $anioB) {
          $mesA = strtolower(trim($a['mes'] ?? ''));
          $mesB = strtolower(trim($b['mes'] ?? ''));

          return ($ordenMeses[$mesA] ?? 0) <=> ($ordenMeses[$mesB] ?? 0);
      }

      return $anioA <=> $anioB;
  });

  $cuatrimestres = array_chunk($registrosOrdenados, 4);
  ?>

  <!-- TOTALES POR MES -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">
    Totales y Promedios por Mes
  </h5>

  <div class="table-responsive mb-4">
    <table class="table table-striped text-center align-middle">
      <thead class="table-success">
        <tr>
          <th>Año</th>
          <th>Mes</th>
          <th>Total capacitación</th>
          <th>Total verdadero final</th>
          <th>Hombres</th>
          <th>Mujeres</th>
          <th>% Hombres</th>
          <th>% Mujeres</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($registrosOrdenados as $registro): ?>
          <tr>
            <td><?= htmlspecialchars($registro['año'] ?? '') ?></td>
            <td><?= htmlspecialchars($registro['mes'] ?? '') ?></td>
            <td><?= number_format((float)($registro['cantidad_total_capa'] ?? 0), 2) ?></td>
            <td><?= number_format((float)($registro['total_verdadero_final'] ?? 0), 2) ?></td>
            <td><?= htmlspecialchars($registro['cantidad_hombres'] ?? 0) ?></td>
            <td><?= htmlspecialchars($registro['cantidad_mujeres'] ?? 0) ?></td>
            <td><?= number_format((float)($registro['porcentaje_hombres'] ?? 0), 2) ?>%</td>
            <td><?= number_format((float)($registro['porcentaje_mujeres'] ?? 0), 2) ?>%</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- TOTALES POR CUATRIMESTRE -->

<h5 class="bg-warning text-dark p-2 rounded mt-4">
  Totales y Promedios por Cuatrimestre
</h5>

<div class="table-responsive mb-4">
  <table class="table table-striped text-center align-middle">
    <thead class="table-success">
      <tr>
        <th>Cuatrimestre</th>
        <th>Periodo</th>
        <th>Total del cuatrimestre</th>
        <th>Promedio del cuatrimestre</th>
        <th>Total hombres</th>
        <th>Total mujeres</th>
        <th>% Hombres</th>
        <th>% Mujeres</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($cuatrimestres as $index => $grupo): ?>
        <?php
          $totalCuatrimestre = 0;
          $totalHombres = 0;
          $totalMujeres = 0;

          foreach ($grupo as $registro) {
              $totalCuatrimestre += (float)($registro['cantidad_total_capa'] ?? 0);
              $totalHombres += (float)($registro['cantidad_hombres'] ?? 0);
              $totalMujeres += (float)($registro['cantidad_mujeres'] ?? 0);
          }

          $cantidadMeses = count($grupo);

          $promedioCuatrimestre = $cantidadMeses > 0
              ? $totalCuatrimestre / $cantidadMeses
              : 0;

          $totalGenero = $totalHombres + $totalMujeres;

          $porcentajeHombres = $totalGenero > 0
              ? ($totalHombres / $totalGenero) * 100
              : 0;

          $porcentajeMujeres = $totalGenero > 0
              ? ($totalMujeres / $totalGenero) * 100
              : 0;

          $primerRegistro = $grupo[0];
          $ultimoRegistro = $grupo[$cantidadMeses - 1];

          $periodo = ($primerRegistro['mes'] ?? '') . ' ' . ($primerRegistro['año'] ?? '') .
                     ' - ' .
                     ($ultimoRegistro['mes'] ?? '') . ' ' . ($ultimoRegistro['año'] ?? '');
        ?>

        <tr>
          <td>Cuatrimestre <?= $index + 1 ?></td>
          <td><?= htmlspecialchars($periodo) ?></td>
          <td><?= number_format($totalCuatrimestre, 2) ?></td>
          <td><?= number_format($promedioCuatrimestre, 2) ?></td>
          <td><?= number_format($totalHombres, 0) ?></td>
          <td><?= number_format($totalMujeres, 0) ?></td>
          <td><?= number_format($porcentajeHombres, 2) ?>%</td>
          <td><?= number_format($porcentajeMujeres, 2) ?>%</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

  <!-- GRÁFICA -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">
    Gráfica: Distribución de Capacitación
  </h5>

  <div class="card shadow-sm mx-auto" style="max-width:650px;">
    <div class="card-body" style="height:320px;">
      <canvas id="graficaCapacitacion"></canvas>
    </div>
  </div>

</div>

<!-- MODAL AGREGAR -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
  <div class="modal-dialog modal-xl">

    <form method="POST" action="index.php?view=capacitacion&action=crear" class="modal-content">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Agregar Registro de Capacitación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <h6 class="text-success fw-bold">Información general</h6>

        <div class="row g-2 mb-3">
          <div class="col-md-3">
            <label class="form-label">Año</label>
            <input type="number" min="2000" max="2100" class="form-control" name="año" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Mes</label>
            <input type="text" class="form-control" name="mes" placeholder="Ejemplo: Enero" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" placeholder="Descripción del registro" required>
          </div>
        </div>

        <h6 class="text-success fw-bold">Participantes</h6>

        <div class="row g-2">
          <div class="col-md-3">
            <label class="form-label">Admvos</label>
            <input type="number" class="form-control" name="admvos" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">PTCs</label>
            <input type="number" class="form-control" name="ptcs" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Honorarios</label>
            <input type="number" class="form-control" name="honorarios" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">PA</label>
            <input type="number" class="form-control" name="pa" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Docentes</label>
            <input type="number" class="form-control" name="docentes" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Jardineros</label>
            <input type="number" class="form-control" name="jardineros" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Servicio limpieza</label>
            <input type="number" class="form-control" name="servicio_limpieza" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Seguridad</label>
            <input type="number" class="form-control" name="seguridad" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Visitantes</label>
            <input type="number" class="form-control" name="visitantes" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Personas externas capacitadas</label>
            <input type="number" class="form-control" name="personas_externas_capacitadas" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Cantidad hombres</label>
            <input type="number" class="form-control" name="cantidad_hombres" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Cantidad mujeres</label>
            <input type="number" class="form-control" name="cantidad_mujeres" min="0" required>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Cancelar
        </button>

        <button type="submit" class="btn btn-success">
          Guardar
        </button>
      </div>

    </form>

  </div>
</div>

<!-- MODAL EDITAR -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog modal-xl">

    <form method="POST" action="index.php?view=capacitacion&action=editar" class="modal-content">

      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Editar Registro de Capacitación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" name="id_capacitacion" id="edit_id_capacitacion">

        <h6 class="text-success fw-bold">Información general</h6>

        <div class="row g-2 mb-3">
          <div class="col-md-3">
            <label class="form-label">Año</label>
            <input type="number" min="2000" max="2100" class="form-control" name="año" id="edit_año" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Mes</label>
            <input type="text" class="form-control" name="mes" id="edit_mes" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" id="edit_descripcion" required>
          </div>
        </div>

        <h6 class="text-success fw-bold">Participantes</h6>

        <div class="row g-2">
          <div class="col-md-3">
            <label class="form-label">Admvos</label>
            <input type="number" class="form-control" name="admvos" id="edit_admvos" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">PTCs</label>
            <input type="number" class="form-control" name="ptcs" id="edit_ptcs" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Honorarios</label>
            <input type="number" class="form-control" name="honorarios" id="edit_honorarios" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">PA</label>
            <input type="number" class="form-control" name="pa" id="edit_pa" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Docentes</label>
            <input type="number" class="form-control" name="docentes" id="edit_docentes" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Jardineros</label>
            <input type="number" class="form-control" name="jardineros" id="edit_jardineros" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Servicio limpieza</label>
            <input type="number" class="form-control" name="servicio_limpieza" id="edit_servicio_limpieza" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Seguridad</label>
            <input type="number" class="form-control" name="seguridad" id="edit_seguridad" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Visitantes</label>
            <input type="number" class="form-control" name="visitantes" id="edit_visitantes" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Personas externas capacitadas</label>
            <input type="number" class="form-control" name="personas_externas_capacitadas" id="edit_personas_externas_capacitadas" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Cantidad hombres</label>
            <input type="number" class="form-control" name="cantidad_hombres" id="edit_cantidad_hombres" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Cantidad mujeres</label>
            <input type="number" class="form-control" name="cantidad_mujeres" id="edit_cantidad_mujeres" min="0" required>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Cancelar
        </button>

        <button type="submit" class="btn btn-warning">
          Guardar Cambios
        </button>
      </div>

    </form>

  </div>
</div>

<footer class="text-center bg-light border-top py-3 mt-4">
  © 2025 CECAM | Sistema de Gestión Ambiental
</footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

  const mesesValidos = [
    'enero','febrero','marzo','abril','mayo','junio',
    'julio','agosto','septiembre','octubre','noviembre','diciembre'
  ];

  const searchInput = document.getElementById('searchInput');
  const filas = document.querySelectorAll('.tabla-capacitacion tbody tr');
  const noResults = document.getElementById('noResults');

  function actualizarFiltro() {
    const year = searchInput ? searchInput.value.trim() : '';
    let found = false;

    filas.forEach(row => {
      const rowYear = row.getAttribute('data-year') || '';

      if (!year || rowYear.startsWith(year)) {
        row.style.display = '';
        found = true;
      } else {
        row.style.display = 'none';
      }
    });

    if (noResults) {
      noResults.style.display = (year && !found) ? 'block' : 'none';
    }
  }

  if (searchInput) {
    searchInput.addEventListener('input', actualizarFiltro);
  }

  const btnsEditar = document.querySelectorAll('.btnEditar');

  btnsEditar.forEach(btn => {
    btn.addEventListener('click', () => {
      const get = (name) => btn.dataset[name] ?? '';

      const campos = [
        'id_capacitacion',
        'mes',
        'descripcion',
        'admvos',
        'ptcs',
        'honorarios',
        'pa',
        'docentes',
        'jardineros',
        'servicio_limpieza',
        'seguridad',
        'visitantes',
        'personas_externas_capacitadas',
        'cantidad_hombres',
        'cantidad_mujeres'
      ];

      const editAnio = document.getElementById('edit_año');
      if (editAnio) editAnio.value = get('anio');

      campos.forEach(campo => {
        const input = document.getElementById('edit_' + campo);
        if (input) {
          input.value = get(campo);
        }
      });
    });
  });

  function validarFormulario(form, e) {
    const anio = form.querySelector('[name="año"]').value.trim();
    const mes = form.querySelector('[name="mes"]').value.trim().toLowerCase();

    if (anio === '' || isNaN(anio) || anio < 2000 || anio > 2100) {
      alert('El año debe estar entre 2000 y 2100.');
      e.preventDefault();
      return;
    }

    if (!mesesValidos.includes(mes)) {
      alert('El mes debe ser un nombre válido en español. Ejemplo: enero, febrero, marzo.');
      e.preventDefault();
      return;
    }

    const obligatorios = form.querySelectorAll('input[required]');
    let vacio = false;

    obligatorios.forEach(input => {
      if (input.value.trim() === '') {
        vacio = true;
      }
    });

    if (vacio) {
      alert('Todos los campos obligatorios deben llenarse.');
      e.preventDefault();
    }
  }

  const formAgregar = document.querySelector('form[action="index.php?view=capacitacion&action=crear"]');
  const formEditar = document.querySelector('form[action="index.php?view=capacitacion&action=editar"]');

  if (formAgregar) {
    formAgregar.addEventListener('submit', function(e) {
      validarFormulario(formAgregar, e);
    });
  }

  if (formEditar) {
    formEditar.addEventListener('submit', function(e) {
      validarFormulario(formEditar, e);
    });
  }

  // GRÁFICA
  const canvas = document.getElementById('graficaCapacitacion');

  if (canvas && typeof Chart !== 'undefined') {
    let totalAdmvos = 0;
    let totalPtcs = 0;
    let totalHonorarios = 0;
    let totalPa = 0;
    let totalDocentes = 0;
    let totalJardineros = 0;
    let totalLimpieza = 0;
    let totalSeguridad = 0;
    let totalVisitantes = 0;
    let totalExternos = 0;

    filas.forEach(row => {
      totalAdmvos += parseFloat(row.dataset.admvos || 0);
      totalPtcs += parseFloat(row.dataset.ptcs || 0);
      totalHonorarios += parseFloat(row.dataset.honorarios || 0);
      totalPa += parseFloat(row.dataset.pa || 0);
      totalDocentes += parseFloat(row.dataset.docentes || 0);
      totalJardineros += parseFloat(row.dataset.jardineros || 0);
      totalLimpieza += parseFloat(row.dataset.servicio_limpieza || 0);
      totalSeguridad += parseFloat(row.dataset.seguridad || 0);
      totalVisitantes += parseFloat(row.dataset.visitantes || 0);
      totalExternos += parseFloat(row.dataset.personas_externas_capacitadas || 0);
    });

    new Chart(canvas, {
      type: 'pie',
      data: {
        labels: [
          'Admvos',
          'PTCs',
          'Honorarios',
          'PA',
          'Docentes',
          'Jardineros',
          'Servicio limpieza',
          'Seguridad',
          'Visitantes',
          'Personas externas'
        ],
        datasets: [{
          data: [
            totalAdmvos,
            totalPtcs,
            totalHonorarios,
            totalPa,
            totalDocentes,
            totalJardineros,
            totalLimpieza,
            totalSeguridad,
            totalVisitantes,
            totalExternos
          ],
          backgroundColor: [
            'rgba(46, 204, 113, 0.8)',
            'rgba(52, 152, 219, 0.8)',
            'rgba(155, 89, 182, 0.8)',
            'rgba(241, 196, 15, 0.8)',
            'rgba(230, 126, 34, 0.8)',
            'rgba(26, 188, 156, 0.8)',
            'rgba(231, 76, 60, 0.8)',
            'rgba(52, 73, 94, 0.8)',
            'rgba(127, 140, 141, 0.8)',
            'rgba(22, 160, 133, 0.8)'
          ],
          borderColor: '#ffffff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'right'
          },
          title: {
            display: true,
            text: 'Distribución total de capacitación'
          }
        }
      }
    });
  }

});
</script>

</body>
</html>