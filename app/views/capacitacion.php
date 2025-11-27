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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header class="bg-success text-white text-center py-3">
<h3>CECAM - Gestión de Capacitación</h3>
</header>

<div class="container mt-4">
  <!-- ENCABEZADO -->
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
        <span class="input-group-text">Año</span>
        <input type="number" id="searchInput" class="form-control" placeholder="Buscar por año...">
      </div>
    </div>
  </div>

  <!-- TABLA 1: CAMPOS PRINCIPALES -->
  <h5 class="bg-warning text-dark p-2 rounded">Campos Principales</h5>
  <table class="table table-striped text-center align-middle tabla-capacitacion">
    <thead class="table-success">
      <tr>
        <th>Año</th>
        <th>Mes 1</th>
        <th>Mes 2</th>
        <th>Mes 3</th>
        <th>Admvo (1)</th>
        <th>Admvo (2)</th>
        <th>Admvo (3)</th>
        <th>PTC (1)</th>
        <th>PTC (2)</th>
        <th>PTC (3)</th>
        <th>Honorarios (1)</th>
        <th>Honorarios (2)</th>
        <th>Honorarios (3)</th>
        <th>PA (1)</th>
        <th>PA (2)</th>
        <th>PA (3)</th>
        <th>Externos (1)</th>
        <th>Externos (2)</th>
        <th>Externos (3)</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($capacitaciones as $c): ?>
      <tr data-year="<?= (int)$c['año'] ?>">
        <td><?= $c['año'] ?></td>
        <td><?= htmlspecialchars($c['mes_1']) ?></td>
        <td><?= htmlspecialchars($c['mes_2']) ?></td>
        <td><?= htmlspecialchars($c['mes_3']) ?></td>
        <td><?= $c['admvo1'] ?></td>
        <td><?= $c['admvo2'] ?></td>
        <td><?= $c['admvo3'] ?></td>
        <td><?= $c['PTC1'] ?></td>
        <td><?= $c['PTC2'] ?></td>
        <td><?= $c['PTC3'] ?></td>
        <td><?= $c['Honorarios1'] ?></td>
        <td><?= $c['Honorarios2'] ?></td>
        <td><?= $c['Honorarios3'] ?></td>
        <td><?= $c['PA1'] ?></td>
        <td><?= $c['PA2'] ?></td>
        <td><?= $c['PA3'] ?></td>
        <td><?= $c['personas_externas_capacitadas1'] ?></td>
        <td><?= $c['personas_externas_capacitadas2'] ?></td>
        <td><?= $c['personas_externas_capacitadas3'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- TABLA 2: PARTICIPANTES Y SERVICIOS -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">Participantes y Servicios</h5>
  <table class="table table-striped text-center align-middle tabla-capacitacion">
    <thead class="table-success">
      <tr>
        <th>Servicios (1)</th>
        <th>Servicios (2)</th>
        <th>Servicios (3)</th>
        <th>Alumnos (1)</th>
        <th>Alumnos (2)</th>
        <th>Alumnos (3)</th>
        <th>Visitantes (1)</th>
        <th>Visitantes (2)</th>
        <th>Visitantes (3)</th>
        <th>Fecha Creación</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($capacitaciones as $c): ?>
      <tr data-year="<?= (int)$c['año'] ?>">
        <td><?= $c['Servicios1'] ?></td>
        <td><?= $c['Servicios2'] ?></td>
        <td><?= $c['Servicios3'] ?></td>
        <td><?= $c['Alumnos1'] ?></td>
        <td><?= $c['Alumnos2'] ?></td>
        <td><?= $c['Alumnos3'] ?></td>
        <td><?= $c['Visitantes1'] ?></td>
        <td><?= $c['Visitantes2'] ?></td>
        <td><?= $c['Visitantes3'] ?></td>
        <td><?= $c['fecha_creacion'] ?></td>
        <td>
          <button class="btn btn-warning btn-sm btnEditar"
              data-id="<?= $c['id_capacitacion'] ?>"
              data-año="<?= $c['año'] ?>"
              data-mes_1="<?= htmlspecialchars($c['mes_1'], ENT_QUOTES) ?>"
              data-mes_2="<?= htmlspecialchars($c['mes_2'], ENT_QUOTES) ?>"
              data-mes_3="<?= htmlspecialchars($c['mes_3'], ENT_QUOTES) ?>"
              data-admvo1="<?= $c['admvo1'] ?>"
              data-admvo2="<?= $c['admvo2'] ?>"
              data-admvo3="<?= $c['admvo3'] ?>"
              data-ptc1="<?= $c['PTC1'] ?>"
              data-ptc2="<?= $c['PTC2'] ?>"
              data-ptc3="<?= $c['PTC3'] ?>"
              data-honorarios1="<?= $c['Honorarios1'] ?>"
              data-honorarios2="<?= $c['Honorarios2'] ?>"
              data-honorarios3="<?= $c['Honorarios3'] ?>"
              data-pa1="<?= $c['PA1'] ?>"
              data-pa2="<?= $c['PA2'] ?>"
              data-pa3="<?= $c['PA3'] ?>"
              data-servicios1="<?= $c['Servicios1'] ?>"
              data-servicios2="<?= $c['Servicios2'] ?>"
              data-servicios3="<?= $c['Servicios3'] ?>"
              data-alumnos1="<?= $c['Alumnos1'] ?>"
              data-alumnos2="<?= $c['Alumnos2'] ?>"
              data-alumnos3="<?= $c['Alumnos3'] ?>"
              data-visitantes1="<?= $c['Visitantes1'] ?>"
              data-visitantes2="<?= $c['Visitantes2'] ?>"
              data-visitantes3="<?= $c['Visitantes3'] ?>"
              data-externos1="<?= $c['personas_externas_capacitadas1'] ?>"
              data-externos2="<?= $c['personas_externas_capacitadas2'] ?>"
              data-externos3="<?= $c['personas_externas_capacitadas3'] ?>"
              data-hombres="<?= $c['cantidad_hombres'] ?>"
              data-mujeres="<?= $c['cantidad_mujeres'] ?>"
              data-bs-toggle="modal" data-bs-target="#modalEditar">
              Editar
          </button>
          <a href="index.php?controller=capacitacion&action=eliminar&id=<?= $c['id_capacitacion'] ?>" 
             class="btn btn-danger btn-sm"
             onclick="return confirm('¿Eliminar este registro?');">
              Eliminar
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- TABLA 3: TOTALES EMPÍRICOS -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">Totales Empíricos</h5>
  <table class="table table-striped text-center align-middle tabla-capacitacion">
    <thead class="table-success">
      <tr>
        <th>Total Capacitadas 1° mes</th>
        <th>Total Capacitadas 2° mes</th>
        <th>Total Capacitadas 3° mes</th>
        <th>Total Empírico</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($capacitaciones as $c): ?>
      <tr data-year="<?= (int)$c['año'] ?>">
        <td><?= $c['Cantidad_totalCapa1'] ?></td>
        <td><?= $c['Cantidad_totalCapa2'] ?></td>
        <td><?= $c['Cantidad_totalCapa3'] ?></td>
        <td><?= $c['Total_empirico'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- TABLA 4: CÁLCULOS -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">Cálculo del Número Real</h5>
  <table class="table table-striped text-center align-middle tabla-capacitacion">
    <thead class="table-success">
      <tr>
        <th>Calculo Verdadero (1)</th>
        <th>Calculo Verdadero (2)</th>
        <th>Calculo Verdadero (3)</th>
        <th>Total Verdadero Final</th>
        <th>Hombres</th>
        <th>Mujeres</th>
        <th>% Hombres</th>
        <th>% Mujeres</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($capacitaciones as $c): ?>
      <tr data-year="<?= (int)$c['año'] ?>">
        <td><?= $c['Calculo_total_verdadero1'] ?></td>
        <td><?= $c['Calculo_total_verdadero2'] ?></td>
        <td><?= $c['Calculo_total_verdadero3'] ?></td>
        <td><?= $c['total_verdaderoFinal'] ?></td>
        <td><?= $c['cantidad_hombres'] ?></td>
        <td><?= $c['cantidad_mujeres'] ?></td>
        <td><?= $c['porcentaje_hombres'] ?>%</td>
        <td><?= $c['porcentaje_mujeres'] ?>%</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- MODAL AGREGAR -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <form method="POST" action="index.php?controller=capacitacion&action=agregar" class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Agregar Registro de Capacitación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- CAMPOS PRINCIPALES COMPLETOS -->
        <h6 class="text-success fw-bold category-title">Campos Principales</h6>
        <div class="row g-3 mb-3">
          <div class="col-md-3">
            <label class="form-label">Año</label>
            <input type="number" step="1" min="2000" class="form-control" name="año" placeholder="Año" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Mes 1</label>
            <input type="text" class="form-control" name="mes_1" placeholder="Mes 1">
          </div>
          <div class="col-md-3">
            <label class="form-label">Mes 2</label>
            <input type="text" class="form-control" name="mes_2" placeholder="Mes 2">
          </div>
          <div class="col-md-3">
            <label class="form-label">Mes 3</label>
            <input type="text" class="form-control" name="mes_3" placeholder="Mes 3">
          </div>
        </div>

        <!-- PERSONAL -->
        <h6 class="text-success fw-bold category-title">Personal</h6>
        <div class="row g-3 mb-3">
          <!-- ADMVO -->
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Admvo</h6>
            <input type="number" class="form-control mb-2" name="admvo1" placeholder="Admvo 1" min="0">
            <input type="number" class="form-control mb-2" name="admvo2" placeholder="Admvo 2" min="0">
            <input type="number" class="form-control mb-2" name="admvo3" placeholder="Admvo 3" min="0">
          </div>

          <!-- PTC -->
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">PTC</h6>
            <input type="number" class="form-control mb-2" name="PTC1" placeholder="PTC 1" min="0">
            <input type="number" class="form-control mb-2" name="PTC2" placeholder="PTC 2" min="0">
            <input type="number" class="form-control mb-2" name="PTC3" placeholder="PTC 3" min="0">
          </div>

          <!-- HONORARIOS -->
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Honorarios</h6>
            <input type="number" class="form-control mb-2" name="Honorarios1" placeholder="Honorarios 1" min="0">
            <input type="number" class="form-control mb-2" name="Honorarios2" placeholder="Honorarios 2" min="0">
            <input type="number" class="form-control mb-2" name="Honorarios3" placeholder="Honorarios 3" min="0">
          </div>
        </div>

        <!-- PERSONAL ADICIONAL -->
        <div class="row g-3 mb-3">
          <!-- PA -->
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">PA</h6>
            <input type="number" class="form-control mb-2" name="PA1" placeholder="PA 1" min="0">
            <input type="number" class="form-control mb-2" name="PA2" placeholder="PA 2" min="0">
            <input type="number" class="form-control mb-2" name="PA3" placeholder="PA 3" min="0">
          </div>

          <!-- PERSONAS EXTERNAS -->
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Personas Externas</h6>
            <input type="number" class="form-control mb-2" name="personas_externas_capacitadas1" placeholder="Externos 1" min="0">
            <input type="number" class="form-control mb-2" name="personas_externas_capacitadas2" placeholder="Externos 2" min="0">
            <input type="number" class="form-control mb-2" name="personas_externas_capacitadas3" placeholder="Externos 3" min="0">
          </div>
        </div>

        <hr>

        <!-- PARTICIPANTES -->
        <h6 class="text-success fw-bold category-title">Participantes</h6>
        <div class="row g-3 mb-3">
          <!-- SERVICIOS -->
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Servicios</h6>
            <input type="number" class="form-control mb-2" name="Servicios1" placeholder="Servicios 1" min="0">
            <input type="number" class="form-control mb-2" name="Servicios2" placeholder="Servicios 2" min="0">
            <input type="number" class="form-control mb-2" name="Servicios3" placeholder="Servicios 3" min="0">
          </div>

          <!-- ALUMNOS -->
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Alumnos</h6>
            <input type="number" class="form-control mb-2" name="Alumnos1" placeholder="Alumnos 1" min="0">
            <input type="number" class="form-control mb-2" name="Alumnos2" placeholder="Alumnos 2" min="0">
            <input type="number" class="form-control mb-2" name="Alumnos3" placeholder="Alumnos 3" min="0">
          </div>

          <!-- VISITANTES -->
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Visitantes</h6>
            <input type="number" class="form-control mb-2" name="Visitantes1" placeholder="Visitantes 1" min="0">
            <input type="number" class="form-control mb-2" name="Visitantes2" placeholder="Visitantes 2" min="0">
            <input type="number" class="form-control mb-2" name="Visitantes3" placeholder="Visitantes 3" min="0">
          </div>
        </div>

        <hr>

        <!-- GÉNERO -->
        <h6 class="text-success fw-bold category-title">Género</h6>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Cantidad de Hombres</label>
            <input type="number" class="form-control" name="cantidad_hombres" placeholder="Cantidad de hombres" min="0">
          </div>
          <div class="col-md-6">
            <label class="form-label">Cantidad de Mujeres</label>
            <input type="number" class="form-control" name="cantidad_mujeres" placeholder="Cantidad de mujeres" min="0">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL EDITAR COMPLETO -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <form method="POST" action="index.php?controller=capacitacion&action=editar" class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Editar Registro de Capacitación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_capacitacion" id="edit_id">
        <!-- CAMPOS PRINCIPALES -->
        <h6 class="text-success fw-bold category-title">Campos Principales</h6>
        <div class="row g-3 mb-3">
          <div class="col-md-3">
            <label class="form-label">Año</label>
            <input type="number" class="form-control" name="año" id="edit_año" min="2000" max="2100" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Mes 1</label>
            <input type="text" class="form-control" name="mes_1" id="edit_mes_1">
          </div>
          <div class="col-md-3">
            <label class="form-label">Mes 2</label>
            <input type="text" class="form-control" name="mes_2" id="edit_mes_2">
          </div>
          <div class="col-md-3">
            <label class="form-label">Mes 3</label>
            <input type="text" class="form-control" name="mes_3" id="edit_mes_3">
          </div>
        </div>

        <!-- PERSONAL -->
        <h6 class="text-success fw-bold category-title">Personal</h6>
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Admvo</h6>
            <input type="number" class="form-control mb-2" name="admvo1" id="edit_admvo1" min="0">
            <input type="number" class="form-control mb-2" name="admvo2" id="edit_admvo2" min="0">
            <input type="number" class="form-control mb-2" name="admvo3" id="edit_admvo3" min="0">
          </div>
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">PTC</h6>
            <input type="number" class="form-control mb-2" name="PTC1" id="edit_ptc1" min="0">
            <input type="number" class="form-control mb-2" name="PTC2" id="edit_ptc2" min="0">
            <input type="number" class="form-control mb-2" name="PTC3" id="edit_ptc3" min="0">
          </div>
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Honorarios</h6>
            <input type="number" class="form-control mb-2" name="Honorarios1" id="edit_honorarios1" min="0">
            <input type="number" class="form-control mb-2" name="Honorarios2" id="edit_honorarios2" min="0">
            <input type="number" class="form-control mb-2" name="Honorarios3" id="edit_honorarios3" min="0">
          </div>
        </div>

        <!-- PERSONAL ADICIONAL -->
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">PA</h6>
            <input type="number" class="form-control mb-2" name="PA1" id="edit_pa1" min="0">
            <input type="number" class="form-control mb-2" name="PA2" id="edit_pa2" min="0">
            <input type="number" class="form-control mb-2" name="PA3" id="edit_pa3" min="0">
          </div>
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Personas Externas</h6>
            <input type="number" class="form-control mb-2" name="personas_externas_capacitadas1" id="edit_externos1" min="0">
            <input type="number" class="form-control mb-2" name="personas_externas_capacitadas2" id="edit_externos2" min="0">
            <input type="number" class="form-control mb-2" name="personas_externas_capacitadas3" id="edit_externos3" min="0">
          </div>
        </div>

        <hr>

        <!-- PARTICIPANTES -->
        <h6 class="text-success fw-bold category-title">Participantes</h6>
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Servicios</h6>
            <input type="number" class="form-control mb-2" name="Servicios1" id="edit_servicios1" min="0">
            <input type="number" class="form-control mb-2" name="Servicios2" id="edit_servicios2" min="0">
            <input type="number" class="form-control mb-2" name="Servicios3" id="edit_servicios3" min="0">
          </div>
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Alumnos</h6>
            <input type="number" class="form-control mb-2" name="Alumnos1" id="edit_alumnos1" min="0">
            <input type="number" class="form-control mb-2" name="Alumnos2" id="edit_alumnos2" min="0">
            <input type="number" class="form-control mb-2" name="Alumnos3" id="edit_alumnos3" min="0">
          </div>
          <div class="col-md-4">
            <h6 class="text-primary fw-bold">Visitantes</h6>
            <input type="number" class="form-control mb-2" name="Visitantes1" id="edit_visitantes1" min="0">
            <input type="number" class="form-control mb-2" name="Visitantes2" id="edit_visitantes2" min="0">
            <input type="number" class="form-control mb-2" name="Visitantes3" id="edit_visitantes3" min="0">
          </div>
        </div>

        <hr>

        <!-- GÉNERO -->
        <h6 class="text-success fw-bold category-title">Género</h6>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Cantidad de Hombres</label>
            <input type="number" class="form-control" name="cantidad_hombres" id="edit_hombres" min="0">
          </div>
          <div class="col-md-6">
            <label class="form-label">Cantidad de Mujeres</label>
            <input type="number" class="form-control" name="cantidad_mujeres" id="edit_mujeres" min="0">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
      </div>
    </form>
  </div>
</div>

<footer class="text-center py-3">© 2025 CECAM | Sistema de Gestión Ambiental</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/capa.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const formAgregar = document.querySelector('form[action="index.php?controller=capacitacion&action=agregar"]');

    if (formAgregar) {

        formAgregar.addEventListener('submit', function(e) {

            const inputs = formAgregar.querySelectorAll("input, select");
            let vacio = false;

            inputs.forEach(campo => {

                let valor = campo.value.trim();

                // Campo vacío → bloquear
                if (valor === "" || valor === null) {
                    vacio = true;
                }

                // Validación específica del año
                if (campo.name === "año") {
                    let year = parseInt(valor);
                    if (isNaN(year) || year < 2000 || year > 2100) {
                        alert("El año debe estar entre 2000 y 2100.");
                        e.preventDefault();
                        vacio = true;
                    }
                }
            });

            if (vacio) {
                alert("Todos los campos del formulario deben llenarse antes de guardar.");
                e.preventDefault();
            }
        });
    }

});
</script>

</body>
</html>
