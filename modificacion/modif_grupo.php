<?php

include("../conexion.php");

$descripcion = $_GET["descripcion"];

$resultado = $conexion->query(
    "SELECT descripcion_grupo 
     FROM grupo 
     WHERE descripcion_grupo = '$descripcion'"
);

if (!$resultado || $resultado->num_rows == 0) {

    die("Grupo no encontrado");

}

$grupo = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modificar Grupo</title>

    <!-- Bootstrap -->

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


    <!-- Barra azul -->

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


    <!-- Formulario -->

    <div class="container mt-5">

        <h4 class="text-center text-secondary mb-4">
            Modificar Grupo
        </h4>


        <form action="procesar_modif_grupo.php" method="POST">


            <!-- Descripción actual -->

            <input type="hidden"
                   name="descripcion_actual"
                   value="<?php echo htmlspecialchars($grupo["descripcion_grupo"]); ?>">


            <div class="mb-3">

                <label class="form-label">
                    Descripción del grupo
                </label>

                <input type="text"
                       name="descripcion_nueva"
                       class="form-control"
                       value="<?php echo htmlspecialchars($grupo["descripcion_grupo"]); ?>"
                       required>

            </div>


            <div class="text-center">

                <button type="submit"
                        class="btn btn-primary">
                    Guardar Cambios
                </button>

                <a href="../catalogos/crud/crudgrupos.php"
                   class="btn btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>


</body>

</html>