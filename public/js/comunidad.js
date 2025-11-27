// ==============================
// comunidad.js
// ==============================

document.addEventListener('DOMContentLoaded', () => {

  // ==============================
  // 1. FILTRO POR AÑO
  // ==============================
  const searchInput = document.getElementById('searchInput');
  const tables = document.querySelectorAll('.tabla-comunidad tbody');

  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const year = searchInput.value.trim();
      let found = false;

      tables.forEach(tbody => {
        [...tbody.rows].forEach(row => {
          const rowYear = row.getAttribute('data-year') || '';
          if (!year || rowYear.startsWith(year)) {
            row.style.display = '';
            found = true;
          } else {
            row.style.display = 'none';
          }
        });
      });

      const noResults = document.getElementById('noResults');
      if (noResults) {
        noResults.style.display = (year && !found) ? 'block' : 'none';
      }
    });
  }

  // ==============================
  // 2. RELLENAR MODAL EDITAR
  // ==============================
  const btnsEditar = document.querySelectorAll('.btnEditar');

  btnsEditar.forEach(btn => {
    btn.addEventListener('click', () => {

      const get = (name) => btn.dataset[name] ?? "";

      // ID real del registro
      const idField = document.getElementById("edit_id_comunidad");
      if (idField) idField.value = get("id_comunidad");

      // Campos de texto
      const editAno   = document.getElementById("edit_año");
      const editMes1  = document.getElementById("edit_mes_1");
      const editMes2  = document.getElementById("edit_mes_2");
      const editMes3  = document.getElementById("edit_mes_3");

      if (editAno)  editAno.value  = get("año");
      if (editMes1) editMes1.value = get("mes_1");
      if (editMes2) editMes2.value = get("mes_2");
      if (editMes3) editMes3.value = get("mes_3");

      // Todos los campos numéricos
      const numericFields = [
        'admvo_1','admvo_2','admvo_3',
        'ptc_1','ptc_2','ptc_3',
        'honorarios_1','honorarios_2','honorarios_3',
        'pa_1','pa_2','pa_3',
        'jardin_1','jardin_2','jardin_3',
        'limpieza_1','limpieza_2','limpieza_3',
        'mantto_1','mantto_2','mantto_3',
        'vigilancia_1','vigilancia_2','vigilancia_3',
        'licenciatura_1','licenciatura_2','licenciatura_3',
        'posgrado_1','posgrado_2','posgrado_3'
      ];

      numericFields.forEach(f => {
        const el = document.getElementById("edit_" + f);
        if (el) el.value = get(f);
      });

    });
  });

  // ==============================
  // 3. GRÁFICA DE PASTEL DE TOTALES
  // ==============================
  // Usamos la ÚLTIMA tabla con clase .tabla-comunidad (la de "Totales y Promedios")
  const tablas = document.querySelectorAll('.tabla-comunidad');
  if (tablas.length > 0) {
    const tablaTotales = tablas[tablas.length - 1]; // última tabla
    const filasTotales = tablaTotales.querySelectorAll('tbody tr');

    if (filasTotales.length > 0) {
      // Tomamos la última fila (ej. año más reciente)
      const ultimaFila = filasTotales[filasTotales.length - 1];
      const celdas = ultimaFila.querySelectorAll('td');

      if (celdas.length >= 3) {
        const total1 = parseFloat(celdas[0].textContent) || 0;
        const total2 = parseFloat(celdas[1].textContent) || 0;
        const total3 = parseFloat(celdas[2].textContent) || 0;

        const canvas = document.getElementById('graficaTotales');

        // Solo dibujamos si existe el canvas y Chart.js está cargado
        if (canvas && typeof Chart !== 'undefined') {
          new Chart(canvas, {
            type: 'pie',
            data: {
              labels: [
                'Total personal 1er mes',
                'Total personal 2º mes',
                'Total personal 3er mes'
              ],
              datasets: [{
                label: 'Totales de personal',
                data: [total1, total2, total3],
                backgroundColor: [
                  'rgba(138, 233, 14, 0.8)',
                  'rgba(2, 63, 7, 0.7)',
                  'rgba(75, 192, 91, 0.7)'
                ],
                borderColor: '#ffffff',
                borderWidth: 2
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  position: 'right'
                },
                title: {
                  display: true,
                  text: 'Comparativa de Totales por Grupo'
                }
              }
            }
          });
        }
      }
    }
  }

});
