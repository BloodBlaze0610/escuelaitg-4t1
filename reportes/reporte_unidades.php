
<?php
include("../conexion.php");

$consulta = "SELECT id_unidad, descripcion FROM unidad ORDER BY id_unidad ASC";
$resultado = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Unidades</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include("../navegacion/navegacion.php"); ?>

    <div class="container mt-4">

        <h2 class="text-center mb-4">Reporte de Unidades</h2>

        <div class="mb-3">
            <a href="../index.php" class="btn btn-secondary">Regresar al inicio</a>
            <button onclick="window.print()" class="btn btn-primary">Imprimir reporte</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="table-primary">
                    <tr>
                        <th>ID de Unidad</th>
                        <th>Descripción</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($resultado && $resultado->num_rows > 0) { ?>

                        <?php while ($fila = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fila["id_unidad"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["descripcion"]); ?></td>
                            </tr>
                        <?php } ?>

                    <?php } else { ?>

                        <tr>
                            <td colspan="2" class="text-center">
                                No hay unidades registradas.
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
