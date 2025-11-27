<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de la página</title>

    <!-- ✅ CSS principal -->
    <link rel="stylesheet" href="/Estancia/public/css/style.css">
    <link rel="stylesheet" href="/Estancia/public/css/dashboard.css">
    <link rel="stylesheet" href="/Estancia/public/css/login.css">
    <link rel="stylesheet" href="/Estancia/public/css/usuarios.css">

    <!-- ✅ JS principal -->
    <script src="/Estancia/public/js/main.js" defer></script>
    <script src="/Estancia/public/js/login.js" defer></script>
</head>


<body>
    <h1>Registro de invitado</h1>
    
    <form method="POST" action="index.php?action=insert">
        
        <b><label for="Nombre">Nombre:</label></b>
        <input type="text" name="Nombre" id="Nombre"><br><br>

        <b><label for="ApellidoPaterno">Apellido Paterno:</label></b>
        <input type="text" name="ApellidoPaterno" id="ApellidoPaterno"><br><br>

        <b><label for="ApellidoMaterno">Apellido Materno:</label></b>
        <input type="text" name="ApellidoMaterno" id="ApellidoMaterno"><br><br>
        
        <b><label for="Telefono">Telefono: (Opcional)</label></b>
        <input type="int" name="Telefono" id="Telefono"><br><br>
        
        <b><label for="Correo">Correo elèctronico: </label></b>
        <input type="email" name="Correo" id="Correo"><br><br>

        <b><label for="Pass">Contraseña:</label></b>
        <input type="password" name="Pass" id="Pass"><br><br>

        <input type="hidden" name="idRol" value="3">
        <input type="hidden" name="CreadoPor" value=""> 
        <input type="hidden" name="Cargo" value="NA">
        <input type="hidden" name="Estado" value="Activo">
        <input type="hidden" name="FechaRegistro" value="<?php echo date('Y-m-d H:i:s'); ?>">

        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>
