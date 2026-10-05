<?php

include("../conexion.php");

$fila = $_GET["fila"];

$resultado = $conexion->query("SELECT matricula_al, nombre_al, apaterno_al, amaterno_al, dom_al, mail_al, tel_al 
FROM alumnos 
LIMIT 1 OFFSET $fila");

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$alumno = $resultado->fetch_assoc();

if (!$alumno) {
    die("No se encontró el alumno.");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Baja de Alumno</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="alert alert-danger text-center">

        <h2>Baja de Alumno</h2>

    </div>

    <h4 class="text-center mb-4">
        ¿Estás seguro de dar de baja a este alumno?
    </h4>


    <div class="card">

        <div class="card-body">

            <p>
                <strong>Matrícula:</strong>
                <?php echo $alumno["matricula_al"]; ?>
            </p>

            <p>
                <strong>Nombre:</strong>
                <?php echo $alumno["nombre_al"]; ?>
            </p>

            <p>
                <strong>Apellido Paterno:</strong>
                <?php echo $alumno["apaterno_al"]; ?>
            </p>

            <p>
                <strong>Apellido Materno:</strong>
                <?php echo $alumno["amaterno_al"]; ?>
            </p>

            <p>
                <strong>Domicilio:</strong>
                <?php echo $alumno["dom_al"]; ?>
            </p>

            <p>
                <strong>Email:</strong>
                <?php echo $alumno["mail_al"]; ?>
            </p>

            <p>
                <strong>Teléfono:</strong>
                <?php echo $alumno["tel_al"]; ?>
            </p>


            <div class="text-center mt-4">

                <form action="confirmar_baja.php" method="POST">

                    <input type="hidden"
                           name="fila"
                           value="<?php echo $fila; ?>">

                    <button type="submit" class="btn btn-danger">
                        Dar de baja
                    </button>

                    <a href="../catalogos/crud/crudalumnos.php"
                       class="btn btn-secondary">
                        Cancelar
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

</body>

</html>