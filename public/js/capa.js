// public/javascript/capacitacion.js

document.addEventListener('DOMContentLoaded', function() {
    // === CONFIGURAR BOTONES DE EDITAR (FUNCIONAL) ===
    const editButtons = document.querySelectorAll('.btnEditar');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            console.log('Cargando datos para editar...');
            
            // Obtener todos los datos del registro
            const registro = {
                id: this.getAttribute('data-id'),
                año: this.getAttribute('data-año'),
                mes1: this.getAttribute('data-mes_1'),
                mes2: this.getAttribute('data-mes_2'),
                mes3: this.getAttribute('data-mes_3'),
                admvo1: this.getAttribute('data-admvo1'),
                admvo2: this.getAttribute('data-admvo2'),
                admvo3: this.getAttribute('data-admvo3'),
                ptc1: this.getAttribute('data-ptc1'),
                ptc2: this.getAttribute('data-ptc2'),
                ptc3: this.getAttribute('data-ptc3'),
                honorarios1: this.getAttribute('data-honorarios1'),
                honorarios2: this.getAttribute('data-honorarios2'),
                honorarios3: this.getAttribute('data-honorarios3'),
                pa1: this.getAttribute('data-pa1'),
                pa2: this.getAttribute('data-pa2'),
                pa3: this.getAttribute('data-pa3'),
                servicios1: this.getAttribute('data-servicios1'),
                servicios2: this.getAttribute('data-servicios2'),
                servicios3: this.getAttribute('data-servicios3'),
                alumnos1: this.getAttribute('data-alumnos1'),
                alumnos2: this.getAttribute('data-alumnos2'),
                alumnos3: this.getAttribute('data-alumnos3'),
                visitantes1: this.getAttribute('data-visitantes1'),
                visitantes2: this.getAttribute('data-visitantes2'),
                visitantes3: this.getAttribute('data-visitantes3'),
                externos1: this.getAttribute('data-externos1'),
                externos2: this.getAttribute('data-externos2'),
                externos3: this.getAttribute('data-externos3'),
                hombres: this.getAttribute('data-hombres'),
                mujeres: this.getAttribute('data-mujeres')
            };

            // Llenar el formulario de edición
            document.getElementById('edit_id').value = registro.id;
            document.getElementById('edit_año').value = registro.año;
            document.getElementById('edit_mes_1').value = registro.mes1;
            document.getElementById('edit_mes_2').value = registro.mes2;
            document.getElementById('edit_mes_3').value = registro.mes3;
            
            // Personal - Admvo
            document.getElementById('edit_admvo1').value = registro.admvo1;
            document.getElementById('edit_admvo2').value = registro.admvo2;
            document.getElementById('edit_admvo3').value = registro.admvo3;
            
            // Personal - PTC
            document.getElementById('edit_ptc1').value = registro.ptc1;
            document.getElementById('edit_ptc2').value = registro.ptc2;
            document.getElementById('edit_ptc3').value = registro.ptc3;
            
            // Personal - Honorarios
            document.getElementById('edit_honorarios1').value = registro.honorarios1;
            document.getElementById('edit_honorarios2').value = registro.honorarios2;
            document.getElementById('edit_honorarios3').value = registro.honorarios3;
            
            // Personal - PA
            document.getElementById('edit_pa1').value = registro.pa1;
            document.getElementById('edit_pa2').value = registro.pa2;
            document.getElementById('edit_pa3').value = registro.pa3;
            
            // Participantes - Servicios
            document.getElementById('edit_servicios1').value = registro.servicios1;
            document.getElementById('edit_servicios2').value = registro.servicios2;
            document.getElementById('edit_servicios3').value = registro.servicios3;
            
            // Participantes - Alumnos
            document.getElementById('edit_alumnos1').value = registro.alumnos1;
            document.getElementById('edit_alumnos2').value = registro.alumnos2;
            document.getElementById('edit_alumnos3').value = registro.alumnos3;
            
            // Participantes - Visitantes
            document.getElementById('edit_visitantes1').value = registro.visitantes1;
            document.getElementById('edit_visitantes2').value = registro.visitantes2;
            document.getElementById('edit_visitantes3').value = registro.visitantes3;
            
            // Personas externas
            document.getElementById('edit_externos1').value = registro.externos1;
            document.getElementById('edit_externos2').value = registro.externos2;
            document.getElementById('edit_externos3').value = registro.externos3;
            
            // Género
            document.getElementById('edit_hombres').value = registro.hombres;
            document.getElementById('edit_mujeres').value = registro.mujeres;

            console.log(' Modal de edición cargado correctamente');
            console.log('Registro cargado:', registro);
        });
    });

    // === FILTRO DE BÚSQUEDA POR AÑO ===
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('.tabla-capacitacion tbody tr');

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            const searchValue = searchInput.value.trim();
            let resultados = 0;
            
            rows.forEach(row => {
                const year = row.getAttribute('data-year');
                if (searchValue === '' || year.includes(searchValue)) {
                    row.style.display = '';
                    row.classList.add('highlight');
                    setTimeout(() => row.classList.remove('highlight'), 600);
                    resultados++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            console.log(`Resultados encontrados: ${resultados}`);
        });
    }

    // === VALIDACIÓN DE FORMULARIOS ===
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            let errorMessage = '';

            // Validar año
            const año = form.querySelector('input[name="año"]');
            if (año && (año.value < 2000 || año.value > 2100)) {
                isValid = false;
                errorMessage = 'El año debe estar entre 2000 y 2100';
                año.focus();
            }

            // Validar números negativos
            const numberInputs = form.querySelectorAll('input[type="number"]');
            numberInputs.forEach(input => {
                if (input.value && parseFloat(input.value) < 0) {
                    isValid = false;
                    errorMessage = 'No se permiten valores negativos';
                    input.focus();
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Error: ' + errorMessage);
                return false;
            }
            
            console.log(' Formulario válido, enviando...');
        });
    });

    // === CONFIRMACIÓN PARA ELIMINAR ===
    const deleteButtons = document.querySelectorAll('a.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.')) {
                e.preventDefault();
            }
        });
    });

    // === DEBUG: Verificar configuración ===
    console.log(` Botones de editar encontrados: ${editButtons.length}`);
    
    editButtons.forEach((btn, index) => {
        const id = btn.getAttribute('data-id');
        const año = btn.getAttribute('data-año');
        console.log(`Botón ${index + 1}: ID=${id}, Año=${año}`);
    });

   
    console.log(' Sistema de Capacitación CECAM - JavaScript cargado correctamente');
    
} );

