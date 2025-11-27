<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respaldo y Restauración - CECAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <link rel="stylesheet" href="public/css/restauracion.css">
      <a href="index.php?view=dashboard_admin" class="btn btn-secondary">
        Regresar al Panel
      </a>
</head>
<body>

<div class="container py-4">
    <h2 class="text-center">Respaldo y Restauración de la Base de Datos</h2>

    <div class="row justify-content-center">
        <!-- GENERAR RESPALDO -->
        <div class="col-lg-5 col-md-10 card p-4 m-2 shadow">
            <h4>Generar Respaldo</h4>
            <p>Guarda una copia completa de la base de datos del sistema.</p>
            <form id="backupForm" action="index.php?view=backup&action=generar" method="post">
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-download me-2"></i>Generar Respaldo
                </button>
            </form>
        </div>

        <!-- RESTAURAR BASE DE DATOS -->
        <div class="col-lg-5 col-md-10 card p-4 m-2 shadow">
            <h4>Restaurar Base de Datos</h4>
            <p>Selecciona un archivo SQL para restaurar la información.</p>
            
            <div class="alert alert-warning">
                <strong><i class="fas fa-exclamation-triangle me-2"></i>Advertencia:</strong> 
                La restauración eliminará todos los datos actuales y los reemplazará con los del 
                archivo seleccionado.
            </div>
            
            <form id="restoreForm" action="index.php?view=restore&action=restaurar" 
            method="post" enctype="multipart/form-data">
                <!-- Selección de archivo -->
                <div id="fileSelection" class="file-selection">
                    <label class="file-selection-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Seleccionar archivo SQL</span>
                        <small class="text-muted">Haz clic aquí o arrastra un archivo</small>
                    </label>
                    <input type="file" id="sqlFile" name="archivo" accept=".sql" required>
                </div>

                <!-- Archivo seleccionado -->
                <div id="selectedFile" class="selected-file">
                    <div class="file-info">
                        <div class="file-icon">
                            <i class="fas fa-file-code"></i>
                        </div>
                        <div class="file-details">
                            <div id="fileName" class="file-name">cecam_db.sql</div>
                            <div id="fileSize" class="file-size">2.4 MB</div>
                        </div>
                        <button type="button" id="removeFile" class="file-remove" title="Quitar archivo">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-warning w-100 mt-3" id="restoreBtn">
                    <i class="fas fa-database me-2"></i>Restaurar Base de Datos
                </button>
            </form>
        </div>
    </div>
</div>
<script src="public/js/backup-script.js"></script>
</body>
</html>