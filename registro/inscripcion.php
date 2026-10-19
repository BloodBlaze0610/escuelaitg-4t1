
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción a Grupos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include("../navegacion/navegacion.php"); ?>

    <div class="container mt-4">

        <h2 class="text-center mb-4">Inscripción a Grupos</h2>

        <form action="../proceso/procesar_inscripcion.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Alumno</label>

                <select name="id_alumno" class="form-select" required>
                    <option value="">Selecciona un alumno</option>

                    <?php
                    include("../conexion.php");

                    $consulta = "SELECT matricula_al, nombre_al, apaterno_al, amaterno_al
                                 FROM alumnos";
                    $resultado = $conexion->query($consulta);

                    while ($fila = $resultado->fetch_assoc()) {
                        $matricula = htmlspecialchars($fila["matricula_al"]);
                        $nombre = htmlspecialchars(
                            $fila["nombre_al"] . " " .
                            $fila["apaterno_al"] . " " .
                            $fila["amaterno_al"]
                        );

                        echo "<option value='$matricula'>$matricula - $nombre</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Grupo</label>

                <select name="id_grupo" class="form-select" required>
                    <option value="">Selecciona un grupo</option>

                    <?php
                    $consulta = "SELECT descripcion_grupo FROM grupo";
                    $resultado = $conexion->query($consulta);

                    while ($fila = $resultado->fetch_assoc()) {
                        $grupo = htmlspecialchars($fila["descripcion_grupo"]);
                        echo "<option value='$grupo'>$grupo</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                Inscribir alumno
            </button>

            <a href="../index.php" class="btn btn-secondary">
                Regresar
            </a>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
