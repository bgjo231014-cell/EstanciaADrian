<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Invitado</title>
    <link rel="stylesheet" href="/Estancia/public/css/style.css">
    <link rel="stylesheet" href="/Estancia/public/css/registro_invitado.css">
</head>
<body>
    <header>
        <h1>🌱 Registro de Invitado</h1>
        <a href="index.php">← Volver al inicio</a>
    </header>

    <main class="registro-main">
        <h2>Regístrate para acceder a las descargas</h2>
        <form action="index.php?controller=descargas&action=registrarInvitado" method="POST" class="registro-form">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellidoPaterno" placeholder="Apellido Paterno" required>
            <input type="text" name="apellidoMaterno" placeholder="Apellido Materno">
            <input type="text" name="telefono" placeholder="Teléfono">
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <input type="password" name="pass" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
    </main>

    <footer>
        © <?= date('Y') ?> Estancia | Sistema de Gestión Ambiental
    </footer>
</body>
</html>
