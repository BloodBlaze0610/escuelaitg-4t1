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
            Catálogo de Profesores
        </h3>

        <div class="d-flex justify-content-end mb-3">

            <a href="../../registro/profesores.php"
               class="btn btn-success">
                + Registrar Profesor
            </a>

        </div>

        <div class="tabla-contenedor">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

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
                                    <?php echo htmlspecialchars($profesor["nocontrol_prof"] ?? ""); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($profesor["nombre_prof"] ?? ""); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($profesor["apaterno_prof"] ?? ""); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($profesor["amaterno_prof"] ?? ""); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($profesor["dom_prof"] ?? ""); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($profesor["mail_prof"] ?? ""); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($profesor["tel_prof"] ?? ""); ?>
                                </td>

                                <td>

                                    <div class="acciones">

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

                                    </div>

                                </td>

                            </tr>

                        <?php } ?>

                        <?php if (count($profesores) == 0) { ?>

                            <tr>
                                <td colspan="9" class="text-center">
                                    No hay profesores registrados.
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