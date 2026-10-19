
<?php
include("../../conexion.php");

$consulta = "SELECT id_asigmat, id_mat, id_alumno, id_profesor
             FROM asigmat
             ORDER BY id_asigmat DESC";

$resultado = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Asignaciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include("../../navegacion/navegacion.php"); ?>

    <div class="container mt-4">

        <h2 class="text-center mb-4">Catálogo de Asignaciones de Materias</h2>

        <div class="mb-3">
            <a href="../../registro/asignacion.php" class="btn btn-success">
                Nueva Asignación
            </a>

            <a href="../../index.php" class="btn btn-secondary">
                Regresar al inicio
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="table-primary">
                    <tr>
                        <th>ID Asignación</th>
                        <th>Materia</th>
                        <th>Matrícula del Alumno</th>
                        <th>Número de Control del Profesor</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($resultado && $resultado->num_rows > 0) { ?>

                        <?php while ($fila = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fila["id_asigmat"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["id_mat"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["id_alumno"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["id_profesor"]); ?></td>
                            </tr>
                        <?php } ?>

                    <?php } else { ?>

                        <tr>
                            <td colspan="4" class="text-center">
                                No hay asignaciones registradas.
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
