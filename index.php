<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$rol = $_SESSION['puesto'] ?? 0; // Obtenemos el rol del usuario logueado

include("navegacion/header.php");
include("navegacion/navegacion.php");
?>

<div class="container mt-5">

    <!-- BIENVENIDA -->
    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm">
        <div>
            <h4 class="text-secondary mb-0">
                Sistema Escolar - ¡Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>!
                <span class="badge bg-secondary ms-2">
                    <?php 
                        if($rol == 1) echo "Administrador";
                        elseif($rol == 2) echo "Profesor";
                        else echo "Alumno";
                    ?>
                </span>
            </h4>
        </div>
        <div>
            <a href="logout.php" class="btn btn-outline-danger btn-sm"></a>
        </div>
    </div>

    <h2 class="text-center text-secondary mb-3">Menú Principal</h2>
    <p class="text-center text-muted mb-4">Opciones disponibles para tu perfil.</p>

    <!-- ACCESOS RÁPIDOS (Visible para Admin y Profesores) -->
    <?php if ($rol == 1 || $rol == 2) { ?>
        <div class="row mb-4 justify-content-center">
            <div class="col-md-5 text-center">
                <a href="proceso/index.php" class="btn btn-success w-100 py-2 fw-bold"> Módulo de Procesos (Calificaciones)</a>
            </div>
            <div class="col-md-5 text-center">
                <a href="reportes/index.php" class="btn btn-info w-100 py-2 fw-bold text-white">Módulo de Reportes (Excel)</a>
            </div>
        </div>
        <hr class="mb-4">
    <?php } ?>

    <!-- CATÁLOGOS (EXCLUSIVO PARA ADMINISTRADOR) -->
    <?php if ($rol == 1) { ?>
        <h4 class="text-secondary mb-3">Catálogos del Sistema (Admin)</h4>
        <div class="row g-4">
            <div class="col-md-4 mb-3">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Alumnos</h5>
                        <a href="catalogos/crud/crudalumnos.php" class="btn btn-primary">Gestionar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Grupos</h5>
                        <a href="catalogos/crud/crudgrupos.php" class="btn btn-primary">Gestionar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Materias</h5>
                        <a href="catalogos/crud/crudmaterias.php" class="btn btn-primary">Gestionar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Profesores</h5>
                        <a href="catalogos/crud/crudprofesores.php" class="btn btn-primary">Gestionar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Unidades</h5>
                        <a href="catalogos/crud/crudunidad.php" class="btn btn-primary">Gestionar</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-info text-center">
            Estás ingresando como <strong><?php echo ($rol == 2) ? 'Profesor' : 'Alumno'; ?></strong>. Utiliza los accesos directos superiores para realizar tus actividades de captura o consulta.
        </div>
    <?php } ?>

</div>

<?php
include("navegacion/footer.php");
?>