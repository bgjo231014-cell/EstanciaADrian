<?php
// app/views/comunidad.php
$comunidades = $comunidades ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Comunidad - CECAM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet">
  <link rel="stylesheet" href="public/css/comunidad.css">
</head>
<body>

<header class="bg-success text-white text-center py-3">
  <h3>CECAM - Gestión de Comunidad</h3>
</header>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Registros de Comunidad</h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">
      Agregar Registro
    </button>
    <a href="index.php?view=dashboard_admin" class="btn btn-secondary">Regresar al Panel</a>
  </div>

  <!-- Campo de búsqueda -->
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-text">Año</span>
        <input type="number" id="searchInput" class="form-control" placeholder="Buscar por año...">
      </div>
    </div>
  </div>

  <!-- ===================== TABLA 1: CAMPOS PRINCIPALES ===================== -->
  <h5 class="bg-warning text-dark p-2 rounded">Campos Principales</h5>
  <table class="table table-striped text-center align-middle tabla-comunidad">
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
      </tr>
    </thead>
    <tbody>
      <?php foreach ($comunidades as $c): ?>
      <tr data-year="<?= (int)$c['año'] ?>">
        <td><?= $c['año'] ?></td>
        <td><?= htmlspecialchars($c['mes_1']) ?></td>
        <td><?= htmlspecialchars($c['mes_2']) ?></td>
        <td><?= htmlspecialchars($c['mes_3']) ?></td>
        <td><?= $c['admvo_1'] ?></td>
        <td><?= $c['admvo_2'] ?></td>
        <td><?= $c['admvo_3'] ?></td>
        <td><?= $c['ptc_1'] ?></td>
        <td><?= $c['ptc_2'] ?></td>
        <td><?= $c['ptc_3'] ?></td>
        <td><?= $c['honorarios_1'] ?></td>
        <td><?= $c['honorarios_2'] ?></td>
        <td><?= $c['honorarios_3'] ?></td>
        <td><?= $c['pa_1'] ?></td>
        <td><?= $c['pa_2'] ?></td>
        <td><?= $c['pa_3'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- ===================== TABLA 2: SERVICIOS ===================== -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">Servicios</h5>
  <table class="table table-striped text-center align-middle tabla-comunidad">
    <thead class="table-success">
      <tr>
        <th>Jardín (1)</th>
        <th>Jardín (2)</th>
        <th>Jardín (3)</th>
        <th>Limpieza (1)</th>
        <th>Limpieza (2)</th>
        <th>Limpieza (3)</th>
        <th>Mantto (1)</th>
        <th>Mantto (2)</th>
        <th>Mantto (3)</th>
        <th>Vigilancia (1)</th>
        <th>Vigilancia (2)</th>
        <th>Vigilancia (3)</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($comunidades as $c): ?>
      <tr data-year="<?= (int)$c['año'] ?>">
        <td><?= $c['jardin_1'] ?></td>
        <td><?= $c['jardin_2'] ?></td>
        <td><?= $c['jardin_3'] ?></td>
        <td><?= $c['limpieza_1'] ?></td>
        <td><?= $c['limpieza_2'] ?></td>
        <td><?= $c['limpieza_3'] ?></td>
        <td><?= $c['mantto_1'] ?></td>
        <td><?= $c['mantto_2'] ?></td>
        <td><?= $c['mantto_3'] ?></td>
        <td><?= $c['vigilancia_1'] ?></td>
        <td><?= $c['vigilancia_2'] ?></td>
        <td><?= $c['vigilancia_3'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- ===================== TABLA 3: ALUMNOS ===================== -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">Alumnos</h5>
  <table class="table table-striped text-center align-middle tabla-comunidad" id="tablaAlumnos">
    <thead class="table-success">
      <tr>
        <th>Licenciatura (1)</th>
        <th>Licenciatura (2)</th>
        <th>Licenciatura (3)</th>
        <th>Posgrado (1)</th>
        <th>Posgrado (2)</th>
        <th>Posgrado (3)</th>
        <th>Fecha Creación</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($comunidades as $c): ?>
      <tr data-year="<?= (int)$c['año'] ?>">

        <td><?= $c['licenciatura_1'] ?></td>
        <td><?= $c['licenciatura_2'] ?></td>
        <td><?= $c['licenciatura_3'] ?></td>
        <td><?= $c['posgrado_1'] ?></td>
        <td><?= $c['posgrado_2'] ?></td>
        <td><?= $c['posgrado_3'] ?></td>
        <td><?= $c['fecha_creacion'] ?></td>

        <td>
          <!-- BOTÓN EDITAR CORREGIDO -->
          <button class="btn btn-warning btn-sm btnEditar"
            data-id_comunidad="<?= $c['id_comunidad'] ?>"
            data-año="<?= $c['año'] ?>"
            data-mes_1="<?= htmlspecialchars($c['mes_1'], ENT_QUOTES) ?>"
            data-mes_2="<?= htmlspecialchars($c['mes_2'], ENT_QUOTES) ?>"
            data-mes_3="<?= htmlspecialchars($c['mes_3'], ENT_QUOTES) ?>"

            data-admvo_1="<?= $c['admvo_1'] ?>"
            data-admvo_2="<?= $c['admvo_2'] ?>"
            data-admvo_3="<?= $c['admvo_3'] ?>"

            data-ptc_1="<?= $c['ptc_1'] ?>"
            data-ptc_2="<?= $c['ptc_2'] ?>"
            data-ptc_3="<?= $c['ptc_3'] ?>"

            data-honorarios_1="<?= $c['honorarios_1'] ?>"
            data-honorarios_2="<?= $c['honorarios_2'] ?>"
            data-honorarios_3="<?= $c['honorarios_3'] ?>"

            data-pa_1="<?= $c['pa_1'] ?>"
            data-pa_2="<?= $c['pa_2'] ?>"
            data-pa_3="<?= $c['pa_3'] ?>"

            data-jardin_1="<?= $c['jardin_1'] ?>"
            data-jardin_2="<?= $c['jardin_2'] ?>"
            data-jardin_3="<?= $c['jardin_3'] ?>"

            data-limpieza_1="<?= $c['limpieza_1'] ?>"
            data-limpieza_2="<?= $c['limpieza_2'] ?>"
            data-limpieza_3="<?= $c['limpieza_3'] ?>"

            data-mantto_1="<?= $c['mantto_1'] ?>"
            data-mantto_2="<?= $c['mantto_2'] ?>"
            data-mantto_3="<?= $c['mantto_3'] ?>"

            data-vigilancia_1="<?= $c['vigilancia_1'] ?>"
            data-vigilancia_2="<?= $c['vigilancia_2'] ?>"
            data-vigilancia_3="<?= $c['vigilancia_3'] ?>"

            data-licenciatura_1="<?= $c['licenciatura_1'] ?>"
            data-licenciatura_2="<?= $c['licenciatura_2'] ?>"
            data-licenciatura_3="<?= $c['licenciatura_3'] ?>"

            data-posgrado_1="<?= $c['posgrado_1'] ?>"
            data-posgrado_2="<?= $c['posgrado_2'] ?>"
            data-posgrado_3="<?= $c['posgrado_3'] ?>"

            data-bs-toggle="modal"
            data-bs-target="#modalEditar"
          >
            Editar
          </button>

          <a href="index.php?view=comunidad&action=eliminar&id=<?= $c['id_comunidad'] ?>" 
             class="btn btn-danger btn-sm"
             onclick="return confirm('¿Eliminar este registro?');">
             Eliminar
          </a>
        </td>

      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <!-- ===================== TABLA 4: TOTALES ===================== -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">Totales y Promedios</h5>
  <table class="table table-striped text-center align-middle tabla-comunidad">
    <thead class="table-success">
      <tr>
        <th>Total Personal primer mes</th>
        <th>Total Personal segundo mes</th>
        <th>Total Personal tercer mes</th>
        <th>Promedio total del cuatrimestre</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($comunidades as $c): ?>
      <tr data-year="<?= (int)$c['año'] ?>">
        <td><?= $c['total_personal_1'] ?></td>
        <td><?= $c['total_personal_2'] ?></td>
        <td><?= $c['total_personal_3'] ?></td>
        <td><?= $c['promedio'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div id="noResults" class="alert alert-warning text-center" style="display:none;">
    No se encontraron registros para ese año.
  </div>

  <!-- ===================== GRÁFICA ===================== -->
  <h5 class="bg-warning text-dark p-2 rounded mt-4">Gráfica: Distribución Total Personal</h5>
  <div class="card shadow-sm mx-auto" style="width:550px;">
    <div class="card-body">
      <canvas id="graficaTotales" height="100"></canvas>
    </div>
  </div>


<!-- =====================================================
                MODAL: AGREGAR REGISTRO
===================================================== -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <form method="POST" action="index.php?view=comunidad&action=crear" class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Agregar Registro de Comunidad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <h6 class="text-success fw-bold">Campos Principales</h6>
        <div class="row g-2 mb-2">
          <div class="col-md-3">
            <input type="number" min="2000" class="form-control" name="año" placeholder="Año" required>
          </div>
          <div class="col-md-3"><input type="text" class="form-control" name="mes_1" placeholder="Mes 1"></div>
          <div class="col-md-3"><input type="text" class="form-control" name="mes_2" placeholder="Mes 2"></div>
          <div class="col-md-3"><input type="text" class="form-control" name="mes_3" placeholder="Mes 3"></div>
        </div>

        <!-- TODOS LOS CAMPOS NUMÉRICOS (ADMVO, PTC, ETC.) -->
        <?php
          $bloques = [
            "Administrativos" => ["admvo_1","admvo_2","admvo_3"],
            "PTC" => ["ptc_1","ptc_2","ptc_3"],
            "Honorarios" => ["honorarios_1","honorarios_2","honorarios_3"],
            "PA" => ["pa_1","pa_2","pa_3"],
            "Jardín" => ["jardin_1","jardin_2","jardin_3"],
            "Limpieza" => ["limpieza_1","limpieza_2","limpieza_3"],
            "Mantenimiento" => ["mantto_1","mantto_2","mantto_3"],
            "Vigilancia" => ["vigilancia_1","vigilancia_2","vigilancia_3"],
            "Licenciatura" => ["licenciatura_1","licenciatura_2","licenciatura_3"],
            "Posgrado" => ["posgrado_1","posgrado_2","posgrado_3"],
          ];
        ?>

        <?php foreach ($bloques as $titulo => $campos): ?>
          <hr>
          <h6 class="text-success fw-bold"><?= $titulo ?></h6>
          <div class="row g-2 mb-2">
            <?php foreach ($campos as $c): ?>
              <div class="col-md-3">
                <input type="number" class="form-control" name="<?= $c ?>" placeholder="<?= ucfirst($c) ?>" min="0">
              </div>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>


<!-- =====================================================
                MODAL: EDITAR REGISTRO (CORREGIDO)
===================================================== -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog modal-xl">

    <form method="POST" action="index.php?view=comunidad&action=editar" class="modal-content">

      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Editar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        
        <!-- ID REAL DEL REGISTRO -->
        <input type="hidden" name="id_comunidad" id="edit_id_comunidad">

        <h6 class="text-success fw-bold">Campos Principales</h6>
        <div class="row g-2 mb-2">
          <div class="col-md-3">
            <input type="number" min="2000" class="form-control" name="año" id="edit_año" required>
          </div>
          <div class="col-md-3"><input type="text" class="form-control" name="mes_1" id="edit_mes_1"></div>
          <div class="col-md-3"><input type="text" class="form-control" name="mes_2" id="edit_mes_2"></div>
          <div class="col-md-3"><input type="text" class="form-control" name="mes_3" id="edit_mes_3"></div>
        </div>

        <!-- BLOQUES REUTILIZADOS EN MODO EDITAR -->
        <?php foreach ($bloques as $titulo => $campos): ?>
          <hr>
          <h6 class="text-success fw-bold"><?= $titulo ?></h6>
          <div class="row g-2 mb-2">
            <?php foreach ($campos as $c): ?>
              <div class="col-md-3">
                <input type="number" class="form-control" name="<?= $c ?>" id="edit_<?= $c ?>" min="0">
              </div>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
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

    // Lista de meses válidos en español (minúsculas)
    const mesesValidos = [
        'enero','febrero','marzo','abril','mayo','junio',
        'julio','agosto','septiembre','octubre','noviembre','diciembre'
    ];

    // FORMULARIO AGREGAR REGISTRO COMUNIDAD
    const formAgregar = document.querySelector('form[action="index.php?view=comunidad&action=crear"]');

    if (formAgregar) {

        formAgregar.addEventListener('submit', function(e) {

            const campos = formAgregar.querySelectorAll("input, select");
            let vacio = false;
            let errorMes = false;

            campos.forEach(campo => {
                let valor = campo.value.trim();

                // Campo vacío → error
                if (valor === "" || valor === null) {
                    vacio = true;
                }

                // Validar año
                if (campo.name === "año") {
                    let year = parseInt(valor);
                    if (isNaN(year) || year < 2000 || year > 2100) {
                        alert("El año debe estar entre 2000 y 2100.");
                        e.preventDefault();
                        vacio = true;
                    }
                }

                // Validar meses: mes_1, mes_2, mes_3 → solo nombres de mes en español
                if (campo.name === "mes_1" || campo.name === "mes_2" || campo.name === "mes_3") {
                    const mes = valor.toLowerCase();
                    if (!mesesValidos.includes(mes)) {
                        errorMes = true;
                    }
                }
            });

            if (errorMes) {
                alert("Los campos Mes 1, Mes 2 y Mes 3 deben ser nombres de mes en español (enero, febrero, marzo, ...).");
                e.preventDefault();
                return;
            }

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
