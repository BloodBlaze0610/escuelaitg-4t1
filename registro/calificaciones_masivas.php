<?php
session_start();

if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$consultaAlumnos = "SELECT matricula_al, nombre_al, apaterno_al, amaterno_al
                    FROM alumnos
                    ORDER BY apaterno_al, nombre_al";

$resultadoAlumnos = $conexion->query($consultaAlumnos);

$consultaUnidades = "SELECT id_unidad, descripcion FROM unidad
                     ORDER BY id_unidad";

$resultadoUnidades = $conexion->query($consultaUnidades);

$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura Masiva de Calificaciones - Sistema Escolar ITGAM II</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f5f7;
            font-family: system-ui, -apple-system, sans-serif;
            color: #1c1e21;
            margin: 0;
        }

        .top-header {
            background: linear-gradient(135deg, #1c1e21 0%, #2c3034 100%);
            color: #ffffff;
            padding: 25px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #343a40;
        }

        .top-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .top-header p {
            color: #adb5bd;
            font-size: 0.85rem;
            margin: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.08);
            padding: 8px 16px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background-color: #495057;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #fff;
        }

        .contenido-area {
            padding: 40px 35px;
            display: flex;
            justify-content: center;
        }

        .form-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 35px 40px;
            max-width: 920px;
            width: 100%;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1c1e21;
        }

        .form-select,
        .form-control {
            border-radius: 8px;
            border-color: #ced4da;
            padding: 9px 14px;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #1c1e21;
            box-shadow: 0 0 0 0.2rem rgba(28, 30, 33, 0.12);
        }

        .table-institucional thead th {
            background-color: #1c1e21;
            color: #ffffff;
            font-weight: 600;
            border-color: #1c1e21;
            padding: 12px 14px;
        }

        .table-institucional tbody td {
            vertical-align: middle;
            padding: 10px 14px;
        }

        .btn-institucional {
            background-color: #1c1e21;
            color: #ffffff;
            border: none;
            padding: 11px 24px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s ease;
        }

        .btn-institucional:hover {
            background-color: #343a40;
            color: #ffffff;
        }
    </style>
</head>

<body>

    <?php include("../navegacion/navegacion.php"); ?>

    <div class="main-content-wrapper">

        <div class="top-header">
            <div>
                <h2>Sistema Escolar Institucional</h2>
                <p>Tecnológico Nacional de México – ITGAM II</p>
            </div>
            <div class="user-profile">
                <div class="user-avatar"><i class="bi bi-person-fill"></i></div>
                <div>
                    <div style="font-size: 0.8rem; color: #adb5bd;">Bienvenido(a)</div>
                    <div style="font-size: 0.9rem; font-weight: 600;"><?php echo htmlspecialchars($nombre_usuario); ?></div>
                </div>
            </div>
        </div>

        <div class="contenido-area">
            <div class="form-card">
                <div class="mb-4 pb-3 border-bottom">
                    <h4 class="fw-bold text-dark mb-1">
                        <i class="bi bi-ui-checks me-2"></i>Captura Masiva de Calificaciones
                    </h4>
                    <p class="text-muted small mb-0">
                        Selecciona la unidad y escribe la calificación de cada alumno (rango de 0 a 100). Los campos vacíos se omitirán automáticamente.
                    </p>
                </div>

                <form action="../proceso/procesar_calificaciones_masivas.php" method="POST">

                    <div class="mb-4">
                        <label class="form-label">Unidad</label>
                        <select name="id_unidad" class="form-select" required>
                            <option value="">Selecciona una unidad</option>
                            <?php if ($resultadoUnidades) {
                                while ($fila = $resultadoUnidades->fetch_assoc()) {
                                    $idUnidad = htmlspecialchars($fila["id_unidad"]);
                                    $descripcion = htmlspecialchars($fila["descripcion"]);
                                    echo "<option value='$idUnidad'>$descripcion</option>";
                                }
                            } ?>
                        </select>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-hover table-institucional mb-0">

                            <thead>
                                <tr>
                                    <th style="width: 22%;">Matrícula</th>
                                    <th style="width: 53%;">Nombre del alumno</th>
                                    <th style="width: 25%;">Calificación</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 0;

                                if ($resultadoAlumnos) {
                                    while ($fila = $resultadoAlumnos->fetch_assoc()) {
                                        $matricula = htmlspecialchars($fila["matricula_al"]);
                                        $nombre = htmlspecialchars(
                                            $fila["nombre_al"] . " " .
                                            $fila["apaterno_al"] . " " .
                                            $fila["amaterno_al"]
                                        );
                                ?>

                                    <tr>
                                        <td class="fw-semibold">
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
                                    }
                                } ?>

                                <?php if ($i == 0) { ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            No hay alumnos registrados.
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>

                    <div class="d-flex justify-content-end gap-2 flex-wrap pt-2">
                        <a href="../index.php" class="btn btn-outline-secondary px-4">
                            Regresar
                        </a>
                        <button type="submit" class="btn-institucional">
                            <i class="bi bi-check-lg"></i> Guardar Calificaciones
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
if (isset($conexion) && $conexion) {
    $conexion->close();
}
?>