
<?php
include("../conexion.php");

$consultaAlumnos = "SELECT matricula_al, nombre_al, apaterno_al, amaterno_al
                    FROM alumnos
                    ORDER BY apaterno_al, nombre_al";

$resultadoAlumnos = $conexion->query($consultaAlumnos);

$consultaUnidades = "SELECT id_unidad, descripcion FROM unidad
                     ORDER BY id_unidad";

$resultadoUnidades = $conexion->query($consultaUnidades);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura Masiva de Calificaciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include("../navegacion/navegacion.php"); ?>

    <div class="container mt-4 mb-5">

        <h2 class="text-center mb-3">Captura Masiva de Calificaciones</h2>

        <p class="text-center">
            Selecciona la unidad y escribe la calificación de cada alumno.
            Puedes dejar vacíos los alumnos que no vayas a calificar.
        </p>

        <form action="../proceso/procesar_calificaciones_masivas.php" method="POST">

            <div class="mb-4">
                <label class="form-label">Unidad</label>

                <select name="id_unidad" class="form-select" required>
                    <option value="">Selecciona una unidad</option>

                    <?php while ($fila = $resultadoUnidades->fetch_assoc()) {
                        $idUnidad = htmlspecialchars($fila["id_unidad"]);
                        $descripcion = htmlspecialchars($fila["descripcion"]);

                        echo "<option value='$idUnidad'>$descripcion</option>";
                    } ?>
                </select>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">

                    <thead class="table-primary">
                        <tr>
                            <th>Matrícula</th>
                            <th>Nombre del alumno</th>
                            <th>Calificación</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 0;

                        while ($fila = $resultadoAlumnos->fetch_assoc()) {
                            $matricula = htmlspecialchars($fila["matricula_al"]);
                            $nombre = htmlspecialchars(
                                $fila["nombre_al"] . " " .
                                $fila["apaterno_al"] . " " .
                                $fila["amaterno_al"]
                            );
                        ?>

                            <tr>
                                <td>
                                    <?php echo $matricula; ?>
                                    <input
                                        type="hidden"
                                        name="id_alumno[]"
                                        value="<?php echo $matricula; ?>">
                                </td>

                                <td><?php echo $nombre; ?></td>

                                <td>
                                    <input
                                        type="number"
                                        name="cal[]"
                                        class="form-control"
                                        min="0"
                                        max="100"
                                        step="0.01"
                                        placeholder="0 a 100">
                                </td>
                            </tr>

                        <?php
                            $i++;
                        } ?>

                        <?php if ($i == 0) { ?>
                            <tr>
                                <td colspan="3" class="text-center">
                                    No hay alumnos registrados.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>

            <button type="submit" class="btn btn-primary">
                Guardar Calificaciones
            </button>

            <a href="../index.php" class="btn btn-secondary">
                Regresar
            </a>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conexion->close();
?>
