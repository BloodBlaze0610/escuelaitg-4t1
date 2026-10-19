
<?php
include("../../conexion.php");

$consulta = "SELECT id_in, id_grupo, id_alumno, status_ins
             FROM insgrup
             ORDER BY id_in DESC";

$resultado = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Inscripciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include("../../navegacion/navegacion.php"); ?>

    <div class="container mt-4">

        <h2 class="text-center mb-4">Catálogo de Inscripciones a Grupos</h2>

        <div class="mb-3">
            <a href="../../registro/inscripcion.php" class="btn btn-success">
                Nueva Inscripción
            </a>

            <a href="../../index.php" class="btn btn-secondary">
                Regresar al inicio
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="table-primary">
                    <tr>
                        <th>ID Inscripción</th>
                        <th>Grupo</th>
                        <th>Matrícula del Alumno</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($resultado && $resultado->num_rows > 0) { ?>

                        <?php while ($fila = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fila["id_in"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["id_grupo"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["id_alumno"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["status_ins"]); ?></td>
                            </tr>
                        <?php } ?>

                    <?php } else { ?>

                        <tr>
                            <td colspan="4" class="text-center">
                                No hay inscripciones registradas.
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>

            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conexion->close();
?>
