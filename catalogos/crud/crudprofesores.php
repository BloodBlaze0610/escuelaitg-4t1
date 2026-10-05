<?php

include("../../conexion.php");

$resultado = $conexion->query("SELECT nocontrol_prof, nombre_prof, apaterno_prof, amaterno_prof, dom_prof, mail_prof, tel_prof FROM profesores");

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$profesores = $resultado->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo de Profesores</title>

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
               href="crudprofesores.php">
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

<div class="container mt-5">

    <h4 class="text-center text-secondary mb-4">
        Catálogo de Profesores
    </h4>

    <div class="mb-3">

        <a href="../../registro/profesores.php"
           class="btn btn-success">
            + Registrar Profesor
        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-sm table-hover">

            <thead class="table-dark">

                <tr>

                    <th>#</th>
                    <th>No. Control</th>
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

                <?php foreach ($profesores as $indice => $profesor) { ?>

                    <tr>

                        <td>
                            <?php echo $indice + 1; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($profesor["nocontrol_prof"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($profesor["nombre_prof"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($profesor["apaterno_prof"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($profesor["amaterno_prof"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($profesor["dom_prof"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($profesor["mail_prof"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($profesor["tel_prof"]); ?>
                        </td>

                        <td>

                            <a href="../../registro/profesores.php"
                               class="btn btn-dark btn-sm">
                                +
                            </a>

                            <a href="../../modificacion/modif_profesor.php?nocontrol=<?php echo urlencode($profesor["nocontrol_prof"]); ?>"
                               class="btn btn-primary btn-sm">
                                Editar
                            </a>

                            <a href="../../baja/baja_profesor.php?nocontrol=<?php echo urlencode($profesor["nocontrol_prof"]); ?>"
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