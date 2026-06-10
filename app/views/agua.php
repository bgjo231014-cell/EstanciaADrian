<?php
// app/views/agua.php
$registros_agua = $registros_agua ?? [];
$consumos_agua  = $consumos_agua ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Agua - CECAM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/agua.css">
</head>
<body>

<header class="bg-primary text-white text-center py-3">
  <h3>CECAM - Gestión de Agua</h3>
</header>

<div class="container mt-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Registros de Descarga y Calidad del Agua</h4>
    <div class="d-flex gap-2">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarRegistro">
        Agregar Registro
      </button>
      <a href="index.php?view=dashboard_admin" class="btn btn-secondary">
        Regresar al Panel
      </a>
    </div>
  </div>

  <!-- BÚSQUEDA SOLO PARA LA TABLA DE ARRIBA -->
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="input-group buscador-tabla">
        <span class="input-group-text">Buscar descarga</span>
        <input 
          type="month" 
          id="buscarRegistrosAgua" 
          class="form-control" 
          min="2000-01"
          max="2100-12"
        >
        <button type="button" class="btn btn-outline-secondary" id="limpiarRegistrosAgua">
          Limpiar
        </button>
      </div>
      <small class="form-text text-muted mt-1">
        Esta búsqueda solo filtra la tabla de Registros de Descarga y Calidad del Agua.
      </small>
    </div>
  </div>

  <!-- TABLA DE REGISTROS DE AGUA -->
  <table id="tablaRegistrosAgua" class="table table-striped text-center align-middle">
    <thead class="table-success">
      <tr>
        <th style="display:none;">ID</th>
        <th>Periodo</th>
        <th>m³ Descargados</th>
        <th>DBO (mg/L)</th>
        <th>SST (mg/L)</th>
        <th>NT (mg/L)</th>
        <th>Per cápita</th>
        <th>Total Cuatrimestral</th>
        <th>Total Anual m³</th>
        <th>Fecha de registro</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($registros_agua)): ?>
        <?php foreach ($registros_agua as $r): ?>
          <tr
            data-id="<?= (int)$r['id'] ?>"
            data-periodo="<?= htmlspecialchars($r['periodo_mensual'], ENT_QUOTES) ?>"
            data-mc="<?= htmlspecialchars($r['metros_cubicos_descargados']) ?>"
            data-dbo="<?= htmlspecialchars($r['dbo_mg_l']) ?>"
            data-sst="<?= htmlspecialchars($r['sst_mg_l']) ?>"
            data-nt="<?= htmlspecialchars($r['nt_mg_l']) ?>"
            data-percap="<?= htmlspecialchars($r['percapita']) ?>"
          >
            <td style="display:none;"><?= (int)$r['id'] ?></td>
            <td><?= htmlspecialchars($r['periodo_mensual']) ?></td>
            <td><?= htmlspecialchars($r['metros_cubicos_descargados']) ?></td>
            <td><?= htmlspecialchars($r['dbo_mg_l']) ?></td>
            <td><?= htmlspecialchars($r['sst_mg_l']) ?></td>
            <td><?= htmlspecialchars($r['nt_mg_l']) ?></td>
            <td><?= htmlspecialchars($r['percapita']) ?></td>
            <td><?= htmlspecialchars($r['total_cuatri'] ?? '0') ?></td>
            <td><?= htmlspecialchars($r['total_metros_cubicos_descargados'] ?? '0') ?></td>
            <td><?= htmlspecialchars($r['fecha_creacion']) ?></td>
            <td>
              <button class="btn btn-warning btn-sm btnEditarRegistro"
                data-bs-toggle="modal" 
                data-bs-target="#modalEditarRegistro">
                Editar
              </button>

              <a href="index.php?view=agua&action=eliminarRegistro&id=<?= (int)$r['id'] ?>" 
                class="btn btn-danger btn-sm"
                onclick="return confirm('¿Eliminar este registro de agua?');">
                Eliminar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="11" class="text-center">No hay registros de agua.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <hr class="my-5">

  <!-- SECCIÓN DE CONSUMOS -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Registros de Consumo, Costos y Riego</h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarConsumo">
      Agregar Consumo
    </button>
  </div>

  <!-- BÚSQUEDA SOLO PARA LA TABLA DE ABAJO -->
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="input-group buscador-tabla">
        <span class="input-group-text">Buscar consumo</span>
        <input 
          type="month" 
          id="buscarConsumosAgua" 
          class="form-control" 
          min="2000-01"
          max="2100-12"
        >
        <button type="button" class="btn btn-outline-secondary" id="limpiarConsumosAgua">
          Limpiar
        </button>
      </div>
      <small class="form-text text-muted mt-1">
        Esta búsqueda solo filtra la tabla de Registros de Consumo, Costos y Riego.
      </small>
    </div>
  </div>

  <!-- TABLA DE CONSUMOS -->
  <table id="tablaConsumo" class="table table-striped text-center align-middle">
    <thead class="table-info">
      <tr>
        <th style="display:none;">ID</th>
        <th>Mes</th>
        <th>m³ Consumidos</th>
        <th>Costo</th>
        <th>Per cápita</th>
        <th>Cuatrimestral (m³)</th>
        <th>Consumo agua riego (m³)</th>
        <th>Total m³ anuales</th>
        <th>Total costo anual</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($consumos_agua)): ?>
        <?php foreach ($consumos_agua as $c): ?>
          <tr
            data-id="<?= (int)$c['id'] ?>"
            data-mes="<?= htmlspecialchars($c['mes'], ENT_QUOTES) ?>"
            data-mc="<?= htmlspecialchars($c['metros_cubicos']) ?>"
            data-costo="<?= htmlspecialchars($c['costo']) ?>"
            data-percap="<?= htmlspecialchars($c['percapita']) ?>"
            data-cuatrimestral="<?= htmlspecialchars($c['cuatrimestral'] ?? '0') ?>"
            data-riego="<?= htmlspecialchars($c['consumo_agua_riego'] ?? '0') ?>"
            data-totalm="<?= htmlspecialchars($c['total_metros_cubicos'] ?? '0') ?>"
            data-totalc="<?= htmlspecialchars($c['total_costo'] ?? '0') ?>"
          >
            <td style="display:none;"><?= (int)$c['id'] ?></td>
            <td><?= htmlspecialchars($c['mes']) ?></td>
            <td><?= htmlspecialchars($c['metros_cubicos']) ?></td>
            <td><?= htmlspecialchars($c['costo']) ?></td>
            <td><?= htmlspecialchars($c['percapita']) ?></td>
            <td><?= htmlspecialchars($c['cuatrimestral'] ?? '0') ?></td>
            <td><?= htmlspecialchars($c['consumo_agua_riego'] ?? '0') ?></td>
            <td><?= htmlspecialchars($c['total_metros_cubicos'] ?? '0') ?></td>
            <td><?= htmlspecialchars($c['total_costo'] ?? '0') ?></td>
            <td>
              <button 
                class="btn btn-warning btn-sm btnEditarConsumo"
                data-bs-toggle="modal" 
                data-bs-target="#modalEditarConsumo">
                Editar
              </button>

              <a href="index.php?view=agua&action=eliminarConsumo&id=<?= (int)$c['id'] ?>" 
                class="btn btn-danger btn-sm"
                onclick="return confirm('¿Eliminar este registro de consumo?');">
                Eliminar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="10" class="text-center">No hay consumos registrados.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- ===================== MODALES ===================== -->

  <!-- Modal Agregar Registro -->
  <div class="modal fade" id="modalAgregarRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form method="POST" action="index.php?view=agua&action=crearRegistro" class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Agregar Registro de Descarga y Calidad</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-2 mb-3">
            <div class="col-md-4">
              <label class="form-label">Periodo mensual</label>
              <input 
                type="date" 
                name="periodo_mensual" 
                class="form-control" 
                required
                min="2000-01-01"
                max="2100-12-31"
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">m³ descargados</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="metros_cubicos_descargados" 
                class="form-control" 
                required
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">Per cápita</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="percapita" 
                class="form-control" 
                required
              >
            </div>
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-4">
              <label class="form-label">DBO (mg/L)</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="dbo_mg_l" 
                class="form-control" 
                required
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">SST (mg/L)</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="sst_mg_l" 
                class="form-control" 
                required
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">NT (mg/L)</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="nt_mg_l" 
                class="form-control" 
                required
              >
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

  <!-- Modal Editar Registro -->
  <div class="modal fade" id="modalEditarRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form method="POST" action="index.php?view=agua&action=editarRegistro" class="modal-content">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title">Editar Registro de Descarga y Calidad</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id_registro">

          <div class="row g-2 mb-3">
            <div class="col-md-4">
              <label class="form-label">Periodo mensual</label>
              <input 
                type="date" 
                name="periodo_mensual" 
                id="edit_periodo" 
                class="form-control" 
                required
                min="2000-01-01"
                max="2100-12-31"
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">m³ descargados</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="metros_cubicos_descargados" 
                id="edit_mc" 
                class="form-control" 
                required
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">Per cápita</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="percapita" 
                id="edit_percap" 
                class="form-control" 
                required
              >
            </div>
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-4">
              <label class="form-label">DBO (mg/L)</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="dbo_mg_l" 
                id="edit_dbo" 
                class="form-control" 
                required
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">SST (mg/L)</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="sst_mg_l" 
                id="edit_sst" 
                class="form-control" 
                required
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">NT (mg/L)</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="nt_mg_l" 
                id="edit_nt" 
                class="form-control" 
                required
              >
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

  <!-- Modal Agregar Consumo -->
  <div class="modal fade" id="modalAgregarConsumo" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form method="POST" action="index.php?view=agua&action=crearConsumo" class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Agregar Consumo de Agua</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-2 mb-3">
            <div class="col-md-4">
              <label class="form-label">Mes opcional</label>
              <input 
                type="date" 
                name="mes" 
                class="form-control"
                min="2000-01-01"
                max="2100-12-31"
              >
              <small class="text-muted">
                Si lo dejas vacío, se tomará el último periodo registrado en descargas.
              </small>
            </div>

            <div class="col-md-4">
              <label class="form-label">m³ consumidos</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="metros_cubicos" 
                class="form-control" 
                required
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">Costo</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="costo" 
                class="form-control" 
                required
              >
            </div>
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-4">
              <label class="form-label">Per cápita</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="percapita" 
                class="form-control" 
                required
              >
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

  <!-- Modal Editar Consumo -->
  <div class="modal fade" id="modalEditarConsumo" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form method="POST" action="index.php?view=agua&action=editarConsumo" class="modal-content">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title">Editar Consumo de Agua</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id_consumo">

          <div class="row g-2 mb-3">
            <div class="col-md-4">
              <label class="form-label">Mes</label>
              <input 
                type="date" 
                name="mes" 
                id="edit_mes" 
                class="form-control"
                min="2000-01-01"
                max="2100-12-31"
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">m³ consumidos</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="metros_cubicos" 
                id="edit_mc_consumo" 
                class="form-control" 
                required
              >
            </div>

            <div class="col-md-4">
              <label class="form-label">Costo</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="costo" 
                id="edit_costo" 
                class="form-control" 
                required
              >
            </div>
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-4">
              <label class="form-label">Per cápita</label>
              <input 
                type="number" 
                step="0.01" 
                min="0" 
                name="percapita" 
                id="edit_percap_consumo" 
                class="form-control" 
                required
              >
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

</div>

<footer class="text-center bg-light border-top py-3 mt-4">
  © 2025 CECAM | Sistema de Gestión Ambiental
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/aguas.js"></script>
</body>
</html>