
<?php
include("../conexion.php");

$consultaAlumnos = "SELECT matricula_al, nombre_al, apaterno_al, amaterno_al
                    FROM alumnos";
$resultadoAlumnos = $conexion->query($consultaAlumnos);

$consultaUnidades = "SELECT id_unidad, descripcion FROM unidad";
$resultadoUnidades = $conexion->query($consultaUnidades);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura de Calificaciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include("../navegacion/navegacion.php"); ?>

    <div class="container mt-4">

        <h2 class="text-center mb-4">Captura Individual de Calificaciones</h2>

        <form action="../proceso/procesar_calificacion.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Alumno</label>

                <select name="id_alumno" class="form-select" required>
                    <option value="">Selecciona un alumno</option>

                    <?php while ($fila = $resultadoAlumnos->fetch_assoc()) {
                        $matricula = htmlspecialchars($fila["matricula_al"]);
                        $nombre = htmlspecialchars(
                            $fila["nombre_al"] . " " .
                            $fila["apaterno_al"] . " " .
                            $fila["amaterno_al"]
                        );

                        echo "<option value='$matricula'>$matricula - $nombre</option>";
                    } ?>
                </select>
            </div>

            <div class="mb-3">
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

            <div class="mb-3">
                <label class="form-label">Calificación</label>

                <input
                    type="number"
                    name="cal"
                    class="form-control"
                    min="0"
                    max="100"
                    step="0.01"
                    required
                    placeholder="Ejemplo: 85.50">
            </div>

            <button type="submit" class="btn btn-primary">
                Guardar Calificación
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
