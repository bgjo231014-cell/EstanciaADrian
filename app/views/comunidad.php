<?php
// app/views/comunidad.php
$comunidades = $comunidades ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Comunidad - CECAM</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/comunidad.css">
</head>

<body>

<header class="bg-success text-white text-center py-3">
  <h3>CECAM - Gestión de Comunidad</h3>
</header>

<div class="container mt-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Registros de Comunidad</h4>

    <div>
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
  <h5 class="bg-warning text-dark p-2 rounded">Comunidad universitaria</h5>

  <div class="table-responsive">
    <table class="table table-striped text-center align-middle tabla-comunidad">
      <thead class="table-success">
        <tr>
          <th>Año</th>
          <th>Mes</th>
          <th>Descripción</th>
          <th>Admvos</th>
          <th>PTCs</th>
          <th>Honorarios</th>
          <th>PA</th>
          <th>Jardineros</th>
          <th>Limpieza</th>
          <th>Maestros</th>
          <th>Vigilancias</th>
          <th>Licenciaturas</th>
          <th>Posgrados</th>
          <th>Total personal</th>
          <th>Promedio</th>
          <th>Fecha creación</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($comunidades as $c): ?>
          <tr
            data-year="<?= (int)$c['año'] ?>"
            data-admvos="<?= htmlspecialchars($c['admvos'] ?? 0, ENT_QUOTES) ?>"
            data-ptcs="<?= htmlspecialchars($c['ptcs'] ?? 0, ENT_QUOTES) ?>"
            data-honorarios="<?= htmlspecialchars($c['honorarios'] ?? 0, ENT_QUOTES) ?>"
            data-pa="<?= htmlspecialchars($c['pa'] ?? 0, ENT_QUOTES) ?>"
            data-jardineros="<?= htmlspecialchars($c['jardineros'] ?? 0, ENT_QUOTES) ?>"
            data-limpieza="<?= htmlspecialchars($c['limpieza'] ?? 0, ENT_QUOTES) ?>"
            data-maestros="<?= htmlspecialchars($c['maestros'] ?? 0, ENT_QUOTES) ?>"
            data-vigilancias="<?= htmlspecialchars($c['vigilancias'] ?? 0, ENT_QUOTES) ?>"
            data-licenciaturas="<?= htmlspecialchars($c['licenciaturas'] ?? 0, ENT_QUOTES) ?>"
            data-posgrados="<?= htmlspecialchars($c['posgrados'] ?? 0, ENT_QUOTES) ?>"
          >
            <td><?= htmlspecialchars($c['año'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['mes'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['descripcion'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['admvos'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['ptcs'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['honorarios'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['pa'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['jardineros'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['limpieza'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['maestros'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['vigilancias'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['licenciaturas'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['posgrados'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['total_personal'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['promedio'] ?? 0) ?></td>
            <td><?= htmlspecialchars($c['fecha_creacion'] ?? '') ?></td>

            <td>
              <button class="btn btn-warning btn-sm btnEditar"
                data-id_comunidad="<?= htmlspecialchars($c['id_comunidad'] ?? '', ENT_QUOTES) ?>"
                data-año="<?= htmlspecialchars($c['año'] ?? '', ENT_QUOTES) ?>"
                data-mes="<?= htmlspecialchars($c['mes'] ?? '', ENT_QUOTES) ?>"
                data-descripcion="<?= htmlspecialchars($c['descripcion'] ?? '', ENT_QUOTES) ?>"
                data-admvos="<?= htmlspecialchars($c['admvos'] ?? 0, ENT_QUOTES) ?>"
                data-ptcs="<?= htmlspecialchars($c['ptcs'] ?? 0, ENT_QUOTES) ?>"
                data-honorarios="<?= htmlspecialchars($c['honorarios'] ?? 0, ENT_QUOTES) ?>"
                data-pa="<?= htmlspecialchars($c['pa'] ?? 0, ENT_QUOTES) ?>"
                data-jardineros="<?= htmlspecialchars($c['jardineros'] ?? 0, ENT_QUOTES) ?>"
                data-limpieza="<?= htmlspecialchars($c['limpieza'] ?? 0, ENT_QUOTES) ?>"
                data-maestros="<?= htmlspecialchars($c['maestros'] ?? 0, ENT_QUOTES) ?>"
                data-vigilancias="<?= htmlspecialchars($c['vigilancias'] ?? 0, ENT_QUOTES) ?>"
                data-licenciaturas="<?= htmlspecialchars($c['licenciaturas'] ?? 0, ENT_QUOTES) ?>"
                data-posgrados="<?= htmlspecialchars($c['posgrados'] ?? 0, ENT_QUOTES) ?>"
                data-bs-toggle="modal"
                data-bs-target="#modalEditar">
                Editar
              </button>

              <a href="index.php?view=comunidad&action=eliminar&id=<?= htmlspecialchars($c['id_comunidad'] ?? '') ?>"
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
  // ================================
  // ORDENAR REGISTROS POR AÑO Y MES
  // ================================
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

  $registrosOrdenados = $comunidades;

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

  // Cada 4 registros forman un cuatrimestre
  $cuatrimestres = array_chunk($registrosOrdenados, 4);
  ?>

  <!-- TOTALES Y PROMEDIOS POR MES -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">
    Totales y Promedios por Mes
  </h5>

  <div class="table-responsive mb-4">
    <table class="table table-striped text-center align-middle">
      <thead class="table-success">
        <tr>
          <th>Año</th>
          <th>Mes</th>
          <th>Total del mes</th>
          <th>Promedio del mes</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($registrosOrdenados as $registro): ?>
          <tr>
            <td><?= htmlspecialchars($registro['año'] ?? '') ?></td>
            <td><?= htmlspecialchars($registro['mes'] ?? '') ?></td>
            <td><?= number_format((float)($registro['total_personal'] ?? 0), 2) ?></td>
            <td><?= number_format((float)($registro['promedio'] ?? 0), 2) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- TOTALES Y PROMEDIOS POR CUATRIMESTRE -->
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
        </tr>
      </thead>

      <tbody>
        <?php foreach ($cuatrimestres as $index => $grupo): ?>
          <?php
            $totalCuatrimestre = 0;

            foreach ($grupo as $registro) {
                $totalCuatrimestre += (float)($registro['total_personal'] ?? 0);
            }

            $cantidadMeses = count($grupo);

            $promedioCuatrimestre = $cantidadMeses > 0
                ? $totalCuatrimestre / $cantidadMeses
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
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- GRÁFICA -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">
    Gráfica: Distribución de comunidad
  </h5>

  <div class="card shadow-sm mx-auto" style="max-width:650px;">
    <div class="card-body" style="height:300px;">
      <canvas id="graficaTotales"></canvas>
    </div>
  </div>

</div>

<!-- MODAL AGREGAR -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
  <div class="modal-dialog modal-xl">

    <form method="POST" action="index.php?view=comunidad&action=crear" class="modal-content">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Agregar Registro de Comunidad</h5>
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

        <h6 class="text-success fw-bold mt-3">Personal y comunidad</h6>

        <div class="row g-2">
          <div class="col-md-3">
            <label class="form-label">Admvos</label>
            <input type="number" step="0.01" class="form-control" name="admvos" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">PTCs</label>
            <input type="number" step="0.01" class="form-control" name="ptcs" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Honorarios</label>
            <input type="number" step="0.01" class="form-control" name="honorarios" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">PA</label>
            <input type="number" step="0.01" class="form-control" name="pa" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Jardineros</label>
            <input type="number" step="0.01" class="form-control" name="jardineros" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Limpieza</label>
            <input type="number" step="0.01" class="form-control" name="limpieza" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Maestros</label>
            <input type="number" step="0.01" class="form-control" name="maestros" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Vigilancias</label>
            <input type="number" step="0.01" class="form-control" name="vigilancias" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Licenciaturas</label>
            <input type="number" step="0.01" class="form-control" name="licenciaturas" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Posgrados</label>
            <input type="number" step="0.01" class="form-control" name="posgrados" min="0" required>
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

    <form method="POST" action="index.php?view=comunidad&action=editar" class="modal-content">

      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Editar Registro de Comunidad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" name="id_comunidad" id="edit_id_comunidad">

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

        <h6 class="text-success fw-bold mt-3">Personal y comunidad</h6>

        <div class="row g-2">
          <div class="col-md-3">
            <label class="form-label">Admvos</label>
            <input type="number" step="0.01" class="form-control" name="admvos" id="edit_admvos" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">PTCs</label>
            <input type="number" step="0.01" class="form-control" name="ptcs" id="edit_ptcs" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Honorarios</label>
            <input type="number" step="0.01" class="form-control" name="honorarios" id="edit_honorarios" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">PA</label>
            <input type="number" step="0.01" class="form-control" name="pa" id="edit_pa" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Jardineros</label>
            <input type="number" step="0.01" class="form-control" name="jardineros" id="edit_jardineros" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Limpieza</label>
            <input type="number" step="0.01" class="form-control" name="limpieza" id="edit_limpieza" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Maestros</label>
            <input type="number" step="0.01" class="form-control" name="maestros" id="edit_maestros" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Vigilancias</label>
            <input type="number" step="0.01" class="form-control" name="vigilancias" id="edit_vigilancias" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Licenciaturas</label>
            <input type="number" step="0.01" class="form-control" name="licenciaturas" id="edit_licenciaturas" min="0" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Posgrados</label>
            <input type="number" step="0.01" class="form-control" name="posgrados" id="edit_posgrados" min="0" required>
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
<script src="public/js/comunidad.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

  const mesesValidos = [
    'enero','febrero','marzo','abril','mayo','junio',
    'julio','agosto','septiembre','octubre','noviembre','diciembre'
  ];

  const formAgregar = document.querySelector('form[action="index.php?view=comunidad&action=crear"]');
  const formEditar = document.querySelector('form[action="index.php?view=comunidad&action=editar"]');

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

    const campos = form.querySelectorAll('input[required]');
    let vacio = false;

    campos.forEach(campo => {
      if (campo.value.trim() === '') {
        vacio = true;
      }
    });

    if (vacio) {
      alert('Todos los campos obligatorios deben llenarse antes de guardar.');
      e.preventDefault();
    }
  }

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

});
</script>

</body>
</html>