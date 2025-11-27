// === Acceso a Descargas (según sesión) ===
function accesoDescargas() {
    try {
        // IS_AUTH se define en header.php por PHP
        if (typeof IS_AUTH !== 'undefined' && IS_AUTH === true) {
            window.location.href = "index.php?controller=descargas&action=index";
        } else {
            // Abrir el modal directamente en la página actual
            mostrarVentana();
        }
    } catch (err) {
        // Fallback: si algo falla, abrimos el modal
        mostrarVentana();
    }
}

// === Menú responsive ===
function toggleMenu() {
    const nav = document.querySelector('.topnav');
    nav.classList.toggle('active');
}

// === Mostrar / cerrar ventanas modales ===
function mostrarVentana() {
    document.getElementById('overlay').style.display = 'flex';
}

function cerrarVentana() {
    document.getElementById('overlay').style.display = 'none';
}

function mostrarLogin() {
    document.getElementById('loginModal').style.display = 'flex';
}

function cerrarLogin() {
    document.getElementById('loginModal').style.display = 'none';
}

function mostrarRegistro() {
    document.getElementById('registerModal').style.display = 'flex';
}

function cerrarRegistro() {
    document.getElementById('registerModal').style.display = 'none';
}

// === Cambiar entre login y registro ===
function cambiarARegistro() {
    cerrarLogin();
    mostrarRegistro();
}

function cambiarALogin() {
    cerrarRegistro();
    mostrarLogin();
}

// === Cerrar modales al hacer clic fuera de ellos ===
window.onclick = function(event) {
    const overlayLogin = document.getElementById('loginModal');
    const overlayRegistro = document.getElementById('registerModal');
    const overlayAcceso = document.getElementById('overlay');

    if (event.target === overlayLogin) cerrarLogin();
    if (event.target === overlayRegistro) cerrarRegistro();
    if (event.target === overlayAcceso) cerrarVentana();
};
