<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'partials/header.php';
?>

<div class="container text-center mt-5">
    <h2 class="text-success mb-4">Conoce más sobre el CECAM</h2>
    <p class="lead">
        El Centro de Educación y Cultura Ambiental Municipal promueve el cuidado del medio ambiente a través de programas, capacitaciones y actividades comunitarias.
    </p>
    <img src="public/img/cecam.jpg" alt="CECAM" class="img-fluid rounded shadow mt-4" style="max-width:600px;">
</div>

<?php include 'partials/footer.php'; ?>
