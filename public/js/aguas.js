document.addEventListener('DOMContentLoaded', function() {
    console.log('Sistema de Gestión de Agua CECAM inicializado');
    
    // === BÚSQUEDA SINCRONIZADA PARA AMBAS TABLAS ===
    const searchInputRegistros = document.getElementById('searchInput');
    const tablaRegistros = document.querySelector('.table:first-of-type tbody');
    const tablaConsumos = document.getElementById('tablaConsumo');
    
    if (searchInputRegistros) {
        console.log('Inicializando búsqueda sincronizada para ambas tablas');

        searchInputRegistros.addEventListener('input', function(event) {
            const searchTerm = event.target.value;

            // Buscar en tabla de registros
            if (tablaRegistros) {
                buscarEnTabla(tablaRegistros, searchTerm, 0, 'noResultsRegistros', 11);
            }

            // Buscar en tabla de consumos
            if (tablaConsumos) {
                const tbodyConsumos = tablaConsumos.querySelector('tbody');
                if (tbodyConsumos) {
                    buscarEnTabla(tbodyConsumos, searchTerm, 1, 'noResultsConsumos', 10);
                }
            }
        });
    }

    function buscarEnTabla(tbody, searchTerm, columnaIndex, noResultsId, colspan) {
        const rows = tbody.querySelectorAll('tr');
        let found = false;

        rows.forEach(row => {
            const cell = row.querySelectorAll('td')[columnaIndex];
            if (!cell) return;

            const text = cell.textContent.trim();

            if (searchTerm === '' || text.includes(searchTerm)) {
                row.style.display = '';
                row.style.animation = 'fadeIn 0.3s ease';
                if (searchTerm !== '') found = true;
            } else {
                row.style.display = 'none';
            }
        });

        const noResults = document.getElementById(noResultsId);
        if (searchTerm !== '' && !found) {
            if (!noResults) {
                const tr = document.createElement('tr');
                tr.id = noResultsId;
                tr.innerHTML = `<td colspan="${colspan}" class="text-center text-muted py-4">
                    <i class="bi bi-search"></i> No se encontraron registros para "${searchTerm}"
                </td>`;
                tbody.appendChild(tr);
            }
        } else if (noResults) {
            noResults.remove();
        }
    }

    // === CARGAR DATOS EN MODAL DE EDICIÓN DE REGISTRO ===
    const editButtonsRegistro = document.querySelectorAll('.btnEditarRegistro');

    editButtonsRegistro.forEach(btn => {
        btn.addEventListener('click', () => {
            const fila = btn.closest("tr");
            if (!fila) return;

            document.getElementById('edit_id_registro').value = fila.dataset.id;
            document.getElementById('edit_periodo').value = fila.dataset.periodo;
            document.getElementById('edit_mc').value = fila.dataset.mc;
            document.getElementById('edit_dbo').value = fila.dataset.dbo;
            document.getElementById('edit_sst').value = fila.dataset.sst;
            document.getElementById('edit_nt').value = fila.dataset.nt;
            document.getElementById('edit_percap').value = fila.dataset.percap;

            const modal = new bootstrap.Modal(document.getElementById('modalEditarRegistro'));
            modal.show();
        });
    });

    // === CARGAR DATOS EN MODAL DE EDICIÓN DE CONSUMO ===
    const editButtonsConsumo = document.querySelectorAll('.btnEditarConsumo');

    editButtonsConsumo.forEach(btn => {
        btn.addEventListener('click', () => {
            const fila = btn.closest("tr");
            if (!fila) return;

            document.getElementById('edit_id_consumo').value = fila.dataset.id;
            document.getElementById('edit_mes').value = fila.dataset.mes;
            document.getElementById('edit_mc_consumo').value = fila.dataset.mc;
            document.getElementById('edit_costo').value = fila.dataset.costo;
            document.getElementById('edit_percap_consumo').value = fila.dataset.percap;

            const modal = new bootstrap.Modal(document.getElementById('modalEditarConsumo'));
            modal.show();
        });
    });

    // VALIDACIÓN FORMULARIOS
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

        setTimeout(() => alertDiv.remove(), 4000);
    }

});
