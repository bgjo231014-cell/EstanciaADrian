// public/js/rsu.js

// Declaración GLOBAL
let graficaGlobal = null;

document.addEventListener("DOMContentLoaded", () => {

    console.log("RSU.JS SE ESTÁ EJECUTANDO");

    inicializarBotonesEditar();
    inicializarBusqueda();
    inicializarGrafica();

    /* ============================================================
       1) BOTONES EDITAR
    ============================================================ */
    function inicializarBotonesEditar() {
        const botonesEditar = document.querySelectorAll(".btnEditar");

        botonesEditar.forEach(btn => {
            btn.addEventListener("click", () => {
                const fila = btn.closest("tr");
                if (!fila) {
                    console.error("No se encontró la fila para Editar");
                    return;
                }

                document.getElementById("edit_id").value  = fila.dataset.id || "";
                document.getElementById("edit_mes").value = fila.dataset.mes || "";

                const campos = [
                    "basura_kg",
                    "basura_organica_kg",
                    "papel_kg",
                    "carton_kg",
                    "pet_kg",
                    "otros_plasticos_kg",
                    "vidrio_kg",
                    "aluminio_kg",
                    "hojalata_kg",
                    "fierro_kg"
                ];

                campos.forEach(campo => {
                    const input = document.getElementById("edit_" + campo);
                    if (input) {
                        input.value = fila.dataset[campo] || "";
                    }
                });
            });
        });
    }

    /* ============================================================
       2) BÚSQUEDA Y FILTRO POR MES
    ============================================================ */
    function inicializarBusqueda() {
        const searchInput = document.getElementById("searchInput");
        if (!searchInput) return;

        searchInput.addEventListener("input", () => {
            const valor = searchInput.value; // YYYY-MM

            const filas1 = document.querySelectorAll(".tabla-rsu-1 tbody tr");
            const filas2 = document.querySelectorAll(".tabla-rsu-2 tbody tr");
            const filasMetricas = document.querySelectorAll(".tabla-metricas tbody tr");

            filtrarPorMes(filas1, valor);
            filtrarPorMes(filas2, valor);
            filtrarPorMes(filasMetricas, valor);

            inicializarGrafica();
        });
    }

    function filtrarPorMes(filas, valor) {
        filas.forEach(fila => {
            const attr = fila.getAttribute("data-mes") || "";
            const mesCorto = attr.substring(0, 7);

            fila.style.display = (!valor || mesCorto === valor) ? "" : "none";
        });
    }

    /* ============================================================
       3) GRÁFICA DE MATERIALES RECICLADOS
    ============================================================ */
    function inicializarGrafica() {
        const canvas = document.getElementById("graficaMateriales");
        if (!canvas) return;
        if (typeof Chart === "undefined") return;

        const datos = obtenerDatosDeTablas();

        const arregloDatos = [
            datos.basura,
            datos.basuraOrganica,
            datos.papel,
            datos.carton,
            datos.pet,
            datos.otrosPlasticos,
            datos.vidrio,
            datos.aluminio,
            datos.hojalata,
            datos.fierro
        ];

        const tieneDatos = arregloDatos.some(v => v > 0);

        if (!tieneDatos) {
            canvas.parentNode.innerHTML =
                '<div class="alert alert-info text-center">No hay datos para la gráfica.</div>';
            return;
        }

        // Destruir gráfica previa
        if (graficaGlobal) graficaGlobal.destroy();

        graficaGlobal = new Chart(canvas, {
            type: "pie",
            data: {
                labels: [
                    "Basura",
                    "Basura orgánica",
                    "Papel",
                    "Cartón",
                    "PET",
                    "Otros Plásticos",
                    "Vidrio",
                    "Aluminio",
                    "Hojalata",
                    "Fierro"
                ],
                datasets: [{
                    data: arregloDatos,
                    backgroundColor: [
                        "#7f8c8d",
                        "#2ecc71",
                        "#3498db",
                        "#27ae60",
                        "#f1c40f",
                        "#f39c12",
                        "#e74c3c",
                        "#e67e22",
                        "#9b59b6",
                        "#34495e"
                    ],
                    borderColor: "#fff",
                    borderWidth: 2,
                    hoverOffset: 12
                }]
            },
            options: {
                plugins: {
                    legend: { position: "right" },
                    title: {
                        display: true,
                        text: "Distribución de Materiales Reciclados",
                        font: { size: 16, weight: "bold" }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => {
                                const valor = ctx.parsed;
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = ((valor / total) * 100).toFixed(1);
                                return `${ctx.label}: ${valor} kg (${pct}%)`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    }

    function obtenerDatosDeTablas() {
        const filas1 = document.querySelectorAll(".tabla-rsu-1 tbody tr");
        const filas2 = document.querySelectorAll(".tabla-rsu-2 tbody tr");

        let datos = {
            basura: 0,
            basuraOrganica: 0,
            papel: 0,
            carton: 0,
            pet: 0,
            otrosPlasticos: 0,
            vidrio: 0,
            aluminio: 0,
            hojalata: 0,
            fierro: 0
        };

        filas1.forEach(fila => {
            if (fila.style.display === "none") return;

            const c = fila.querySelectorAll("td");

            /*
              Orden esperado en la tabla 1:
              td[0] = acciones o algún dato antes
              td[1] = basura
              td[2] = basura orgánica
              td[3] = papel
              td[4] = cartón
              td[5] = PET
              td[6] = otros plásticos
              td[7] = vidrio
              td[8] = aluminio
            */

            if (c.length < 9) return;

            datos.basura += parseFloat(c[1].textContent) || 0;
            datos.basuraOrganica += parseFloat(c[2].textContent) || 0;
            datos.papel += parseFloat(c[3].textContent) || 0;
            datos.carton += parseFloat(c[4].textContent) || 0;
            datos.pet += parseFloat(c[5].textContent) || 0;
            datos.otrosPlasticos += parseFloat(c[6].textContent) || 0;
            datos.vidrio += parseFloat(c[7].textContent) || 0;
            datos.aluminio += parseFloat(c[8].textContent) || 0;
        });

        filas2.forEach(fila => {
            if (fila.style.display === "none") return;

            const c = fila.querySelectorAll("td");

            datos.hojalata += parseFloat(c[0].textContent) || 0;
            datos.fierro += parseFloat(c[1].textContent) || 0;
        });

        return datos;
    }

});