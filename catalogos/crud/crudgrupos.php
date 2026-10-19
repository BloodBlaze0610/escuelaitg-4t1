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
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .tabla-contenedor {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table th,
        .table td {
            white-space: nowrap;
        }

        .titulo {
            color: #555;
            margin-bottom: 20px;
        }

        .acciones {
            display: flex;
            gap: 5px;
            align-items: center;
        }
    </style>

</head>

<body>

    <!-- ENCABEZADO -->
    <div class="encabezado">
        <h4 class="text-secondary mb-0">
            Sistema Escolar
        </h4>
    </div>

    <!-- BARRA DE NAVEGACIÓN -->
    <?php include("../../navegacion/navegacion.php"); ?>

    <!-- CONTENIDO -->
    <div class="container-fluid contenido px-3 px-md-4">

        <h3 class="text-center titulo">
            Catálogo de Grupos
        </h3>

        <div class="d-flex justify-content-end mb-3">

            <a href="../../registro/grupos.php"
               class="btn btn-success">
                + Registrar Grupo
            </a>

        </div>

        <div class="tabla-contenedor">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

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
                                    <?php echo htmlspecialchars($grupo["descripcion_grupo"] ?? ""); ?>
                                </td>

                                <td>

                                    <div class="acciones">

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

                                    </div>

                                </td>

                            </tr>

                        <?php } ?>

                        <?php if (count($grupos) == 0) { ?>

                            <tr>
                                <td colspan="3" class="text-center">
                                    No hay grupos registrados.
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- SCRIPT DE BOOTSTRAP PARA ACTIVAR LOS MENÚS DESPLEGABLES -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>