document.addEventListener("DOMContentLoaded", () => {
    console.log("⚡ Sistema de gestión de electricidad inicializado");

    const searchInput = document.getElementById("searchInput");
    const filtroAnio = document.getElementById("filtroAnio");
    const filtroConsumo = document.getElementById("filtroConsumo");
    const btnExportarCSV = document.getElementById("btnExportarCSV");
    const tabla = document.getElementById("tablaElectricidad");
    const tbody = tabla?.querySelector("tbody");
    const noResults = document.getElementById("noResults");

    const totalKw = document.getElementById("totalKw");
    const totalCosto = document.getElementById("totalCosto");
    const promedioKw = document.getElementById("promedioKw");
    const mayorConsumo = document.getElementById("mayorConsumo");

    if (!tabla || !tbody) return;

    function obtenerFilas() {
        return Array.from(tbody.querySelectorAll("tr")).filter(row => row.cells.length >= 10);
    }

    function numero(valor) {
        return Number(String(valor).replace(/[$,]/g, "").trim()) || 0;
    }

    function formatoNumero(valor) {
        return valor.toLocaleString("es-MX", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function formatoMoneda(valor) {
        return valor.toLocaleString("es-MX", {
            style: "currency",
            currency: "MXN"
        });
    }

    function cargarAnios() {
        if (!filtroAnio) return;

        const anios = new Set();

        obtenerFilas().forEach(row => {
            const mes = row.cells[1].textContent.trim();
            if (mes.length >= 4) anios.add(mes.substring(0, 4));
        });

        [...anios].sort((a, b) => b - a).forEach(anio => {
            const option = document.createElement("option");
            option.value = anio;
            option.textContent = anio;
            filtroAnio.appendChild(option);
        });
    }

    function tipoConsumo(kw) {
        if (kw >= 3200) return "alto";
        if (kw >= 2700) return "medio";
        return "bajo";
    }

    function aplicarFiltros() {
        const busqueda = (searchInput?.value || "").toLowerCase().trim();
        const anio = filtroAnio?.value || "";
        const consumo = filtroConsumo?.value || "";
        let visibles = 0;

        obtenerFilas().forEach(row => {
            const textoFila = row.textContent.toLowerCase();
            const mes = row.cells[1].textContent.trim();
            const kw = numero(row.cells[2].textContent);
            const coincideBusqueda = busqueda === "" || textoFila.includes(busqueda);
            const coincideAnio = anio === "" || mes.startsWith(anio);
            const coincideConsumo = consumo === "" || tipoConsumo(kw) === consumo;

            const mostrar = coincideBusqueda && coincideAnio && coincideConsumo;
            row.style.display = mostrar ? "" : "none";

            row.classList.toggle("consumo-alto", kw >= 3200);

            if (mostrar) visibles++;
        });

        if (noResults) {
            noResults.style.display = visibles === 0 ? "block" : "none";
        }

        actualizarResumen();
    }

    function actualizarResumen() {
        const filasVisibles = obtenerFilas().filter(row => row.style.display !== "none");

        let sumaKw = 0;
        let sumaCosto = 0;
        let mayor = 0;

        filasVisibles.forEach(row => {
            const kw = numero(row.cells[2].textContent);
            const costo = numero(row.cells[3].textContent);

            sumaKw += kw;
            sumaCosto += costo;
            if (kw > mayor) mayor = kw;
        });

        const promedio = filasVisibles.length ? sumaKw / filasVisibles.length : 0;

        if (totalKw) totalKw.textContent = formatoNumero(sumaKw);
        if (totalCosto) totalCosto.textContent = formatoMoneda(sumaCosto);
        if (promedioKw) promedioKw.textContent = formatoNumero(promedio);
        if (mayorConsumo) mayorConsumo.textContent = formatoNumero(mayor);
    }

    function ordenarTabla(indice, th) {
        const filas = obtenerFilas();
        const ascendente = th.dataset.order !== "asc";

        filas.sort((a, b) => {
            let valorA = a.cells[indice].textContent.trim();
            let valorB = b.cells[indice].textContent.trim();

            const numA = numero(valorA);
            const numB = numero(valorB);

            if (!isNaN(numA) && !isNaN(numB) && valorA !== "" && valorB !== "") {
                return ascendente ? numA - numB : numB - numA;
            }

            return ascendente 
                ? valorA.localeCompare(valorB)
                : valorB.localeCompare(valorA);
        });

        filas.forEach(row => tbody.appendChild(row));

        tabla.querySelectorAll("th").forEach(header => {
            header.dataset.order = "";
            header.textContent = header.textContent.replace(" ▲", "").replace(" ▼", "");
        });

        th.dataset.order = ascendente ? "asc" : "desc";
        th.textContent += ascendente ? " ▲" : " ▼";

        aplicarFiltros();
    }

    function exportarCSV() {
        const filasVisibles = obtenerFilas().filter(row => row.style.display !== "none");

        const encabezados = Array.from(tabla.querySelectorAll("thead th"))
            .slice(0, -1)
            .map(th => `"${th.textContent.replace(/ ▲| ▼/g, "").trim()}"`);

        const filas = filasVisibles.map(row => {
            return Array.from(row.cells)
                .slice(0, -1)
                .map(td => `"${td.textContent.trim().replace(/"/g, '""')}"`)
                .join(",");
        });

        const csv = [encabezados.join(","), ...filas].join("\n");
        const blob = new Blob(["\uFEFF" + csv], { type: "text/csv;charset=utf-8;" });
        const url = URL.createObjectURL(blob);

        const link = document.createElement("a");
        link.href = url;
        link.download = "electricidad_filtrada.csv";
        link.click();

        URL.revokeObjectURL(url);
    }

    tabla.querySelectorAll("thead th").forEach((th, index) => {
        if (index < tabla.querySelectorAll("thead th").length - 1) {
            th.addEventListener("click", () => ordenarTabla(index, th));
        }
    });

    searchInput?.addEventListener("input", aplicarFiltros);
    filtroAnio?.addEventListener("change", aplicarFiltros);
    filtroConsumo?.addEventListener("change", aplicarFiltros);
    btnExportarCSV?.addEventListener("click", exportarCSV);

    document.querySelectorAll(".btnEditar").forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("edit_id").value = btn.dataset.id;
            document.getElementById("edit_mes").value = btn.dataset.mes;
            document.getElementById("edit_kw").value = btn.dataset.kw;
            document.getElementById("edit_costo").value = btn.dataset.costo;
            document.getElementById("edit_percap").value = btn.dataset.percap;
            document.getElementById("edit_sud1").value = btn.dataset.sud1;
            document.getElementById("edit_sl172").value = btn.dataset.sl172;
            document.getElementById("edit_scid").value = btn.dataset.scid;
        });
    });

    function validarNumero(input) {
        if (parseFloat(input.value) < 0 || input.value.trim() === "") {
            input.classList.add("is-invalid");
            return false;
        }

        input.classList.remove("is-invalid");
        return true;
    }

    document.querySelectorAll('input[type="number"]').forEach(campo => {
        campo.addEventListener("input", () => validarNumero(campo));
    });

    cargarAnios();
    aplicarFiltros();

    console.log("✔ Funciones frontend de electricidad activas");
});