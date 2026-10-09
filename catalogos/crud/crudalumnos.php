<?php

include("../../conexion.php");

$resultado = $conexion->query("SELECT matricula_al, nombre_al, apaterno_al, amaterno_al, dom_al, mail_al, tel_al FROM alumnos");

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$alumnos = $resultado->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo de Alumnos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container-fluid bg-white text-center py-3">

    <h4 class="text-secondary">
        Sistema Escolar
    </h4>

</div>

<nav class="navbar navbar-expand-lg navbar-dark"
     style="background-color: #4285d4;">

    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            Navbar
        </a>

        <div class="navbar-nav">

            <a class="nav-link active"
               href="crudalumnos.php">
                Catálogos
            </a>

            <a class="nav-link" href="#">
                Procesos
            </a>

            <a class="nav-link" href="#">
                Reportes
            </a>

        </div>

    </div>

 </nav>

      <div class="container-fluid bg-white text-center py-3">
        ...
      </div>

     <nav class="navbar ...
         ...
     </nav>

    <h4 class="text-center text-secondary mb-4">
        Catálogo de Alumnos
    </h4>

    <div class="mb-3">

        <a href="../../registro/alumnos.php"
           class="btn btn-success">
            + Registrar Alumno
        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-sm table-hover">

            <thead class="table-dark">

                <tr>

                    <th>#</th>
                    <th>Matrícula</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Domicilio</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($alumnos as $indice => $alumno) { ?>

                    <tr>

                        <td>
                            <?php echo $indice + 1; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["matricula_al"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["nombre_al"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["apaterno_al"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["amaterno_al"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["dom_al"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["mail_al"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["tel_al"]); ?>
                        </td>

                        <td>

                            <a href="../../registro/alumnos.php"
                               class="btn btn-dark btn-sm">
                                +
                            </a>

                            <a href="../../modificacion/modif_alumnos.php?fila=<?php echo urlencode($indice); ?>"
                               class="btn btn-primary btn-sm">
                                Editar
                            </a>

                            <a href="../../baja/baja_alumnos.php?fila=<?php echo urlencode($indice); ?>"
                               class="btn btn-danger btn-sm">
                                Baja
                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>