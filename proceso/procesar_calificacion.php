
<?php

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../registro/calificaciones.php");
    exit;
}

$id_alumno = trim($_POST["id_alumno"] ?? "");
$id_unidad = filter_input(INPUT_POST, "id_unidad", FILTER_VALIDATE_INT);
$cal = $_POST["cal"] ?? "";

if (
    $id_alumno == "" ||
    $id_unidad === false ||
    $id_unidad === null ||
    $cal === "" ||
    !is_numeric($cal) ||
    $cal < 0 ||
    $cal > 100
) {
    exit("Error: verifica el alumno, la unidad y la calificación. El valor debe estar entre 0 y 100.");
}

$consulta = "INSERT INTO capcal (id_alumno, cal, id_unidad)
             VALUES (?, ?, ?)";

$stmt = $conexion->prepare($consulta);
$stmt->bind_param("sdi", $id_alumno, $cal, $id_unidad);

if ($stmt->execute()) {

    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Calificación registrada</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-5'>
            <div class='alert alert-success'>
                ¡La calificación se registró correctamente!
            </div>
            <a href='../registro/calificaciones.php' class='btn btn-primary'>
                Registrar otra calificación
            </a>
            <a href='../index.php' class='btn btn-secondary'>
                Regresar al inicio
            </a>
        </div>
    </body>
    </html>";

} else {

    echo "Error al registrar la calificación: " . htmlspecialchars($stmt->error);

}

$stmt->close();
$conexion->close();

?>
