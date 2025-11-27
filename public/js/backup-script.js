document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const fileInput = document.getElementById('sqlFile');
    const fileSelection = document.getElementById('fileSelection');
    const selectedFile = document.getElementById('selectedFile');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeFileBtn = document.getElementById('removeFile');
    const restoreForm = document.getElementById('restoreForm');
    const restoreBtn = document.getElementById('restoreBtn');

    // Función para formatear el tamaño del archivo
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Manejar la selección de archivo
    if (fileInput && fileSelection) {
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Mostrar información del archivo seleccionado
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                
                // Mostrar la sección de archivo seleccionado
                selectedFile.classList.add('show');
                
                // Ocultar la sección de selección
                fileSelection.style.display = 'none';
                
                // Habilitar el botón de restaurar
                if (restoreBtn) {
                    restoreBtn.disabled = false;
                }
            }
        });
    }

    // Manejar la eliminación del archivo seleccionado
    if (removeFileBtn) {
        removeFileBtn.addEventListener('click', function() {
            // Limpiar el input de archivo
            if (fileInput) {
                fileInput.value = '';
            }
            
            // Ocultar la sección de archivo seleccionado
            selectedFile.classList.remove('show');
            
            // Mostrar la sección de selección
            fileSelection.style.display = 'block';
            
            // Deshabilitar el botón de restaurar
            if (restoreBtn) {
                restoreBtn.disabled = true;
            }
            
            // Añadir efecto de pulso a la sección de selección
            fileSelection.classList.add('pulse');
            setTimeout(() => {
                fileSelection.classList.remove('pulse');
            }, 500);
        });
    }

    // Confirmación para restaurar base de datos
    if (restoreForm) {
        restoreForm.addEventListener('submit', function(e) {
            const fileInput = this.querySelector('input[type="file"]');
            
            if (!fileInput.files || !fileInput.files[0]) {
                e.preventDefault();
                alert('Por favor, selecciona un archivo SQL para restaurar.');
                return;
            }
            
            const confirmRestore = confirm(
                'ADVERTENCIA CRÍTICA:\n\n' +
                'Esta acción eliminará PERMANENTEMENTE todos los datos actuales de la base de datos y los reemplazará con los del archivo seleccionado.\n\n' +
                '¿Estás absolutamente seguro de que deseas continuar?'
            );
            
            if (!confirmRestore) {
                e.preventDefault();
            } else {
                // Mostrar mensaje de carga
                if (restoreBtn) {
                    restoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Restaurando...';
                    restoreBtn.disabled = true;
                }
            }
        });
    }

    // Simular generación de respaldo
    const backupForm = document.getElementById('backupForm');
    if (backupForm) {
        backupForm.addEventListener('submit', function(e) {
            // En un caso real, esto se manejaría en el servidor
            alert('Respaldo generado exitosamente. El archivo se ha guardado en el servidor.');
        });
    }

    // Inicializar estado del botón de restaurar
    if (restoreBtn) {
        restoreBtn.disabled = true;
    }
});