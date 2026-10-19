
<?php
// reportes/index.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Reportes - Sistema Escolar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6f8;
        }

        .encabezado {
            background-color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .contenido {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

    <!-- ENCABEZADO -->
    <div class="encabezado">
        <h4 class="text-secondary mb-0">
            Sistema Escolar - Módulo de Reportes
        </h4>
    </div>

    <!-- BARRA DE NAVEGACIÓN -->
    <?php include("../navegacion/navegacion.php"); ?>

    <div class="container contenido">

        <h2 class="text-center text-secondary mb-4">
            Reportes del Sistema
        </h2>

        <p class="text-center text-muted mb-5">
            Selecciona el reporte que deseas consultar e imprimir:
        </p>

        <div class="row g-4 justify-content-center">

            <!-- Reporte Alumnos -->
            <div class="col-md-5 col-lg-4">
                <div class="card p-4 text-center h-100">
                    <h5 class="card-title text-primary mb-3">
                        Reporte de Alumnos
                    </h5>

                    <p class="card-text text-muted small">
                        Lista completa de alumnos registrados con sus datos generales.
                    </p>

                    <a href="reporte_alumnos.php"
                       class="btn btn-outline-primary mt-2">
                        Entrar a Reporte de Alumnos
                    </a>
                </div>
            </div>

            <!-- Reporte Grupos -->
            <div class="col-md-5 col-lg-4">
                <div class="card p-4 text-center h-100">
                    <h5 class="card-title text-primary mb-3">
                        Reporte de Grupos
                    </h5>

                    <p class="card-text text-muted small">
                        Listado de los grupos activos dentro del sistema escolar.
                    </p>

                    <a href="reporte_grupos.php"
                       class="btn btn-outline-primary mt-2">
                        Entrar a Reporte de Grupos
                    </a>
                </div>
            </div>

            <!-- Reporte Materias -->
            <div class="col-md-5 col-lg-4">
                <div class="card p-4 text-center h-100">
                    <h5 class="card-title text-primary mb-3">
                        Reporte de Materias
                    </h5>

                    <p class="card-text text-muted small">
                        Catálogo y distribución de materias correspondientes.
                    </p>

                    <a href="reporte_materias.php"
                       class="btn btn-outline-primary mt-2">
                        Entrar a Reporte de Materias
                    </a>
                </div>
            </div>

            <!-- Reporte Profesores -->
            <div class="col-md-5 col-lg-4">
                <div class="card p-4 text-center h-100">
                    <h5 class="card-title text-primary mb-3">
                        Reporte de Profesores
                    </h5>

                    <p class="card-text text-muted small">
                        Plantilla de profesores registrados en la institución.
                    </p>

                    <a href="reporte_profesores.php"
                       class="btn btn-outline-primary mt-2">
                        Entrar a Reporte de Profesores
                    </a>
                </div>
            </div>

            <!-- Reporte Unidades -->
            <div class="col-md-5 col-lg-4">
                <div class="card p-4 text-center h-100">
                    <h5 class="card-title text-primary mb-3">
                        Reporte de Unidades
                    </h5>

                    <p class="card-text text-muted small">
                        Consulta las unidades registradas en el Sistema Escolar.
                    </p>

                    <a href="reporte_unidades.php"
                       class="btn btn-outline-primary mt-2">
                        Entrar a Reporte de Unidades
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
