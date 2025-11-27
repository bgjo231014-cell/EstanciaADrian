document.addEventListener("DOMContentLoaded", () => {

    console.log("⚡ Sistema de gestión de electricidad inicializado");

    // ==========================================
    // 🔎 BÚSQUEDA POR MES
    // ==========================================
    const searchInput = document.getElementById("searchInput");
    const tabla = document.getElementById("tablaElectricidad");
    const tbody = tabla.querySelector("tbody");
    const noResults = document.getElementById("noResults");

    if (searchInput) {
        searchInput.addEventListener("input", () => {
            const search = searchInput.value.trim();
            let found = false;

            tbody.querySelectorAll("tr").forEach(row => {
                const mes = row.cells[1].textContent.trim();

                if (search === "" || mes.includes(search)) {
                    row.style.display = "";
                    found = true;
                } else {
                    row.style.display = "none";
                }
            });

            noResults.style.display = (search !== "" && !found) ? "block" : "none";
        });
    }

    // ==========================================
    // ✏️ CARGAR DATOS EN EL MODAL DE EDICIÓN
    // ==========================================
    const botonesEditar = document.querySelectorAll(".btnEditar");

    botonesEditar.forEach(btn => {
        btn.addEventListener("click", () => {

            const fila = btn.closest("tr");
            if (!fila) return;

            document.getElementById("edit_id").value     = btn.dataset.id;
            document.getElementById("edit_mes").value    = btn.dataset.mes;
            document.getElementById("edit_kw").value     = btn.dataset.kw;
            document.getElementById("edit_costo").value  = btn.dataset.costo;
            document.getElementById("edit_percap").value = btn.dataset.percap;
            document.getElementById("edit_sud1").value   = btn.dataset.sud1;
            document.getElementById("edit_sl172").value  = btn.dataset.sl172;
            document.getElementById("edit_scid").value   = btn.dataset.scid;

            console.log("✏️ Editando registro ID:", btn.dataset.id);

            const modal = new bootstrap.Modal(document.getElementById("modalEditar"));
            modal.show();
        });
    });

    // ==========================================
    // 🛑 VALIDACIÓN DE CAMPOS NUMÉRICOS
    // ==========================================
    function validarNumero(input) {
        if (parseFloat(input.value) < 0 || input.value.trim() === "") {
            input.classList.add("is-invalid");
            return false;
        }
        input.classList.remove("is-invalid");
        return true;
    }

    const camposNumericos = document.querySelectorAll('input[type="number"]');

    camposNumericos.forEach(campo => {
        campo.addEventListener("input", () => validarNumero(campo));
    });

    // ==========================================
    // 📌 VALIDAR FORMULARIOS ANTES DE ENVIAR
    // ==========================================
    const formAgregar = document.getElementById("formAgregar");
    const formEditar  = document.getElementById("formEditar");

    function validarFormulario(form) {
        let valido = true;

        form.querySelectorAll('input[type="number"]').forEach(campo => {
            if (!validarNumero(campo)) valido = false;
        });

        return valido;
    }

    if (formAgregar) {
        formAgregar.addEventListener("submit", (e) => {
            if (!validarFormulario(formAgregar)) {
                e.preventDefault();
                alert("⚠️ Corrige los campos en rojo (solo números positivos).");
            }
        });
    }

    if (formEditar) {
        formEditar.addEventListener("submit", (e) => {
            if (!validarFormulario(formEditar)) {
                e.preventDefault();
                alert("⚠️ Corrige los campos en rojo (solo números positivos).");
            }
        });
    }

    console.log("✔ Todas las funciones de electricidad están activas");
});
