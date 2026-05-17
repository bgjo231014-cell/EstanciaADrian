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

      actualizarGrafica();
    });
  }

  // ==============================
  // 2. RELLENAR MODAL EDITAR
  // ==============================
  const btnsEditar = document.querySelectorAll('.btnEditar');

  btnsEditar.forEach(btn => {
    btn.addEventListener('click', () => {

      const get = (name) => btn.dataset[name] ?? "";

      const idField = document.getElementById("edit_id_comunidad");
      if (idField) idField.value = get("id_comunidad");

      const editAno = document.getElementById("edit_año");
      const editMes = document.getElementById("edit_mes");
      const editDescripcion = document.getElementById("edit_descripcion");

      if (editAno) editAno.value = get("año");
      if (editMes) editMes.value = get("mes");
      if (editDescripcion) editDescripcion.value = get("descripcion");

      const numericFields = [
        'admvos',
        'ptcs',
        'honorarios',
        'pa',
        'jardineros',
        'limpieza',
        'maestros',
        'vigilancias',
        'licenciaturas',
        'posgrados'
      ];

      numericFields.forEach(f => {
        const el = document.getElementById("edit_" + f);
        if (el) el.value = get(f);
      });

    });
  });

  // ==============================
  // 3. GRÁFICA ACTUALIZADA
  // ==============================
  let graficaComunidad = null;

  function actualizarGrafica() {
    const canvas = document.getElementById('graficaTotales');

    if (!canvas || typeof Chart === 'undefined') {
      return;
    }

    const filas = document.querySelectorAll('.tabla-comunidad tbody tr');

    let totalAdmvos = 0;
    let totalPtcs = 0;
    let totalHonorarios = 0;
    let totalPa = 0;
    let totalJardineros = 0;
    let totalLimpieza = 0;
    let totalMaestros = 0;
    let totalVigilancias = 0;
    let totalLicenciaturas = 0;
    let totalPosgrados = 0;

    filas.forEach(row => {
      if (row.style.display === 'none') return;

      totalAdmvos += parseFloat(row.dataset.admvos || 0);
      totalPtcs += parseFloat(row.dataset.ptcs || 0);
      totalHonorarios += parseFloat(row.dataset.honorarios || 0);
      totalPa += parseFloat(row.dataset.pa || 0);
      totalJardineros += parseFloat(row.dataset.jardineros || 0);
      totalLimpieza += parseFloat(row.dataset.limpieza || 0);
      totalMaestros += parseFloat(row.dataset.maestros || 0);
      totalVigilancias += parseFloat(row.dataset.vigilancias || 0);
      totalLicenciaturas += parseFloat(row.dataset.licenciaturas || 0);
      totalPosgrados += parseFloat(row.dataset.posgrados || 0);
    });

    const datos = [
      totalAdmvos,
      totalPtcs,
      totalHonorarios,
      totalPa,
      totalJardineros,
      totalLimpieza,
      totalMaestros,
      totalVigilancias,
      totalLicenciaturas,
      totalPosgrados
    ];

    const tieneDatos = datos.some(valor => valor > 0);

    if (!tieneDatos) {
      return;
    }

    if (graficaComunidad) {
      graficaComunidad.destroy();
    }

    graficaComunidad = new Chart(canvas, {
      type: 'pie',
      data: {
        labels: [
          'Admvos',
          'PTCs',
          'Honorarios',
          'PA',
          'Jardineros',
          'Limpieza',
          'Maestros',
          'Vigilancias',
          'Licenciaturas',
          'Posgrados'
        ],
        datasets: [{
          label: 'Distribución de comunidad',
          data: datos,
          backgroundColor: [
            'rgba(46, 204, 113, 0.8)',
            'rgba(52, 152, 219, 0.8)',
            'rgba(155, 89, 182, 0.8)',
            'rgba(241, 196, 15, 0.8)',
            'rgba(230, 126, 34, 0.8)',
            'rgba(26, 188, 156, 0.8)',
            'rgba(231, 76, 60, 0.8)',
            'rgba(52, 73, 94, 0.8)',
            'rgba(127, 140, 141, 0.8)',
            'rgba(22, 160, 133, 0.8)'
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
            text: 'Distribución total de comunidad por tipo'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const valor = context.parsed;
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const porcentaje = total > 0 ? ((valor / total) * 100).toFixed(1) : 0;
                return `${context.label}: ${valor} (${porcentaje}%)`;
              }
            }
          }
        }
      }
    });
  }

  actualizarGrafica();

});