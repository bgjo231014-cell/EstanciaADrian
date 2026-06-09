<?php
//  Cargar el header dinámico
include 'partials/header.php';

//  Seguridad: Verificar sesión activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php?view=login");
    exit();
}

$usuario = $_SESSION['usuario'];
$idRol = $usuario['idRol']; // 1 = Admin, 2 = Personal, 3 = Invitado
?>

<div class="container">
    <div class="text-center mb-4">
        <h2 class="text-success">Panel de Control Ambiental</h2>
        <p class="lead">
            <?php if ($idRol == 1): ?>
                Bienvenido Administrador, aquí puedes gestionar todo el sistema.
            <?php elseif ($idRol == 2): ?>
                Bienvenido Personal, selecciona una gestión o genera reportes.
            <?php else: ?>
                Bienvenido Invitado, puedes consultar y descargar reportes disponibles.
            <?php endif; ?>
        </p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if ($idRol == 1): ?>
            <div class="col">
                <div class="card border-success h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de Usuarios</h5>
                        <p class="card-text">Administra cuentas, permisos y roles del sistema.</p>
                        <a href="index.php?view=gestion_usuarios" class="btn btn-success">Entrar</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($idRol <= 2): ?>
            <div class="col">
    <div class="card border-success h-100">
        <div class="card-body text-center">
            <h5 class="card-title">Gestión de Sanciones</h5>
            <p class="card-text">Administra sanciones, horas liberadas y penalizaciones por tiempo.</p>
            <a href="index.php?view=sanciones" class="btn btn-success">Entrar</a>
        </div>
    </div>
</div>
            <div class="col">
                <div class="card border-primary h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de Capacitación</h5>
                        <p class="card-text">Controla los eventos de formación y educación ambiental.</p>
                        <a href="index.php?view=capacitacion" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-info h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de Comunidad</h5>
                        <p class="card-text">Registra actividades y colaboraciones con comunidades locales.</p>
                        <a href="index.php?view=comunidad" class="btn btn-info">Entrar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-success h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de Agua</h5>
                        <p class="card-text">Monitorea consumo, ahorro y calidad del agua.</p>
                        <a href="index.php?view=agua" class="btn btn-success">Entrar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-warning h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de RME</h5>
                        <p class="card-text">Gestión  de Residuos de Manejo Especial.</p>
                        <a href="index.php?view=rsu" class="btn btn-warning">Entrar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-secondary h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de Electricidad</h5>
                        <p class="card-text">Controla el uso energético de las instalaciones.</p>
                        <a href="index.php?view=electricidad" class="btn btn-secondary">Entrar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-danger h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de Combustibles</h5>
                        <p class="card-text">Registra y analiza el consumo de gas, diésel o gasolina.</p>
                        <a href="index.php?view=combustibles" class="btn btn-danger">Entrar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-dark h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Genera y descarga reportes ambientales.</p>
                        <a href="index.php?view=reportes" class="btn btn-dark">Entrar</a>
                    </div>
                </div>
            </div>
        <?php elseif ($idRol == 3): ?>
            <div class="col">
                <div class="card border-info h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Descargar reportes</h5>
                        <p class="card-text">Consulta y descarga reportes disponibles públicamente.</p>
                        <a href="index.php?view=descargas" class="btn btn-info">Ver reportes</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($idRol == 1): ?>
            <div class="col">
                <div class="card border-secondary h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Respaldo y restauración</h5>
                        <p class="card-text">Guarda o recupera los datos del sistema.</p>
                        <a href="index.php?view=backup_restore" class="btn btn-secondary">Entrar</a>

                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
