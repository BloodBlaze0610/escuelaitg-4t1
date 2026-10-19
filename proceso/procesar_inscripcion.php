
<?php

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../registro/inscripcion.php");
    exit;
}

$id_alumno = trim($_POST["id_alumno"] ?? "");
$id_grupo = trim($_POST["id_grupo"] ?? "");

if ($id_alumno == "" || $id_grupo == "") {
    header("Location: ../registro/inscripcion.php?error=vacio");
    exit;
}

$consulta = "INSERT INTO insgrup (id_grupo, id_alumno)
             VALUES (?, ?)";

$stmt = $conexion->prepare($consulta);
$stmt->bind_param("ss", $id_grupo, $id_alumno);

if ($stmt->execute()) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Inscripción registrada</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-5'>
            <div class='alert alert-success'>
                ¡La inscripción se registró correctamente!
            </div>
            <a href='../registro/inscripcion.php' class='btn btn-primary'>
                Registrar otra inscripción
            </a>
            <a href='../index.php' class='btn btn-secondary'>
                Regresar al inicio
            </a>
        </div>
    </body>
    </html>";
} else {
    echo "Error al inscribir al alumno: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conexion->close();

?>

