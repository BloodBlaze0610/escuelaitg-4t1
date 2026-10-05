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

    <title>Modificar Alumno</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="alert alert-warning text-center">

        <h2>Sistema Escolar</h2>

    </div>

    <h1 class="text-center mb-4">
        Modificar Alumno
    </h1>


    <form action="guardar_modificacion.php" method="POST">
        <input type="hidden"
          name="nombre_anterior"
          value="<?php echo $alumno["nombre_al"]; ?>">

        <input type="hidden"
       name="apaterno_anterior"
       value="<?php echo $alumno["apaterno_al"]; ?>">

         <input type="hidden"
         name="amaterno_anterior"
         value="<?php echo $alumno["amaterno_al"]; ?>">

        <input type="hidden"
          name="dom_anterior"
         value="<?php echo $alumno["dom_al"]; ?>">

        <input type="hidden"
         name="mail_anterior"
         value="<?php echo $alumno["mail_al"]; ?>">

        <input type="hidden"
         name="tel_anterior"
         value="<?php echo $alumno["tel_al"]; ?>">


        <div class="mb-3">

            <label class="form-label">
                Matrícula
            </label>

            <input type="text"
                   name="matricula_al"
                   class="form-control"
                   value="<?php echo $alumno["matricula_al"]; ?>"
                   readonly>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Nombre
            </label>

            <input type="text"
                   name="nombre_al"
                   class="form-control"
                   value="<?php echo $alumno["nombre_al"]; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Apellido Paterno
            </label>

            <input type="text"
                   name="apaterno_al"
                   class="form-control"
                   value="<?php echo $alumno["apaterno_al"]; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Apellido Materno
            </label>

            <input type="text"
                   name="amaterno_al"
                   class="form-control"
                   value="<?php echo $alumno["amaterno_al"]; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Domicilio
            </label>

            <input type="text"
                   name="dom_al"
                   class="form-control"
                   value="<?php echo $alumno["dom_al"]; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Teléfono
            </label>

            <input type="text"
                   name="tel_al"
                   class="form-control"
                   value="<?php echo $alumno["tel_al"]; ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input type="email"
                   name="mail_al"
                   class="form-control"
                   value="<?php echo $alumno["mail_al"]; ?>"
                   required>

        </div>


        <div class="text-center">

            <button type="submit" class="btn btn-primary">
                Guardar Cambios
            </button>

            <a href="../catalogos/crud/crudalumnos.php"
               class="btn btn-secondary">
                Cancelar
            </a>

        </div>


    </form>

</div>

</body>

</html>