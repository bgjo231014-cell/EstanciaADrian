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
    <h1>Usuarios registrados</h1>
    <hr>
    
    <table border="2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Telefono</th>
                <th>Correo eléctronico</th>
                <th>Contraseña</th>
                <th>Cargo</th>
                <th>Fecha de registro</th>
                <th>Creado por</th>
                <th>Estado</th>
                <th>ID Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $usuarios->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['idUsuario']; ?></td>
                    <td><?php echo $row['Nombre']; ?></td>
                    <td><?php echo $row['ApellidoPaterno']; ?></td>
                    <td><?php echo $row['ApellidoMaterno']; ?></td>
                    <td><?php echo $row['Telefono']; ?></td>
                    <td><?php echo $row['Correo']; ?></td>
                    <td><?php echo $row['Pass']; ?></td>
                    <td><?php echo $row['Cargo']; ?></td>
                    <td><?php echo $row['FechaRegistro']; ?></td>
                    <td><?php echo $row['CreadoPor']; ?></td>
                    <td><?php echo $row['Estado']; ?></td>
                    <td><?php echo $row['idRol']; ?></td>
                    <td>
                        <a href="#"><button>Editar</button></a>
                        <a href="#"><button>Eliminar</button></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
