
<?php

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../registro/calificaciones_masivas.php");
    exit;
}

$id_unidad = filter_input(INPUT_POST, "id_unidad", FILTER_VALIDATE_INT);
$alumnos = $_POST["id_alumno"] ?? [];
$calificaciones = $_POST["cal"] ?? [];

if (
    $id_unidad === false ||
    $id_unidad === null ||
    !is_array($alumnos) ||
    !is_array($calificaciones) ||
    count($alumnos) !== count($calificaciones)
) {
    exit("Error: verifica la unidad y los datos enviados.");
}

/* Comprobar que la unidad exista */
$stmtUnidad = $conexion->prepare(
    "SELECT id_unidad FROM unidad WHERE id_unidad = ?"
);
$stmtUnidad->bind_param("i", $id_unidad);
$stmtUnidad->execute();
$stmtUnidad->store_result();

if ($stmtUnidad->num_rows === 0) {
    $stmtUnidad->close();
    exit("Error: la unidad seleccionada no existe.");
}

$stmtUnidad->close();

/* Preparar las consultas */
$stmtAlumno = $conexion->prepare(
    "SELECT matricula_al FROM alumnos WHERE matricula_al = ?"
);

$stmtInsertar = $conexion->prepare(
    "INSERT INTO capcal (id_alumno, cal, id_unidad)
     VALUES (?, ?, ?)"
);

if (!$stmtAlumno || !$stmtInsertar) {
    exit("Error al preparar las consultas.");
}

$registradas = 0;
$errores = [];
$conexion->begin_transaction();

try {
    foreach ($alumnos as $indice => $matricula) {

        $matricula = trim((string)$matricula);
        $cal = $calificaciones[$indice] ?? "";

        /* Los campos vacíos se omiten */
        if (trim((string)$cal) === "") {
            continue;
        }

        if (!is_numeric($cal) || $cal < 0 || $cal > 100) {
            throw new Exception("Hay una calificación fuera del rango de 0 a 100.");
        }

        $stmtAlumno->bind_param("s", $matricula);
        $stmtAlumno->execute();
        $stmtAlumno->store_result();

        if ($stmtAlumno->num_rows === 0) {
            throw new Exception("Se encontró una matrícula que no existe.");
        }

        $stmtAlumno->free_result();

        $cal = (float)$cal;

        $stmtInsertar->bind_param("sdi", $matricula, $cal, $id_unidad);

        if (!$stmtInsertar->execute()) {
            throw new Exception("No se pudo guardar una de las calificaciones.");
        }

        $registradas++;
    }

    if ($registradas === 0) {
        throw new Exception("No ingresaste ninguna calificación.");
    }

    $conexion->commit();

} catch (Exception $e) {

    $conexion->rollback();

    $stmtAlumno->close();
    $stmtInsertar->close();
    $conexion->close();

    exit("No se guardaron las calificaciones. " . htmlspecialchars($e->getMessage()));

}

$stmtAlumno->close();
$stmtInsertar->close();
$conexion->close();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones guardadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <div class="alert alert-success">
            Se registraron correctamente
            <?php echo $registradas; ?>
            calificación(es).
        </div>

        <a href="../registro/calificaciones_masivas.php" class="btn btn-primary">
            Capturar más calificaciones
        </a>

        <a href="../catalogos/crud/crudcalificaciones.php" class="btn btn-secondary">
            Consultar calificaciones
        </a>

    </div>

</body>
</html>
