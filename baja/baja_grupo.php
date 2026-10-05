<?php

include("../conexion.php");

$descripcion = $_GET["descripcion"];

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Baja de Grupo</title>

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
                   href="../catalogos/crud/crudgrupos.php">
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

        <div class="card">

            <div class="card-body text-center">

                <h4 class="text-danger mb-4">
                    Baja de Grupo
                </h4>

                <p>
                    ¿Estás seguro de que deseas eliminar el grupo:
                </p>

                <h5>
                    <?php echo htmlspecialchars($descripcion); ?>
                </h5>


                <form action="confirmar_baja_grupo.php" method="POST">

                    <input type="hidden"
                           name="descripcion"
                           value="<?php echo htmlspecialchars($descripcion); ?>">


                    <button type="submit"
                            class="btn btn-danger">
                        Sí, dar de baja
                    </button>


                    <a href="../catalogos/crud/crudgrupos.php"
                       class="btn btn-secondary">
                        Cancelar
                    </a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>