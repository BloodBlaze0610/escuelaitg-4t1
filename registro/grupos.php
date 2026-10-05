<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Grupos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            Registro de Grupos
        </h4>


        <form action="../proceso/procesar_grupo.php" method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Descripción
                </label>

                <input type="text"
                       name="descripcion"
                       class="form-control"
                       placeholder="Ingresa la descripción del grupo"
                       required>

            </div>


            <div class="text-center">

                <button type="submit"
                        class="btn btn-success">
                    Guardar Grupo
                </button>

                <a href="../catalogos/crud/crudgrupos.php"
                   class="btn btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>


    <!-- Bootstrap JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>