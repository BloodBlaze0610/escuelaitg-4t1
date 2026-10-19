
<?php
include("../conexion.php");

$sql = "SELECT
            capcal.id_capcal,
            capcal.id_alumno,
            alumnos.nombre_al,
            alumnos.apaterno_al,
            alumnos.amaterno_al,
            capcal.cal,
            unidad.descripcion
        FROM capcal
        INNER JOIN alumnos
            ON capcal.id_alumno = alumnos.matricula_al
        INNER JOIN unidad
            ON capcal.id_unidad = unidad.id_unidad
        ORDER BY alumnos.apaterno_al ASC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Calificaciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .contenedor {
            background: white;
            padding: 25px;
            margin-top: 30px;
            border-radius: 10px;
        }

        @media print {
            .no-imprimir {
                display: none;
            }

            body {
                background: white;
            }

            .contenedor {
                margin-top: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>

<?php include("../navegacion/navegacion.php"); ?>

<div class="container contenedor">

    <h2 class="text-center mb-4">Reporte de Calificaciones</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Nombre del alumno</th>
                    <th>Unidad</th>
                    <th>Calificación</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0) { ?>

                    <?php while ($fila = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $fila["id_capcal"]; ?></td>
                            <td><?php echo htmlspecialchars($fila["id_alumno"]); ?></td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $fila["nombre_al"] . " " .
                                    $fila["apaterno_al"] . " " .
                                    $fila["amaterno_al"]
                                );
                                ?>
                            </td>

                            <td><?php echo htmlspecialchars($fila["descripcion"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["cal"]); ?></td>
                        </tr>
                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="5" class="text-center">
                            No hay calificaciones registradas.
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-3 no-imprimir">
        <button onclick="window.print()" class="btn btn-primary">
            Imprimir reporte
        </button>

        <a href="../index.php" class="btn btn-secondary">
            Regresar al inicio
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
