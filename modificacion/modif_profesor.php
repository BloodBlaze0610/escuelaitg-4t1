<?php

include("../conexion.php");

$nocontrol = $_GET["nocontrol"];

$sql = "SELECT nocontrol_prof, nombre_prof, apaterno_prof, amaterno_prof, dom_prof, mail_prof, tel_prof
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

    <title>Modificar Profesor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <h3 class="text-center mb-4">
        Modificar Profesor
    </h3>

    <form action="../proceso/procesar_modif_profesor.php" method="POST">

        <input type="hidden"
               name="nocontrol_actual"
               value="<?php echo htmlspecialchars($profesor["nocontrol_prof"]); ?>">

        <div class="mb-3">
            <label class="form-label">No. de Control</label>

            <input type="text"
                   name="nocontrol_prof"
                   class="form-control"
                   maxlength="15"
                   value="<?php echo htmlspecialchars($profesor["nocontrol_prof"]); ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre</label>

            <input type="text"
                   name="nombre_prof"
                   class="form-control"
                   maxlength="15"
                   value="<?php echo htmlspecialchars($profesor["nombre_prof"]); ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Apellido Paterno</label>

            <input type="text"
                   name="apaterno_prof"
                   class="form-control"
                   maxlength="15"
                   value="<?php echo htmlspecialchars($profesor["apaterno_prof"]); ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Apellido Materno</label>

            <input type="text"
                   name="amaterno_prof"
                   class="form-control"
                   maxlength="15"
                   value="<?php echo htmlspecialchars($profesor["amaterno_prof"]); ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Domicilio</label>

            <input type="text"
                   name="dom_prof"
                   class="form-control"
                   maxlength="80"
                   value="<?php echo htmlspecialchars($profesor["dom_prof"]); ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   name="mail_prof"
                   class="form-control"
                   maxlength="50"
                   value="<?php echo htmlspecialchars($profesor["mail_prof"]); ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>

            <input type="text"
                   name="tel_prof"
                   class="form-control"
                   maxlength="35"
                   value="<?php echo htmlspecialchars($profesor["tel_prof"]); ?>"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Guardar Cambios
        </button>

        <a href="../catalogos/crud/crudprofesores.php"
           class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>

</html>