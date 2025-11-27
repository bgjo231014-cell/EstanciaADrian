// === Búsqueda por mes ===
const searchInput = document.getElementById('searchInput');
const table = document.getElementById('tablaCombustibles');
const rows = table.getElementsByTagName('tr');
const noResults = document.getElementById('noResults');

searchInput.addEventListener('input', () => {
  const term = searchInput.value.trim().toLowerCase();
  let found = false;

  for (let i = 1; i < rows.length; i++) {
    const mesCell = rows[i].getElementsByTagName('td')[1];
    const mesText = mesCell.textContent.trim().toLowerCase();

    if (mesText.includes(term)) {
      rows[i].style.display = '';
      found = true;
    } else {
      rows[i].style.display = 'none';
    }
  }

  noResults.style.display = found ? 'none' : 'block';
});

// === Cargar datos en modal de edición ===
document.querySelectorAll('.btnEditar').forEach(btn => {
    btn.addEventListener('click', () => {
        const fila = btn.closest("tr");
        if (!fila) return;

        document.getElementById('edit_id').value      = fila.dataset.id;
        document.getElementById('edit_mes').value     = fila.dataset.mes;
        document.getElementById('edit_tipo').value    = fila.dataset.tipo;
        document.getElementById('edit_litmes').value  = fila.dataset.litmes;
        document.getElementById('edit_litanio').value = fila.dataset.litanio;
        document.getElementById('edit_costos').value  = fila.dataset.costos;
        document.getElementById('edit_factor').value  = fila.dataset.factor;
        document.getElementById('edit_co2').value     = fila.dataset.co2;
    });
});


// === GRAFICA DE COMBUSTIBLES ===
document.addEventListener("DOMContentLoaded", () => {
  const ctx = document.getElementById('graficaCombustibles');

  // Leer datos desde la tabla HTML (sin necesidad de PHP extra)
  const filas = document.querySelectorAll('#tablaCombustibles tbody tr');
  const tipos = [];
  const litrosMes = [];
  const litrosAnio = [];

  filas.forEach(fila => {
    const celdas = fila.querySelectorAll('td');
    tipos.push(celdas[2].textContent); // tipo_combustible
    litrosMes.push(parseFloat(celdas[3].textContent) || 0);
    litrosAnio.push(parseFloat(celdas[4].textContent) || 0);
  });

  // Configurar la gráfica de barras
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: tipos,
      datasets: [
        {
          label: 'Litros por Mes',
          data: litrosMes,
          backgroundColor: 'rgba(75, 192, 192, 0.6)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        },
        {
          label: 'Litros por Año',
          data: litrosAnio,
          backgroundColor: 'rgba(255, 159, 64, 0.6)',
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      indexAxis: 'y', // <== Esto la hace horizontal
      responsive: true,
      plugins: {
        legend: { position: 'top' },
        title: {
          display: true,
          text: 'Comparativo de Litros por Tipo de Combustible'
        }
      },
      scales: {
        x: { beginAtZero: true }
      }
    }
  });
});

