document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("submit", (e) => {
        const email = form.correo.value.trim();
        const password = form.password.value.trim();

        if (email === "" || password === "") {
            e.preventDefault();
            alert("Por favor completa todos los campos.");
        }
    });
});
