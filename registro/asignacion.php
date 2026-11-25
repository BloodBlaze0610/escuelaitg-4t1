<?php
session_start();

if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$consultaMaterias = "SELECT descripcion_mat FROM materias";
$resultadoMaterias = $conexion->query($consultaMaterias);

$consultaAlumnos = "SELECT matricula_al, nombre_al, apaterno_al, amaterno_al
                    FROM alumnos";
$resultadoAlumnos = $conexion->query($consultaAlumnos);

$consultaProfesores = "SELECT nocontrol_prof, nombre_prof FROM profesores";
$resultadoProfesores = $conexion->query($consultaProfesores);

$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Materias - Sistema Escolar ITGAM II</title>
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
            max-width: 680px;
            width: 100%;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1c1e21;
        }

        .form-select {
            border-radius: 8px;
            border-color: #ced4da;
            padding: 10px 14px;
        }

        .form-select:focus {
            border-color: #1c1e21;
            box-shadow: 0 0 0 0.2rem rgba(28, 30, 33, 0.12);
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
                        <i class="bi bi-journal-plus me-2"></i>Asignación de Materias
                    </h4>
                    <p class="text-muted small mb-0">Selecciona la materia, el alumno y el profesor correspondiente para registrar la asignación.</p>
                </div>

                <form action="../proceso/procesar_asignacion.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Materia</label>
                        <select name="id_mat" class="form-select" required>
                            <option value="">Selecciona una materia</option>
                            <?php if ($resultadoMaterias) {
                                while ($fila = $resultadoMaterias->fetch_assoc()) {
                                    $materia = htmlspecialchars($fila["descripcion_mat"]);
                                    echo "<option value='$materia'>$materia</option>";
                                }
                            } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alumno</label>
                        <select name="id_alumno" class="form-select" required>
                            <option value="">Selecciona un alumno</option>
                            <?php if ($resultadoAlumnos) {
                                while ($fila = $resultadoAlumnos->fetch_assoc()) {
                                    $matricula = htmlspecialchars($fila["matricula_al"]);
                                    $nombre = htmlspecialchars(
                                        $fila["nombre_al"] . " " .
                                        $fila["apaterno_al"] . " " .
                                        $fila["amaterno_al"]
                                    );
                                    echo "<option value='$matricula'>$matricula - $nombre</option>";
                                }
                            } ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Profesor</label>
                        <select name="id_profesor" class="form-select" required>
                            <option value="">Selecciona un profesor</option>
                            <?php if ($resultadoProfesores) {
                                while ($fila = $resultadoProfesores->fetch_assoc()) {
                                    $control = htmlspecialchars($fila["nocontrol_prof"]);
                                    $nombre = htmlspecialchars($fila["nombre_prof"]);
                                    echo "<option value='$control'>$control - $nombre</option>";
                                }
                            } ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2 flex-wrap pt-2">
                        <a href="../index.php" class="btn btn-outline-secondary px-4">
                            Regresar
                        </a>
                        <button type="submit" class="btn-institucional">
                            <i class="bi bi-check-lg"></i> Asignar materia
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