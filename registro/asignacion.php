
<?php
include("../conexion.php");

$consultaMaterias = "SELECT descripcion_mat FROM materias";
$resultadoMaterias = $conexion->query($consultaMaterias);

$consultaAlumnos = "SELECT matricula_al, nombre_al, apaterno_al, amaterno_al
                    FROM alumnos";
$resultadoAlumnos = $conexion->query($consultaAlumnos);

$consultaProfesores = "SELECT nocontrol_prof, nombre_prof FROM profesores";
$resultadoProfesores = $conexion->query($consultaProfesores);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Materias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include("../navegacion/navegacion.php"); ?>

    <div class="container mt-4">

        <h2 class="text-center mb-4">Asignación de Materias</h2>

        <form action="../proceso/procesar_asignacion.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Materia</label>

                <select name="id_mat" class="form-select" required>
                    <option value="">Selecciona una materia</option>

                    <?php while ($fila = $resultadoMaterias->fetch_assoc()) {
                        $materia = htmlspecialchars($fila["descripcion_mat"]);
                        echo "<option value='$materia'>$materia</option>";
                    } ?>
                </select>
            </div>

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
                <label class="form-label">Profesor</label>

                <select name="id_profesor" class="form-select" required>
                    <option value="">Selecciona un profesor</option>

                    <?php while ($fila = $resultadoProfesores->fetch_assoc()) {
                        $control = htmlspecialchars($fila["nocontrol_prof"]);
                        $nombre = htmlspecialchars($fila["nombre_prof"]);

                        echo "<option value='$control'>$control - $nombre</option>";
                    } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                Asignar materia
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
