<?php
session_start();
// Validamos que solo entren Admin (1) o Profesor (2)
if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../navegacion/header.php");
include("../navegacion/navegacion.php");
?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Procesos del Sistema
    </h2>

    <p class="text-center">
        Selecciona el proceso que deseas realizar.
    </p>

    <div class="row mt-5 justify-content-center">

        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Alumnos</h5>
                    <a href="../registro/alumnos.php" class="btn btn-success mt-2">Registrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Grupos</h5>
                    <a href="../registro/grupos.php" class="btn btn-success mt-2">Registrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Materias</h5>
                    <a href="../registro/materias.php" class="btn btn-success mt-2">Registrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Profesores</h5>
                    <a href="../registro/profesores.php" class="btn btn-success mt-2">Registrar</a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
include("../navegacion/footer.php");
?>