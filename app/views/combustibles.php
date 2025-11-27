<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Combustibles - CECAM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet">
  <link rel="stylesheet" href="public/css/combustibles.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>
  <h3> CECAM - Gestión de Combustibles</h3>
</header>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Registros de Combustibles</h4>
    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Registro</button>
    <a href="index.php?view=dashboard_admin" class="btn btn-secondary">
        Regresar al Panel
      </a>
  </div>
  

  <!-- Campo de búsqueda por mes -->
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-text"></span>
        <input type="month" id="searchInput" class="form-control" placeholder="Buscar por mes...">
      </div>
    </div>
  </div>

  <table class="table table-striped text-center align-middle" id="tablaCombustibles">
    <thead class="table-success">
      <tr>
        <th>ID</th>
        <th>Mes</th>
        <th>Tipo Combustible</th>
        <th>Litros/Mes</th>
        <th>Litros/Año</th>
        <th>Costos</th>
        <th>Factor Emisión</th>
        <th>CO₂ Generado</th>
        <th>Fecha Registro</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
    <?php foreach ($registros as $r): ?>
      <tr
        data-id="<?= $r['id'] ?>"
        data-mes="<?= $r['mes'] ?>"
        data-tipo="<?= $r['tipo_combustible'] ?>"
        data-litmes="<?= $r['litros_combustible_mes'] ?>"
        data-litanio="<?= $r['litros_combustible_anio'] ?>"
        data-costos="<?= $r['costos'] ?>"
        data-factor="<?= $r['factores_emision'] ?>"
        data-co2="<?= $r['co2_generado'] ?>"
      >
        <td><?= $r['id'] ?></td>
        <td><?= $r['mes'] ?></td>
        <td><?= $r['tipo_combustible'] ?></td>
        <td><?= $r['litros_combustible_mes'] ?></td>
        <td><?= $r['litros_combustible_anio'] ?></td>
        <td><?= $r['costos'] ?></td>
        <td><?= $r['factores_emision'] ?></td>
        <td><?= $r['co2_generado'] ?></td>
        <td><?= $r['fecha_registro'] ?></td>
        <td>
          <button class="btn btn-warning btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalEditar">
            Editar
          </button>

          <a href="index.php?view=combustibles&action=eliminar&id=<?= $r['id'] ?>" 
             class="btn btn-danger btn-sm"
             onclick="return confirm('¿Eliminar este registro?');">
             Eliminar
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <div id="noResults" class="alert alert-warning text-center" style="display:none;">
    No se encontraron registros para ese mes.
  </div>
</div>

<!-- MODAL AGREGAR -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="index.php?view=combustibles&action=agregar" 
          class="modal-content" id="formAgregar">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Agregar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="mb-2">
          <input type="month" class="form-control" name="mes" min="2000-01" max="2100-12" required>
        </div>

        <div class="mb-2">
          <input type="text" class="form-control" 
                 name="tipo_combustible" placeholder="Tipo de combustible" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="litros_combustible_mes" placeholder="Litros por mes" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="litros_combustible_anio" placeholder="Litros por año" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="costos" placeholder="Costos ($)" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.0001" class="form-control"
                 name="factores_emision" placeholder="Factor de emisión" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="co2_generado" placeholder="CO₂ generado (kg)" min="0" required>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>

    </form>
  </div>
</div>
<!-- MODAL EDITAR -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="index.php?view=combustibles&action=editar"
          class="modal-content" id="formEditar">

      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Editar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" name="id" id="edit_id">

        <div class="mb-2">
          <input type="month" class="form-control" name="mes" id="edit_mes"
                 min="2000-01" max="2100-12" required>
        </div>

        <div class="mb-2">
          <input type="text" class="form-control" 
                 name="tipo_combustible" id="edit_tipo" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="litros_combustible_mes" id="edit_litmes" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="litros_combustible_anio" id="edit_litanio" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="costos" id="edit_costos" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.0001" class="form-control"
                 name="factores_emision" id="edit_factor" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="co2_generado" id="edit_co2" min="0" required>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-warning">Guardar</button>
      </div>

    </form>
  </div>
</div>

<hr>

<div class="container mt-5 mb-5">
  <h4 class="text-center">Gráfica de Consumo de Combustibles</h4>
  <canvas id="graficaCombustibles" height="120"></canvas>
</div>

<footer>© 2025 CECAM | Sistema de Gestión Ambiental</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/combustibles.js"></script>

<!-- VALIDACIONES -->
<script>
document.addEventListener("DOMContentLoaded", () => {

    function validarCombustibles(form) {

        const texto = form.querySelector("input[name='tipo_combustible']");
        const fecha = form.querySelector("input[name='mes']");
        const camposNum = [
            "litros_combustible_mes",
            "litros_combustible_anio",
            "costos",
            "factores_emision",
            "co2_generado"
        ];

        // validar fecha
        if (!fecha.value) {
            alert("Debes seleccionar un mes válido.");
            fecha.focus();
            return false;
        }

        let year = parseInt(fecha.value.split("-")[0]);
        if (year < 2000 || year > 2100) {
            alert("El año debe estar entre 2000 y 2100.");
            fecha.focus();
            return false;
        }

        // validar tipo combustible
        if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/.test(texto.value.trim())) {
            alert("El tipo de combustible solo debe contener letras.");
            texto.focus();
            return false;
        }

        // validar numéricos
        for (let name of camposNum) {
            let input = form.querySelector(`[name="${name}"]`);
            let val = input.value.trim();

            if (val === "") {
                alert("Todos los campos deben estar completos.");
                input.focus();
                return false;
            }

            if (isNaN(val) || Number(val) < 0) {
                alert("Valores inválidos (solo números positivos).");
                input.focus();
                return false;
            }
        }

        return true;
    }

    document.getElementById("formAgregar").addEventListener("submit", e => {
        if (!validarCombustibles(e.target)) e.preventDefault();
    });

    document.getElementById("formEditar").addEventListener("submit", e => {
        if (!validarCombustibles(e.target)) e.preventDefault();
    });

    // Cargar datos en el modal Editar
    document.querySelectorAll(".btnEditar").forEach(btn => {
        btn.addEventListener("click", () => {

            document.getElementById("edit_id").value = btn.closest("tr").dataset.id;
            document.getElementById("edit_mes").value = btn.closest("tr").dataset.mes;
            document.getElementById("edit_tipo").value = btn.closest("tr").dataset.tipo;
            document.getElementById("edit_litmes").value = btn.closest("tr").dataset.litmes;
            document.getElementById("edit_litanio").value = btn.closest("tr").dataset.litanio;
            document.getElementById("edit_costos").value = btn.closest("tr").dataset.costos;
            document.getElementById("edit_factor").value = btn.closest("tr").dataset.factor;
            document.getElementById("edit_co2").value = btn.closest("tr").dataset.co2;

        });
    });

});
</script>

</body>
</html>
