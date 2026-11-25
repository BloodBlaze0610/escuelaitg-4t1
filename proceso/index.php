<?php
session_start();
// Validamos que solo entren Admin (1) o Profesor (2)
if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';

include("../navegacion/header.php");
include("../navegacion/navegacion.php");
?>

<style>
    .top-header {
        background: linear-gradient(135deg, #1c1e21 0%, #2c3034 100%);
        color: #ffffff;
        padding: 25px 35px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #343a40;
    }

    .top-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .top-header p {
        color: #adb5bd;
        font-size: 0.85rem;
        margin: 0;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.08);
        padding: 8px 16px;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        background-color: #495057;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #fff;
    }

    .contenido-area {
        padding: 35px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .section-title-group {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .icon-box-dark {
        width: 64px;
        height: 64px;
        background-color: #1c1e21;
        color: #ffffff;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .titulo-texto h3 {
        font-size: 1.65rem;
        font-weight: 700;
        color: #1c1e21;
        margin: 0;
        padding-bottom: 6px;
        border-bottom: 1px solid #dee2e6;
    }

    .titulo-texto p {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 6px 0 0 0;
    }

    .proceso-card {
        background-color: #ffffff;
        border-radius: 14px;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        padding: 26px 22px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .proceso-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
    }

    .proceso-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background-color: #f4f5f7;
        color: #1c1e21;
        border: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.45rem;
        margin-bottom: 14px;
    }

    .proceso-card h5 {
        font-weight: 700;
        color: #1c1e21;
        margin-bottom: 8px;
    }

    .proceso-card p {
        color: #6c757d;
        font-size: 0.85rem;
        margin-bottom: 18px;
    }

    .btn-institucional {
        background-color: #1c1e21;
        color: #ffffff;
        border: none;
        padding: 9px 20px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.88rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .btn-institucional:hover {
        background-color: #343a40;
        color: #ffffff;
    }
</style>

<div class="main-content-wrapper">

    <!-- ENCABEZADO SUPERIOR -->
    <div class="top-header">
        <div>
            <h2>Sistema Escolar Institucional</h2>
            <p>Tecnológico Nacional de México – ITGAM II</p>
        </div>
        <div class="user-profile">
            <div class="user-avatar"><i class="bi bi-person-fill"></i></div>
            <div>
                <div style="font-size: 0.8rem; color: #adb5bd;">Bienvenido(a)</div>
                <div style="font-size: 0.9rem; font-weight: 600;"><?php echo htmlspecialchars($nombre_usuario); ?></div>
            </div>
        </div>
    </div>

    <!-- ÁREA DE CONTENIDO -->
    <div class="contenido-area">

        <div class="section-header">
            <div class="section-title-group">
                <div class="icon-box-dark">
                    <i class="bi bi-gear-wide-connected"></i>
                </div>
                <div class="titulo-texto">
                    <h3>Procesos del Sistema</h3>
                    <p>Selecciona el proceso de registro que deseas realizar en el sistema.</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="proceso-card">
                    <div>
                        <div class="proceso-icon mx-auto">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <h5>Alumnos</h5>
                        <p>Alta de nuevos estudiantes en el padrón escolar.</p>
                    </div>
                    <a href="../registro/alumnos.php" class="btn-institucional">
                        <i class="bi bi-plus-lg"></i> Registrar
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="proceso-card">
                    <div>
                        <div class="proceso-icon mx-auto">
                            <i class="bi bi-collection-fill"></i>
                        </div>
                        <h5>Grupos</h5>
                        <p>Registro de nuevos grupos y secciones académicas.</p>
                    </div>
                    <a href="../registro/grupos.php" class="btn-institucional">
                        <i class="bi bi-plus-lg"></i> Registrar
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="proceso-card">
                    <div>
                        <div class="proceso-icon mx-auto">
                            <i class="bi bi-journal-plus"></i>
                        </div>
                        <h5>Materias</h5>
                        <p>Incorporación de asignaturas al catálogo vigente.</p>
                    </div>
                    <a href="../registro/materias.php" class="btn-institucional">
                        <i class="bi bi-plus-lg"></i> Registrar
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="proceso-card">
                    <div>
                        <div class="proceso-icon mx-auto">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <h5>Profesores</h5>
                        <p>Registro de personal docente en el sistema.</p>
                    </div>
                    <a href="../registro/profesores.php" class="btn-institucional">
                        <i class="bi bi-plus-lg"></i> Registrar
                    </a>
                </div>
            </div>
        </div>

    </div>

    <?php
    include("../navegacion/footer.php");
    ?>

</div>