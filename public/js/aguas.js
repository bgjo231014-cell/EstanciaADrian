document.addEventListener('DOMContentLoaded', function() {
    console.log('Sistema de Gestión de Agua CECAM inicializado');

    // ==========================
    // BÚSQUEDAS INDIVIDUALES
    // ==========================

    const inputBuscarRegistros = document.getElementById('buscarRegistrosAgua');
    const inputBuscarConsumos = document.getElementById('buscarConsumosAgua');

    const btnLimpiarRegistros = document.getElementById('limpiarRegistrosAgua');
    const btnLimpiarConsumos = document.getElementById('limpiarConsumosAgua');

    const tablaRegistros = document.querySelector('#tablaRegistrosAgua tbody');
    const tablaConsumos = document.querySelector('#tablaConsumo tbody');

    // Búsqueda solo para la tabla de arriba
    if (inputBuscarRegistros && tablaRegistros) {
        inputBuscarRegistros.addEventListener('input', function() {
            buscarEnTabla(
                tablaRegistros,
                inputBuscarRegistros.value,
                'noResultsRegistros',
                11
            );
        });
    }

    // Búsqueda solo para la tabla de abajo
    if (inputBuscarConsumos && tablaConsumos) {
        inputBuscarConsumos.addEventListener('input', function() {
            buscarEnTabla(
                tablaConsumos,
                inputBuscarConsumos.value,
                'noResultsConsumos',
                10
            );
        });
    }

    // Limpiar búsqueda de la tabla de arriba
    if (btnLimpiarRegistros && inputBuscarRegistros && tablaRegistros) {
        btnLimpiarRegistros.addEventListener('click', function() {
            inputBuscarRegistros.value = '';
            buscarEnTabla(tablaRegistros, '', 'noResultsRegistros', 11);
        });
    }

    // Limpiar búsqueda de la tabla de abajo
    if (btnLimpiarConsumos && inputBuscarConsumos && tablaConsumos) {
        btnLimpiarConsumos.addEventListener('click', function() {
            inputBuscarConsumos.value = '';
            buscarEnTabla(tablaConsumos, '', 'noResultsConsumos', 10);
        });
    }

    // ==========================
    // FUNCIONES DE BÚSQUEDA
    // ==========================

    function normalizarTexto(texto) {
        return texto
            .toString()
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .trim();
    }

    function obtenerVariantesBusqueda(valorBusqueda) {
        const meses = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];

        const variantes = [];
        const termino = normalizarTexto(valorBusqueda);

        if (termino === '') {
            return variantes;
        }

        variantes.push(termino);

        // El input type="month" manda algo como 2024-12
        const formatoAnioMes = termino.match(/^(\d{4})-(\d{2})$/);

        if (formatoAnioMes) {
            const anio = formatoAnioMes[1];
            const mesNumero = parseInt(formatoAnioMes[2], 10);
            const mesNombre = meses[mesNumero - 1];

            if (mesNombre) {
                variantes.push(`${anio}-${formatoAnioMes[2]}`);
                variantes.push(`${mesNombre} de ${anio}`);
                variantes.push(`${mesNombre} ${anio}`);
            }
        }

        return variantes;
    }

    function buscarEnTabla(tbody, valorBusqueda, noResultsId, colspan) {
        const filas = tbody.querySelectorAll('tr');
        const variantes = obtenerVariantesBusqueda(valorBusqueda);
        let encontrado = false;

        // Elimina mensaje anterior de no resultados
        const noResultsAnterior = document.getElementById(noResultsId);
        if (noResultsAnterior) {
            noResultsAnterior.remove();
        }

        filas.forEach(fila => {
            if (fila.id === noResultsId) return;

            const textoFila = normalizarTexto(fila.textContent);

            const coincide = valorBusqueda === '' || variantes.some(variante => {
                return textoFila.includes(variante);
            });

            if (coincide) {
                fila.classList.remove('fila-oculta');

                if (valorBusqueda !== '') {
                    fila.classList.add('fila-buscada');
                    encontrado = true;
                } else {
                    fila.classList.remove('fila-buscada');
                }
            } else {
                fila.classList.add('fila-oculta');
                fila.classList.remove('fila-buscada');
            }
        });

        // Si no encontró nada, agrega mensaje
        if (valorBusqueda !== '' && !encontrado) {
            const filaNoResultados = document.createElement('tr');
            filaNoResultados.id = noResultsId;
            filaNoResultados.className = 'no-resultados';

            filaNoResultados.innerHTML = `
                <td colspan="${colspan}">
                    No se encontraron registros para "${valorBusqueda}"
                </td>
            `;

            tbody.appendChild(filaNoResultados);
        }
    }

    // ==========================
    // MODAL EDITAR REGISTRO
    // ==========================

    const editButtonsRegistro = document.querySelectorAll('.btnEditarRegistro');

    editButtonsRegistro.forEach(btn => {
        btn.addEventListener('click', () => {
            const fila = btn.closest('tr');
            if (!fila) return;

            document.getElementById('edit_id_registro').value = fila.dataset.id || '';
            document.getElementById('edit_periodo').value = fila.dataset.periodo || '';
            document.getElementById('edit_mc').value = fila.dataset.mc || '';
            document.getElementById('edit_dbo').value = fila.dataset.dbo || '';
            document.getElementById('edit_sst').value = fila.dataset.sst || '';
            document.getElementById('edit_nt').value = fila.dataset.nt || '';
            document.getElementById('edit_percap').value = fila.dataset.percap || '';

            const modal = new bootstrap.Modal(document.getElementById('modalEditarRegistro'));
            modal.show();
        });
    });

    // ==========================
    // MODAL EDITAR CONSUMO
    // ==========================

    const editButtonsConsumo = document.querySelectorAll('.btnEditarConsumo');

    editButtonsConsumo.forEach(btn => {
        btn.addEventListener('click', () => {
            const fila = btn.closest('tr');
            if (!fila) return;

            document.getElementById('edit_id_consumo').value = fila.dataset.id || '';
            document.getElementById('edit_mes').value = fila.dataset.mes || '';
            document.getElementById('edit_mc_consumo').value = fila.dataset.mc || '';
            document.getElementById('edit_costo').value = fila.dataset.costo || '';
            document.getElementById('edit_percap_consumo').value = fila.dataset.percap || '';

            const modal = new bootstrap.Modal(document.getElementById('modalEditarConsumo'));
            modal.show();
        });
    });

    // ==========================
    // VALIDACIÓN DE FORMULARIOS
    // ==========================

    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredInputs = this.querySelectorAll('input[required]');
            let valid = true;

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    valid = false;
                    input.classList.add('is-invalid');

                    if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('invalid-feedback')) {
                        const feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        feedback.textContent = 'Este campo es obligatorio';
                        input.parentNode.appendChild(feedback);
                    }
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!valid) {
                e.preventDefault();
                showAlert('Por favor, complete todos los campos obligatorios.', 'warning');
            }
        });
    });

    // ==========================
    // ALERTAS
    // ==========================

    function showAlert(message, type = 'info') {
        const alertDiv = document.createElement('div');

        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        `;

        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.remove();
        }, 4000);
    }
});