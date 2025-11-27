<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Usuarios - CECAM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/usuarios.css">
</head>
<body>

<header>
  <h3>CECAM - Gestión de Usuarios</h3>
</header>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Lista de Usuarios</h4>
    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Usuario</button>
    <a href="index.php?view=dashboard_admin" class="btn btn-outline-success btn-sm">Volver</a>
  </div>

  <?php if (!empty($_SESSION['mensaje'])): ?>
    <div class="alert alert-info">
      <?= htmlspecialchars($_SESSION['mensaje']); unset($_SESSION['mensaje']); ?>
    </div>
  <?php endif; ?>

  <table class="table table-striped text-center align-middle">
    <thead class="table-success">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
      <?php if (!empty($usuarios)): ?>
        <?php foreach ($usuarios as $u): ?>
        <tr>
          <td><?= htmlspecialchars($u['idUsuario']) ?></td>
          <td><?= htmlspecialchars($u['Nombre']) ?></td>
          <td><?= htmlspecialchars($u['ApellidoPaterno']) ?></td>
          <td><?= htmlspecialchars($u['ApellidoMaterno']) ?></td>
          <td><?= htmlspecialchars($u['Telefono']) ?></td>
          <td><?= htmlspecialchars($u['Correo']) ?></td>
          <td><?= htmlspecialchars($u['NombreRol']) ?></td>
          <td><?= htmlspecialchars($u['Estado']) ?></td>
          <td>
            <button 
              class="btn btn-warning btn-sm btnEditar"
              data-id="<?= $u['idUsuario'] ?>"
              data-nombre="<?= htmlspecialchars($u['Nombre']) ?>"
              data-apellido_paterno="<?= htmlspecialchars($u['ApellidoPaterno']) ?>"
              data-apellido_materno="<?= htmlspecialchars($u['ApellidoMaterno']) ?>"
              data-telefono="<?= htmlspecialchars($u['Telefono']) ?>"
              data-correo="<?= htmlspecialchars($u['Correo']) ?>"
              data-rol="<?= htmlspecialchars($u['NombreRol']) ?>"
              data-bs-toggle="modal"
              data-bs-target="#modalEditar"
            >Editar</button>

            <a href="index.php?controller=usuario&action=eliminar&id=<?= $u['idUsuario'] ?>" 
               class="btn btn-danger btn-sm"
               onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
               Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="9">No hay usuarios registrados.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- ===================== MODAL AGREGAR ===================== -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="index.php?controller=usuario&action=agregar" class="modal-content" id="formAgregarUsuario">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Agregar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="row g-2 mb-2">
          <div class="col"><input type="text" class="form-control" name="nombre" id="add_nombre" placeholder="Nombre" required></div>
          <div class="col"><input type="text" class="form-control" name="apellido_paterno" id="add_apellido_paterno" placeholder="Apellido paterno" required></div>
          <div class="col"><input type="text" class="form-control" name="apellido_materno" id="add_apellido_materno" placeholder="Apellido materno" required></div>
        </div>

        <div class="row g-2 mb-2">
          <div class="col"><input type="text" class="form-control" name="telefono" id="add_telefono" placeholder="Teléfono" required maxlength="10"></div>
          <div class="col"><input type="email" class="form-control" name="correo" id="add_correo" placeholder="Correo" required></div>
        </div>

        <div class="row g-2">
          <div class="col"><input type="password" class="form-control" name="password" id="add_password" placeholder="Contraseña" required minlength="6"></div>
          <div class="col">
            <select name="rol" class="form-select" id="add_rol" required>
              <option value="">Seleccione rol...</option>
              <option value="Administrador">Administrador</option>
              <option value="CECAM">CECAM</option>
              <option value="Universitario">Universitario</option>
            </select>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- ===================== MODAL EDITAR ===================== -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">

    <form method="POST" action="index.php?controller=usuario&action=editar" class="modal-content" id="formEditarUsuario">

      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="id" id="edit_id">

        <div class="row g-2 mb-2">
          <div class="col"><input type="text" class="form-control" name="nombre" id="edit_nombre" required></div>
          <div class="col"><input type="text" class="form-control" name="apellido_paterno" id="edit_apellido_paterno" required></div>
          <div class="col"><input type="text" class="form-control" name="apellido_materno" id="edit_apellido_materno" required></div>
        </div>

        <div class="row g-2 mb-2">
          <div class="col"><input type="text" class="form-control" name="telefono" id="edit_telefono" required maxlength="10"></div>
          <div class="col"><input type="email" class="form-control" name="correo" id="edit_correo" required></div>
        </div>

        <div class="row g-2">
          <div class="col"><input type="password" class="form-control" name="password" id="edit_password" placeholder="Nueva contraseña (opcional)" minlength="6"></div>
          <div class="col">
            <select name="rol" id="edit_rol" class="form-select" required>
              <option value="Administrador">Administrador</option>
              <option value="CECAM">CECAM</option>
              <option value="Universitario">Universitario</option>
            </select>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-warning">Guardar</button>
      </div>

    </form>
  </div>
</div>

<footer>© 2025 CECAM | Sistema de Gestión Ambiental</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ======================================================= -->
<!-- ============== VALIDACIÓN DE FORMULARIOS ============== -->
<!-- ======================================================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {

  // Helpers
  const soloLetras = (t) => /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(t);
  const esEmail    = (c) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(c);
  const esTelefono = (t) => /^[0-9]{10}$/.test(t);

  // ================= VALIDAR FORM AGREGAR =================
  const formAgregar = document.getElementById('formAgregarUsuario');
  formAgregar.addEventListener('submit', function(e) {

    const nombre = document.getElementById('add_nombre').value.trim();
    const apPat  = document.getElementById('add_apellido_paterno').value.trim();
    const apMat  = document.getElementById('add_apellido_materno').value.trim();
    const tel    = document.getElementById('add_telefono').value.trim();
    const correo = document.getElementById('add_correo').value.trim();
    const pass   = document.getElementById('add_password').value.trim();
    const rol    = document.getElementById('add_rol').value.trim();

    if (!nombre || !apPat || !apMat || !tel || !correo || !pass || !rol) {
      alert("Todos los campos son obligatorios.");
      e.preventDefault();
      return;
    }

    if (!soloLetras(nombre) || !soloLetras(apPat) || !soloLetras(apMat)) {
      alert("Nombre y apellidos solo pueden contener letras.");
      e.preventDefault();
      return;
    }

    if (!esTelefono(tel)) {
      alert("El teléfono debe ser numérico y tener exactamente 10 dígitos.");
      e.preventDefault();
      return;
    }

    if (!esEmail(correo)) {
      alert("Ingrese un correo válido.");
      e.preventDefault();
      return;
    }

    if (pass.length < 6) {
      alert("La contraseña debe tener al menos 6 caracteres.");
      e.preventDefault();
      return;
    }
  });

  // ================= VALIDAR FORM EDITAR =================
  const formEditar = document.getElementById('formEditarUsuario');
  formEditar.addEventListener('submit', function(e) {

    const nombre = document.getElementById('edit_nombre').value.trim();
    const apPat  = document.getElementById('edit_apellido_paterno').value.trim();
    const apMat  = document.getElementById('edit_apellido_materno').value.trim();
    const tel    = document.getElementById('edit_telefono').value.trim();
    const correo = document.getElementById('edit_correo').value.trim();
    const pass   = document.getElementById('edit_password').value.trim();
    const rol    = document.getElementById('edit_rol').value.trim();

    if (!nombre || !apPat || !apMat || !tel || !correo || !rol) {
      alert("Todos los campos son obligatorios.");
      e.preventDefault();
      return;
    }

    if (!soloLetras(nombre) || !soloLetras(apPat) || !soloLetras(apMat)) {
      alert("Nombre y apellidos solo pueden contener letras.");
      e.preventDefault();
      return;
    }

    if (!esTelefono(tel)) {
      alert("El teléfono debe ser numérico y tener exactamente 10 dígitos.");
      e.preventDefault();
      return;
    }

    if (!esEmail(correo)) {
      alert("Ingrese un correo válido.");
      e.preventDefault();
      return;
    }

    if (pass.length > 0 && pass.length < 6) {
      alert("Si ingresas una nueva contraseña, debe tener al menos 6 caracteres.");
      e.preventDefault();
      return;
    }
  });

  // ================= RELLENAR MODAL EDITAR =================
  const editButtons = document.querySelectorAll('.btnEditar');
  editButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('edit_id').value                = btn.dataset.id;
      document.getElementById('edit_nombre').value            = btn.dataset.nombre;
      document.getElementById('edit_apellido_paterno').value  = btn.dataset.apellido_paterno;
      document.getElementById('edit_apellido_materno').value  = btn.dataset.apellido_materno;
      document.getElementById('edit_telefono').value          = btn.dataset.telefono;
      document.getElementById('edit_correo').value            = btn.dataset.correo;

      // Seleccionar rol adecuado
      const valueRol = btn.dataset.rol.trim();
      const select = document.getElementById('edit_rol');
      for (let o of select.options) {
        if (o.text.trim() === valueRol || o.value.trim() === valueRol) {
          select.value = o.value;
          break;
        }
      }
    });
  });

});
</script>

</body>
</html>
