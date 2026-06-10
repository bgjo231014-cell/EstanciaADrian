<?php
// Inicia sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variables de sesión
$usuario = $_SESSION['usuario'] ?? null;
$usuario_id = $usuario['idUsuario'] ?? $usuario['id'] ?? null;
$usuario_tipo = $usuario['idRol'] ?? $usuario['tipo'] ?? null;
$usuario_nombre = $usuario['nombre'] ?? $usuario['Nombre'] ?? $usuario['usuario'] ?? null;
$usuario_rol = $usuario['rol'] ?? $usuario['Rol'] ?? $usuario['tipo'] ?? null;

// Mapear roles numéricos
if (is_numeric($usuario_rol)) {
    $roles = [
        1 => 'Administrador',
        2 => 'Personal',
        3 => 'Invitado'
    ];

    $usuario_rol = $roles[$usuario_rol] ?? 'Invitado';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CECAM</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos propios -->
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>

<!-- HEADER PROFESIONAL Y RESPONSIVE -->
<header class="cecam-header">
    <div class="header-content">

        <!-- Logo -->
        <a href="index.php?view=home" class="header-logo text-white text-decoration-none">
            <img src="public/media/logo.png" alt="Logo CECAM" class="logo-img" width="150" height="150">
            <div class="logo-icon"></div>
            <div class="logo-text">
                <p>Centro de Control y Gestión Ambiental</p>
            </div>
        </a>

        <!-- Navegación Central -->
        <nav class="header-nav">
            <div class="nav-buttons">
                <a href="index.php?view=redes" class="btn btn-outline-light nav-btn">Redes sociales</a>
                <a href="index.php?view=conocemas" class="btn btn-outline-light nav-btn">Conoce más</a>
                <a href="index.php?view=consulta_sancion" class="btn btn-outline-light nav-btn">Consultar sanción</a>

                <?php if ($usuario_id): ?>
                    <a href="index.php?view=descargas" class="btn btn-outline-light nav-btn">Descargas</a>

                    <?php if (in_array($usuario_tipo, [1, 2]) || in_array($usuario_tipo, ['admin', 'personal'])): ?>
                        <a href="index.php?view=dashboard_admin" class="btn btn-outline-light nav-btn">Gestiones</a>
                    <?php endif; ?>

                <?php else: ?>
                    <a href="index.php?view=descargas" class="btn btn-outline-light nav-btn disabled">Descargas</a>
                <?php endif; ?>
            </div>
        </nav>

        <!-- Sección Usuario -->
        <div class="user-section">
            <?php if ($usuario_id && $usuario_nombre): ?>
                <div class="user-info">
                    <span class="user-name"><?= htmlspecialchars($usuario_nombre) ?></span>
                    <span class="user-role">(<?= htmlspecialchars($usuario_rol) ?>)</span>
                    <a href="index.php?controller=Login&action=logout" class="logout-link">Cerrar sesión</a>
                </div>
            <?php else: ?>
                <a href="index.php?view=login" class="btn btn-outline-light nav-btn login-btn">Iniciar Sesión</a>
            <?php endif; ?>
        </div>

        
    </div>
</header>

<!-- Contenido principal -->
<main class="container-fluid px-3 py-2">