<?php

include("../../conexion.php");

$resultado = $conexion->query("SELECT descripcion_mat FROM materias");

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$materias = $resultado->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo de Materias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">


    <!-- Título superior -->

    <div class="container-fluid bg-white text-center py-3">

        <h4 class="text-secondary">
            Sistema Escolar
        </h4>

    </div>


    <!-- Barra de navegación -->

    <nav class="navbar navbar-expand-lg navbar-dark"
         style="background-color: #4285d4;">

        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                Navbar
            </a>

            <div class="navbar-nav">

                <a class="nav-link active"
                   href="crudmaterias.php">
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


    <!-- Catálogo -->

    <div class="container mt-5">

        <h4 class="text-center text-secondary mb-4">
            Catálogo de Materias
        </h4>


        <!-- Botón registrar -->

        <div class="mb-3">

            <a href="../../registro/materias.php" class="btn btn-success">
               + Registrar Materia
           </a>

        </div>


        <div class="table-responsive">

            <table class="table table-sm table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>#</th>

                        <th>
                            Descripción de la materia
                        </th>

                        <th>
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($materias as $indice => $materia) { ?>

                        <tr>

                            <td>
                                <?php echo $indice + 1; ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($materia["descripcion_mat"]); ?>
                            </td>

                            <td>

                              <a href="../../registro/materias.php"
                                  class="btn btn-dark btn-sm">
                                 +
                             </a>

                              <a href="../../modificacion/modif_materia.php?materia=<?php echo urlencode($materia["descripcion_mat"]); ?>"
                                  class="btn btn-primary btn-sm">
                                   Editar
                              </a>
                              <a href="../../baja/baja_materia.php?materia=<?php echo urlencode($materia["descripcion_mat"]); ?>"
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