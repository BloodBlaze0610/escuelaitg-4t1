<?php

$materia = $_GET["materia"];

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dar de Baja Materia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h3>Dar de Baja Materia</h3>

    <p>
        ¿Estás seguro de que deseas eliminar la materia?
    </p>

    <h5>
        <?php echo htmlspecialchars($materia); ?>
    </h5>

    <form action="confirmar_baja_materia.php" method="POST">

        <input type="hidden"
               name="descripcion_mat"
               value="<?php echo htmlspecialchars($materia); ?>">

        <button type="submit" class="btn btn-danger">
            Sí, dar de baja
        </button>

        <a href="../catalogos/crud/crudmaterias.php"
           class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>

</html>