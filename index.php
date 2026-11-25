<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$rol = $_SESSION['puesto'] ?? 0;
$nombre_usuario = $_SESSION['usuario'];

$etiqueta_rol = "Alumno";
if ($rol == 1) {
    $etiqueta_rol = "Administrador";
} elseif ($rol == 2) {
    $etiqueta_rol = "Profesor";
}

include("navegacion/header.php");
include("navegacion/navegacion.php");
?>

<style>
    body {
        background-color: #f4f5f7;
        font-family: system-ui, -apple-system, sans-serif;
        color: #1c1e21;
        margin: 0;
    }

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

    .panel-principal {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        padding: 32px 35px;
    }

    .catalogo-card {
        background-color: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .catalogo-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .btn-institucional {
        background-color: #1c1e21;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .btn-institucional:hover {
        background-color: #343a40;
        color: #ffffff;
    }
</style>

<!-- CONTENEDOR PRINCIPAL QUE RESPETA EL MARGEN DEL SIDEBAR -->
<div class="main-content-wrapper">

    <!-- ENCABEZADO SUPERIOR INSTITUCIONAL -->
    <div class="top-header">
        <div>
            <h2>Sistema Escolar Institucional</h2>
            <p>Tecnológico Nacional de México – ITGAM II</p>
        </div>
        <div class="user-profile">
            <div class="user-avatar"><i class="bi bi-person-fill"></i></div>
            <div>
                <div style="font-size: 0.8rem; color: #adb5bd;">Bienvenido(a)</div>
                <div style="font-size: 0.9rem; font-weight: 600;">
                    <?php echo htmlspecialchars($nombre_usuario); ?>
                    <span class="badge bg-secondary ms-1" style="font-size: 0.65rem;">
                        <?php echo htmlspecialchars($etiqueta_rol); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- CUERPO DE LA PÁGINA -->
    <div class="container-fluid p-4">

        <div class="panel-principal">

            <div class="pb-3 mb-4 border-bottom">
                <h3 class="mb-1 fw-bold text-dark">Menú Principal</h3>
                <p class="text-muted small mb-0">Selecciona una opción del sistema o utiliza los accesos rápidos disponibles para tu perfil.</p>
            </div>

            <!-- ACCESOS RÁPIDOS (Admin y Profesores) -->
            <?php if ($rol == 1 || $rol == 2) { ?>
                <div class="row mb-4 g-3">
                    <div class="col-md-6">
                        <a href="proceso/index.php" class="btn-institucional w-100 py-3 px-4 text-decoration-none d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-list-check fs-5"></i>
                            <span>Módulo de Procesos (Calificaciones e Inscripciones)</span>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="reportes/index.php" class="btn btn-outline-dark w-100 py-3 px-4 fw-semibold d-flex align-items-center justify-content-center gap-2" style="border-radius: 8px;">
                            <i class="bi bi-file-earmark-bar-graph fs-5"></i>
                            <span>Módulo de Reportes Académicos</span>
                        </a>
                    </div>
                </div>
                <hr class="my-4 text-muted">
            <?php } ?>

            <!-- CATÁLOGOS (EXCLUSIVO PARA ADMINISTRADOR) -->
            <?php if ($rol == 1) { ?>
                <h4 class="text-dark mb-3 fw-bold fs-5">
                    <i class="bi bi-grid-1x2-fill me-2"></i>Catálogos del Sistema
                </h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card catalogo-card h-100">
                            <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-dark">Alumnos</h5>
                                    <p class="text-muted small">Gestión de matrícula y datos personales.</p>
                                </div>
                                <div>
                                    <a href="catalogos/crud/crudalumnos.php" class="btn-institucional btn-sm px-4 py-2 text-decoration-none d-inline-block">Gestionar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card catalogo-card h-100">
                            <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-dark">Grupos</h5>
                                    <p class="text-muted small">Administración de grupos escolares.</p>
                                </div>
                                <div>
                                    <a href="catalogos/crud/crudgrupos.php" class="btn-institucional btn-sm px-4 py-2 text-decoration-none d-inline-block">Gestionar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card catalogo-card h-100">
                            <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-dark">Materias</h5>
                                    <p class="text-muted small">Catálogo de asignaturas impartidas.</p>
                                </div>
                                <div>
                                    <a href="catalogos/crud/crudmaterias.php" class="btn-institucional btn-sm px-4 py-2 text-decoration-none d-inline-block">Gestionar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card catalogo-card h-100">
                            <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-dark">Profesores</h5>
                                    <p class="text-muted small">Directorio y control docente.</p>
                                </div>
                                <div>
                                    <a href="catalogos/crud/crudprofesores.php" class="btn-institucional btn-sm px-4 py-2 text-decoration-none d-inline-block">Gestionar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card catalogo-card h-100">
                            <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fw-bold text-dark">Unidades</h5>
                                    <p class="text-muted small">Configuración de periodos y unidades.</p>
                                </div>
                                <div>
                                    <a href="catalogos/crud/crudunidad.php" class="btn-institucional btn-sm px-4 py-2 text-decoration-none d-inline-block">Gestionar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-secondary text-center py-4 mb-0">
                    Estás ingresando como <strong><?php echo htmlspecialchars($etiqueta_rol); ?></strong>. Utiliza los accesos del menú lateral para realizar tus actividades.
                </div>
            <?php } ?>

        </div>

    </div>

</div>

<?php
include("navegacion/footer.php");
?>