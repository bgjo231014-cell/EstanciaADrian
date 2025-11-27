<?php
// app/views/electricidad.php
$registros = $registros ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Electricidad - CECAM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet">
  <link rel="stylesheet" href="public/css/ele.css">
</head>
<body>

<header>
  <h3> CECAM - Gestión de Electricidad</h3>
</header>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Registros de Electricidad</h4>
    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregar">
      Agregar Registro
    </button>
     <a href="index.php?view=dashboard_admin" class="btn btn-secondary">
        Regresar al Panel
      </a>
  </div>

  <!-- Campo de búsqueda por mes -->
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-text">Mes</span>
        <input type="month" id="searchInput" class="form-control" 
               placeholder="Buscar por mes...">
      </div>
    </div>
  </div>

  <table class="table table-striped text-center align-middle" id="tablaElectricidad">
    <thead class="table-success">
      <tr>
        <th>ID</th>
        <th>Mes</th>
        <th> kW/mes</th>
        <th>Costo</th>
        <th>Consumo percapita kW/me</th>
        <th>Generación de energía (kWh) Campo Solar UD1</th>
        <th>Generación de energía (kWh) Campo Solar LT2</th>
        <th>Generación de energía (kWh) Campo Solar CID</th>
        <th>Fecha Registro</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($registros)): ?>
        <?php foreach ($registros as $r): ?>
          <tr>
            <td><?= (int)$r['id_elec'] ?></td>
            <td><?= htmlspecialchars($r['mes_elec']) ?></td>
            <td><?= htmlspecialchars($r['cons_kw_mes_elec']) ?></td>
            <td><?= htmlspecialchars($r['costo_elec']) ?></td>
            <td><?= htmlspecialchars($r['cons_percap_elec']) ?></td>
            <td><?= htmlspecialchars($r['ener_sud1_elec']) ?></td>
            <td><?= htmlspecialchars($r['ener_sl172_elec']) ?></td>
            <td><?= htmlspecialchars($r['ener_scid_elec']) ?></td>
            <td><?= htmlspecialchars($r['created_elec']) ?></td>
            <td>
              <button class="btn btn-warning btn-sm btnEditar"
                data-id="<?= (int)$r['id_elec'] ?>"
                data-mes="<?= htmlspecialchars($r['mes_elec'], ENT_QUOTES) ?>"
                data-kw="<?= htmlspecialchars($r['cons_kw_mes_elec']) ?>"
                data-costo="<?= htmlspecialchars($r['costo_elec']) ?>"
                data-percap="<?= htmlspecialchars($r['cons_percap_elec']) ?>"
                data-sud1="<?= htmlspecialchars($r['ener_sud1_elec']) ?>"
                data-sl172="<?= htmlspecialchars($r['ener_sl172_elec']) ?>"
                data-scid="<?= htmlspecialchars($r['ener_scid_elec']) ?>"
                data-bs-toggle="modal" data-bs-target="#modalEditar">
                Editar
              </button>

              <a href="index.php?view=electricidad&action=eliminar&id=<?= (int)$r['id_elec'] ?>" 
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('¿Eliminar este registro?');">
                 Eliminar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="10" class="text-center">No hay registros de electricidad.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  
  <!-- Mensaje cuando no hay resultados de búsqueda -->
  <div id="noResults" class="alert alert-warning text-center" style="display:none;">
    No se encontraron registros para ese mes.
  </div>
</div>

<!--  Modal Agregar -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="index.php?view=electricidad&action=agregar" 
          class="modal-content" id="formAgregar">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Agregar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <div class="mb-2">
          <input type="date" class="form-control" name="mes_elec" 
                 min="2000-01-01" max="2100-12-31" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="cons_kw_mes_elec" placeholder="Consumo kW" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="costo_elec" placeholder="Costo" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="cons_percap_elec" placeholder="Consumo percápita" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control"
                 name="ener_sud1_elec" placeholder="ENER SUD1" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="ener_sl172_elec" placeholder="ENER SL172" min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="ener_scid_elec" placeholder="ENER SCID" min="0" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" 
                data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>
<!--  Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="index.php?view=electricidad&action=editar"
          class="modal-content" id="formEditar">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Editar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" name="id_elec" id="edit_id">

        <div class="mb-2">
          <input type="date" class="form-control" name="mes_elec" id="edit_mes"
                 min="2000-01-01" max="2100-12-31" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="cons_kw_mes_elec" id="edit_kw" placeholder="Consumo kW" 
                 min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="costo_elec" id="edit_costo" placeholder="Costo" 
                 min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="cons_percap_elec" id="edit_percap" placeholder="Consumo percápita" 
                 min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="ener_sud1_elec" id="edit_sud1" placeholder="ENER SUD1" 
                 min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control"
                 name="ener_sl172_elec" id="edit_sl172" placeholder="ENER SL172" 
                 min="0" required>
        </div>

        <div class="mb-2">
          <input type="number" step="0.01" class="form-control" 
                 name="ener_scid_elec" id="edit_scid" placeholder="ENER SCID" 
                 min="0" required>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-warning">Guardar</button>
      </div>
    </form>
  </div>
</div>

<footer>© 2025 CECAM | Sistema de Gestión Ambiental</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<!-- VALIDACIÓN PARA AGREGAR Y EDITAR -->
<script>
document.addEventListener("DOMContentLoaded", () => {

    function validarFormulario(form) {
        const campos = [
            "cons_kw_mes_elec",
            "costo_elec",
            "cons_percap_elec",
            "ener_sud1_elec",
            "ener_sl172_elec",
            "ener_scid_elec"
        ];

        // Validar fecha
        const inputFecha = form.querySelector('input[name="mes_elec"]');
        if (!inputFecha.value) {
            alert("El campo 'Mes' es obligatorio.");
            inputFecha.focus();
            return false;
        }
        const fecha = new Date(inputFecha.value);
        const year = fecha.getFullYear();
        if (year < 2000 || year > 2100) {
            alert("El año debe estar entre 2000 y 2100.");
            inputFecha.focus();
            return false;
        }

        // Validar campos numéricos
        for (const campo of campos) {
            const input = form.querySelector('[name="' + campo + '"]');
            const valor = input.value.trim();

            if (valor === "") {
                alert("Todos los campos deben estar llenos.");
                input.focus();
                return false;
            }
            if (isNaN(valor)) {
                alert("El campo debe contener solo números.");
                input.focus();
                return false;
            }
            if (Number(valor) < 0) {
                alert("No se permiten valores negativos.");
                input.focus();
                return false;
            }
        }

        return true;
    }

    // FORMULARIO AGREGAR
    document.getElementById("formAgregar").addEventListener("submit", e => {
        if (!validarFormulario(e.target)) e.preventDefault();
    });

    // FORMULARIO EDITAR
    document.getElementById("formEditar").addEventListener("submit", e => {
        if (!validarFormulario(e.target)) e.preventDefault();
    });

    // ASIGNAR DATOS AL MODAL EDITAR
    document.querySelectorAll(".btnEditar").forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("edit_id").value = btn.dataset.id;
            document.getElementById("edit_mes").value = btn.dataset.mes;
            document.getElementById("edit_kw").value = btn.dataset.kw;
            document.getElementById("edit_costo").value = btn.dataset.costo;
            document.getElementById("edit_percap").value = btn.dataset.percap;
            document.getElementById("edit_sud1").value = btn.dataset.sud1;
            document.getElementById("edit_sl172").value = btn.dataset.sl172;
            document.getElementById("edit_scid").value = btn.dataset.scid;
        });
    });

});
</script>

<script src="public/js/electricidad.js"></script>
</body>
</html>
