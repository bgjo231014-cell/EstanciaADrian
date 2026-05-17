<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'partials/header.php';
?>

<style>
    .cecam-section {
        background: #f8faf9;
        padding: 60px 0;
    }

    .cecam-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .cecam-title {
        text-align: center;
        color: #198754;
        font-size: 2.4rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .cecam-intro {
        max-width: 950px;
        margin: 0 auto 40px auto;
        text-align: center;
        font-size: 1.15rem;
        line-height: 1.8;
        color: #374151;
    }

    .cecam-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 35px;
        margin-bottom: 35px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border-left: 6px solid #198754;
    }

    .cecam-subtitle {
        color: #1f2937;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 22px;
        text-align: center;
    }

    .cecam-card p {
        text-align: justify;
        font-size: 1.05rem;
        line-height: 1.8;
        color: #374151;
        margin-bottom: 18px;
    }

    .cecam-highlight {
        color: #198754;
        font-weight: 700;
    }

    .objetivos-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 30px;
    }

    .objetivo-card {
        background: #f9fafb;
        border-radius: 15px;
        padding: 22px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .objetivo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
    }

    .objetivo-card h4 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #198754;
    }

    .objetivo-card p {
        margin: 0;
        text-align: justify;
        font-size: 1rem;
        line-height: 1.6;
    }

    .cecam-image-box {
        text-align: center;
        margin-top: 20px;
    }

    .cecam-image-box img {
        max-width: 300px;
        width: 40%;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        border: 4px solid #ffffff;
    }

    .image-caption {
        font-size: 0.95rem;
        color: #6b7280;
        margin-top: 9px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .cecam-title {
            font-size: 2rem;
        }

        .cecam-card {
            padding: 25px;
        }

        .objetivos-grid {
            grid-template-columns: 1fr;
        }

        .cecam-intro {
            text-align: justify;
        }
    }
</style>

<section class="cecam-section">
    <div class="cecam-container">

        <h2 class="cecam-title">Conoce más sobre el CECAM</h2>

        <p class="cecam-intro">
            En el CECAM buscamos crear conciencia ambiental mediante capacitaciones,
            proyectos y prácticas sustentables que puedan ser replicadas por estudiantes,
            docentes y la comunidad en general, contribuyendo al cuidado del medio ambiente
            y al desarrollo sustentable de la región.
        </p>

        <div class="cecam-card">
            <h3 class="cecam-subtitle">Conócenos</h3>

            <p>
                El <span class="cecam-highlight">Centro de Capacitación Ambiental CECAM</span>
                de la Universidad Politécnica del Estado de Morelos fue creado con el propósito
                de promover la educación ambiental y el uso de tecnologías sustentables dentro
                y fuera de la universidad.
            </p>

            <p>
                Este espacio fue acondicionado como una <strong>casa sustentable</strong>, donde
                se integran ecotecnias como celdas fotovoltaicas, captación de agua pluvial,
                compostaje, separación de residuos, huerto de hortalizas, baño seco, humedal
                para tratamiento de aguas residuales y muros verdes.
            </p>

            <p>
                El objetivo principal del CECAM es realizar investigaciones, monitoreo y talleres
                ambientales para la comunidad, demostrando que es posible aprovechar espacios
                existentes e implementar soluciones sustentables que ayuden al cuidado del medio
                ambiente.
            </p>

            <p>
                Además, el CECAM forma parte del
                <strong>Sistema de Gestión Ambiental de UPEMOR</strong>, certificado bajo la
                <strong>norma ISO 14001:2015</strong>, el cual busca cumplir con los requisitos
                legales ambientales y fortalecer la formación de profesionistas comprometidos
                con la sustentabilidad.
            </p>
        </div>

        <div class="cecam-card">
            <h3 class="cecam-subtitle">Objetivos del Sistema de Gestión Ambiental</h3>

            <p>
                El Sistema de Gestión Ambiental trabaja principalmente en cuatro objetivos
                ambientales que permiten mejorar el desempeño ambiental de la universidad:
            </p>

            <div class="objetivos-grid">

                <div class="objetivo-card">
                    <h4>Residuos sólidos urbanos y manejo especial</h4>
                    <p>
                        Mejorar la gestión, separación, reciclaje y valorización de los residuos
                        generados dentro de la universidad.
                    </p>
                </div>

                <div class="objetivo-card">
                    <h4>Residuos peligrosos</h4>
                    <p>
                        Manejar correctamente los residuos peligrosos generados, cumpliendo con
                        la normatividad ambiental correspondiente.
                    </p>
                </div>

                <div class="objetivo-card">
                    <h4>Agua</h4>
                    <p>
                        Promover el uso eficiente del agua, el tratamiento de aguas residuales
                        y la implementación de campañas de ahorro.
                    </p>
                </div>

                <div class="objetivo-card">
                    <h4>Aire</h4>
                    <p>
                        Reducir las emisiones de CO₂ mediante el uso de energías limpias,
                        equipos ahorradores y acciones sustentables.
                    </p>
                </div>

            </div>
        </div>

        <div class="cecam-image-box">
            <img src="public/media/concemas1.jpg" alt="Objetivos ambientales del CECAM">
            <p class="image-caption">
                área del Sistema de Gestión Ambiental de UPEMOR.
            </p>
        </div>

    </div>
</section>

<?php include 'partials/footer.php'; ?>