<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$rol = $_SESSION['puesto'] ?? 0;
$nombre_usuario = $_SESSION['usuario'];

include("navegacion/header.php");
include("navegacion/navegacion.php");
?>

<!-- CONTENEDOR PRINCIPAL QUE RESPETA EL MARGEN DEL SIDEBAR -->
<div class="main-content-wrapper">

    <!-- ENCABEZADO SUPERIOR INSTITUCIONAL -->
    <div style="background: linear-gradient(135deg, #1c1e21 0%, #2c3034 100%); color: #ffffff; padding: 25px 35px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #343a40;">
        <div>
            <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0;">Sistema Escolar Institucional</h2>
            <p style="color: #adb5bd; font-size: 0.85rem; margin: 0;">Tecnológico Nacional de México – ITGAM II</p>
        </div>
        <div style="display: flex; align-items: center; gap: 12px; background: rgba(255, 255, 255, 0.08); padding: 8px 16px; border-radius: 30px; border: 1px solid rgba(255, 255, 255, 0.1);">
            <div style="width: 38px; height: 38px; background-color: #495057; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #fff;">👤</div>
            <div>
                <div style="font-size: 0.8rem; color: #adb5bd;">Bienvenido(a)</div>
                <div style="font-size: 0.9rem; font-weight: 600;"><?php echo htmlspecialchars($nombre_usuario); ?> 
                    <span class="badge bg-secondary ms-1" style="font-size: 0.65rem;">
                        <?php 
                            if($rol == 1) echo "Administrador";
                            elseif($rol == 2) echo "Profesor";
                            else echo "Alumno";
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- CUERPO DE LA PÁGINA -->
    <div class="container-fluid p-4">

        <div style="background-color: #ffffff; border: 1px solid #dee2e6; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); padding: 30px;">
            
            <h3 class="mb-2 fw-bold text-dark">Menú Principal</h3>
            <p class="text-muted mb-4">Selecciona una opción del sistema o utiliza los accesos rápidos disponibles para tu perfil.</p>

            <!-- ACCESOS RÁPIDOS (Admin y Profesores) -->
            <?php if ($rol == 1 || $rol == 2) { ?>
                <div class="row mb-4 g-3">
                    <div class="col-md-6">
                        <a href="proceso/index.php" class="btn btn-dark w-100 py-3 fw-semibold d-flex align-items-center justify-content-center gap-2">
                            <span>📋</span> Módulo de Procesos (Calificaciones e Inscripciones)
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="reportes/index.php" class="btn btn-outline-dark w-100 py-3 fw-semibold d-flex align-items-center justify-content-center gap-2">
                            <span>📊</span> Módulo de Reportes Académicos
                        </a>
                    </div>
                </div>
                <hr class="my-4 text-muted">
            <?php } ?>

            <!-- CATÁLOGOS (EXCLUSIVO PARA ADMINISTRADOR) -->
            <?php if ($rol == 1) { ?>
                <h4 class="text-dark mb-3 fw-bold fs-5">Catálogos del Sistema</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-light">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title fw-bold text-dark">Alumnos</h5>
                                <p class="text-muted small">Gestión de matrícula y datos personales.</p>
                                <a href="catalogos/crud/crudalumnos.php" class="btn btn-dark btn-sm px-4">Gestionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-light">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title fw-bold text-dark">Grupos</h5>
                                <p class="text-muted small">Administración de grupos escolares.</p>
                                <a href="catalogos/crud/crudgrupos.php" class="btn btn-dark btn-sm px-4">Gestionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-light">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title text-dark fw-bold">Materias</h5>
                                <p class="text-muted small">Catálogo de asignaturas impartidas.</p>
                                <a href="catalogos/crud/crudmaterias.php" class="btn btn-dark btn-sm px-4">Gestionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-light">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title text-dark fw-bold">Profesores</h5>
                                <p class="text-muted small">Directorio y control docente.</p>
                                <a href="catalogos/crud/crudprofesores.php" class="btn btn-dark btn-sm px-4">Gestionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-light">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title text-dark fw-bold">Unidades</h5>
                                <p class="text-muted small">Configuración de periodos y unidades.</p>
                                <a href="catalogos/crud/crudunidad.php" class="btn btn-dark btn-sm px-4">Gestionar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-secondary text-center py-4">
                    Estás ingresando como <strong><?php echo ($rol == 2) ? 'Profesor' : 'Alumno'; ?></strong>. Utiliza los accesos del menú lateral para realizar tus actividades.
                </div>
            <?php } ?>

        </div>

    </div>

</div>

<?php
include("navegacion/footer.php");
?>