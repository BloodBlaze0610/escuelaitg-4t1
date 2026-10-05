<?php

include("../conexion.php");

$nocontrol = $_GET["nocontrol"];

$sql = "SELECT nocontrol_prof, nombre_prof, apaterno_prof, amaterno_prof
        FROM profesores
        WHERE nocontrol_prof = '$nocontrol'";

$resultado = $conexion->query($sql);

if (!$resultado || $resultado->num_rows == 0) {

    die("Profesor no encontrado");

}

$profesor = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Baja de Profesor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card">

        <div class="card-body">

            <h4 class="text-danger">
                Dar de baja profesor
            </h4>

            <p>
                ¿Estás seguro de que deseas dar de baja a este profesor?
            </p>

            <p>
                <strong>No. de Control:</strong>
                <?php echo htmlspecialchars($profesor["nocontrol_prof"]); ?>
            </p>

            <p>
                <strong>Nombre:</strong>
                <?php echo htmlspecialchars($profesor["nombre_prof"]); ?>
                <?php echo htmlspecialchars($profesor["apaterno_prof"]); ?>
                <?php echo htmlspecialchars($profesor["amaterno_prof"]); ?>
            </p>

            <form action="confirmar_baja_profesor.php" method="POST">

                <input type="hidden"
                       name="nocontrol_prof"
                       value="<?php echo htmlspecialchars($profesor["nocontrol_prof"]); ?>">

                <button type="submit" class="btn btn-danger">
                    Sí, dar de baja
                </button>

                <a href="../catalogos/crud/crudprofesores.php"
                   class="btn btn-secondary">
                    Cancelar
                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>