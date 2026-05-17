<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar sesión | Estancia</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #0f766e, #14532d);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login-container {
    background: white;
    width: 380px;
    padding: 35px;
    border-radius: 18px;
    box-shadow: 0 15px 35px rgba(0,0,0,.25);
    text-align: center;
}
h2 {
    margin-bottom: 10px;
    color: #14532d;
}
.subtitle {
    color: #666;
    margin-bottom: 25px;
}
input {
    width: 100%;
    padding: 13px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-sizing: border-box;
}
button {
    width: 100%;
    padding: 13px;
    border: none;
    border-radius: 10px;
    background: #0f766e;
    color: white;
    font-size: 16px;
    cursor: pointer;
}
button:hover {
    background: #115e59;
}
.back-home {
    display: block;
    margin-top: 18px;
    color: #0f766e;
    text-decoration: none;
}
.error {
    color: #dc3545;
    background: #f8d7da;
    padding: 10px;
    border-radius: 8px;
}
</style>
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <p class="subtitle">sistema de CECAM</p>

    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="index.php?controller=login&action=autenticar" method="post">
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="pass" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
        <a href="index.php" class="back-home">Volver al inicio</a>
    </form>
</div>

</body>
</html>