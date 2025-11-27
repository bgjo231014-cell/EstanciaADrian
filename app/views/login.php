<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Estancia</title>
    <link rel="stylesheet" href="/Estancia/public/css/login.css">
    <link rel="stylesheet" href="/Estancia/public/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="index.php?controller=login&action=autenticar" method="post">
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <input type="password" name="pass" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
            <a href="index.php" class="back-home"> Volver al inicio</a>
        </form>
    </div>

    <style>
        .error {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c2c7;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
    </style>
</body>
</html>
