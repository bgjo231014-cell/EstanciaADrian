<?php
// Iniciar sesión para saber quién es y qué rol tiene
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usuario = $_SESSION['usuario'] ?? null;
$idRol   = $usuario['idRol'] ?? null;
$rolNombre = $usuario['rol'] ?? null;

// Puede gestionar (subir / borrar) → Admin (1) y Personal CECAM (2)
$puedeGestionar = in_array($idRol, [1, 2]) || in_array($rolNombre, ['Administrador', 'Personal', 'CECAM']);

// Ruta a la carpeta de descargas (CARPETA PÚBLICA)
$path = __DIR__ . '/../../public/descargas/';

$archivos = [];
if (is_dir($path)) {
    $archivos = array_diff(scandir($path), ['.', '..']);
} else {
    // Si no existe, la creamos para que no marque error
    mkdir($path, 0777, true);
}
?>

<?php include 'partials/header.php'; ?>

<div class="container mt-4 mb-5">

    <h2 class="text-success mb-2">📥 Descargas disponibles</h2>
    <p class="text-muted">Aquí puedes descargar los reportes generados y otros documentos compartidos por el CECAM.</p>

    <!-- FORMULARIO PARA SUBIR ARCHIVOS (solo Admin y Personal CECAM) -->
    <?php if ($puedeGestionar): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                Subir nuevo archivo al tablón de descargas
            </div>
            <div class="card-body">
                <form action="index.php?controller=descargas&action=subir" method="post" enctype="multipart/form-data" class="row g-2">
                    <div class="col-md-8">
                        <input type="file" name="archivo" class="form-control" required>
                    </div>
                    <div class="col-md-4 d-grid">
                        <button type="submit" class="btn btn-success">
                            Subir archivo
                        </button>
                    </div>
                    <small class="text-muted mt-2">
                        Puedes subir archivos PDF, Word, Excel, imágenes, etc. Estos estarán visibles para los usuarios tipo universitario.
                    </small>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- LISTA DE ARCHIVOS -->
    <?php if (empty($archivos)): ?>
        <div class="alert alert-warning text-center mt-4">
            No hay archivos disponibles para descargar.
        </div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                Archivos publicados
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($archivos as $archivo): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="me-2">📄</span>
                            <span><?= htmlspecialchars($archivo) ?></span>
                        </div>

                        <div class="d-flex gap-2">
                            <!-- Botón descargar (todos los roles logueados) -->
                            <a class="btn btn-success btn-sm"
                               href="/Estancia/public/descargas/<?= urlencode($archivo) ?>"
                               download>
                                Descargar
                            </a>

                            <!-- Botón eliminar (solo Admin / Personal CECAM) -->
                            <?php if ($puedeGestionar): ?>
                                <form action="index.php?controller=descargas&action=eliminar"
                                      method="post"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Seguro que quieres eliminar este archivo?');">
                                    <input type="hidden" name="archivo" value="<?= htmlspecialchars($archivo) ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<?php include 'partials/footer.php'; ?>
