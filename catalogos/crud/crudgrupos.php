
<?php

include("../../conexion.php");

$resultado = $conexion->query("SELECT descripcion_grupo FROM grupo");

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$grupos = $resultado->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo de Grupos</title>

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


    <!-- Barra de navegación azul -->

    <nav class="navbar navbar-expand-lg navbar-dark"
         style="background-color: #4285d4;">

        <div class="container-fluid">

            <a class="navbar-brand" href="#">Navbar</a>

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


    <!-- Catálogo -->

    <div class="container mt-5">

        <h4 class="text-center text-secondary mb-4">
            Catálogo de Grupos
        </h4>

        <div class="table-responsive">

            <table class="table table-sm table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>#</th>
                        <th>Descripción del grupo</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($grupos as $indice => $grupo) { ?>

                        <tr>

                            <td>
                                <?php echo $indice + 1; ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($grupo["descripcion_grupo"]); ?>
                            </td>

                        <td>

                            <a href="../../registro/grupos.php"
                             class="btn btn-dark btn-sm">
                             +
                            </a>

                             <a href="../../modificacion/modif_grupo.php?descripcion=<?php echo urlencode($grupo["descripcion_grupo"]); ?>"
                                 class="btn btn-primary btn-sm">
                                 Editar
                             </a>

                            <a href="../../baja/baja_grupo.php?descripcion=<?php echo urlencode($grupo["descripcion_grupo"]); ?>"
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