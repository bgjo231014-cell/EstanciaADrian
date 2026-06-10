<?php
// 🔒 Seguridad: asegurar sesión si aplica
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Incluir el header con Bootstrap y lógica de sesión
include 'partials/header.php';
?>

<div class="container text-center mt-5">
    <h2 class="text-success mb-4">Síguenos en Redes Sociales</h2>
    <p>Conoce más de nuestras actividades ambientales y proyectos sustentables.</p>

    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="https://www.facebook.com/CECAMUpemor/" target="_blank" class="btn btn-outline-primary">
            <i class="bi bi-facebook"></i> Facebook
        </a>
        <a href="https://twitter.com" target="_blank" class="btn btn-outline-info">
            <i class="bi bi-twitter"></i> X / Twitter
        </a>
        <a href="https://www.instagram.com/cecam_upemor/" target="_blank" class="btn btn-outline-danger">
            <i class="bi bi-instagram"></i> Instagram
        </a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
