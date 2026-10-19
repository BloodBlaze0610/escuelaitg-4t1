
<?php

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../registro/asignacion.php");
    exit;
}

$id_mat = trim($_POST["id_mat"] ?? "");
$id_alumno = trim($_POST["id_alumno"] ?? "");
$id_profesor = trim($_POST["id_profesor"] ?? "");

if ($id_mat == "" || $id_alumno == "" || $id_profesor == "") {
    echo "Error: debes seleccionar una materia, un alumno y un profesor.";
    exit;
}

$consulta = "INSERT INTO asigmat (id_mat, id_alumno, id_profesor)
             VALUES (?, ?, ?)";

$stmt = $conexion->prepare($consulta);
$stmt->bind_param("sss", $id_mat, $id_alumno, $id_profesor);

if ($stmt->execute()) {

    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Asignación registrada</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-5'>
            <div class='alert alert-success'>
                ¡La asignación de la materia se registró correctamente!
            </div>
            <a href='../registro/asignacion.php' class='btn btn-primary'>
                Registrar otra asignación
            </a>
            <a href='../index.php' class='btn btn-secondary'>
                Regresar al inicio
            </a>
        </div>
    </body>
    </html>";

} else {

    echo "Error al registrar la asignación: " . htmlspecialchars($stmt->error);

}

$stmt->close();
$conexion->close();

?>
