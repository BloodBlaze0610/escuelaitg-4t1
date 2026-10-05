<?php

include("../conexion.php");

$materia = $_GET["materia"];

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modificar Materia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Modificar Materia</h2>

    <form action="../proceso/procesar_modif_materia.php" method="POST">

        <input type="hidden" name="materia_actual" value="<?php echo $materia; ?>">

        <div class="mb-3">

            <label class="form-label">Descripción de la materia</label>

            <input type="text"
                   name="descripcion_mat"
                   class="form-control"
                   value="<?php echo $materia; ?>"
                   required>

        </div>

        <button type="submit" class="btn btn-primary">
            Guardar Cambios
        </button>

        <a href="../catalogos/crud/crudmaterias.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>

</html>