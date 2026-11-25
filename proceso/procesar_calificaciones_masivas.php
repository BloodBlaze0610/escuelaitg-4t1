<?php
session_start();

if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../registro/calificaciones_masivas.php");
    exit();
}

$id_unidad = filter_input(INPUT_POST, "id_unidad", FILTER_VALIDATE_INT);
$alumnos = $_POST["id_alumno"] ?? [];
$calificaciones = $_POST["cal"] ?? [];

if (
    $id_unidad === false ||
    $id_unidad === null ||
    !is_array($alumnos) ||
    !is_array($calificaciones) ||
    count($alumnos) !== count($calificaciones)
) {
    exit("Error: verifica la unidad y los datos enviados.");
}

/* Comprobar que la unidad exista */
$stmtUnidad = $conexion->prepare(
    "SELECT id_unidad FROM unidad WHERE id_unidad = ?"
);
$stmtUnidad->bind_param("i", $id_unidad);
$stmtUnidad->execute();
$stmtUnidad->store_result();

if ($stmtUnidad->num_rows === 0) {
    $stmtUnidad->close();
    exit("Error: la unidad seleccionada no existe.");
}

$stmtUnidad->close();

/* Preparar las consultas */
$stmtAlumno = $conexion->prepare(
    "SELECT matricula_al FROM alumnos WHERE matricula_al = ?"
);

$stmtInsertar = $conexion->prepare(
    "INSERT INTO capcal (id_alumno, cal, id_unidad)
     VALUES (?, ?, ?)"
);

if (!$stmtAlumno || !$stmtInsertar) {
    exit("Error al preparar las consultas.");
}

$registradas = 0;
$conexion->begin_transaction();

try {
    foreach ($alumnos as $indice => $matricula) {

        $matricula = trim((string)$matricula);
        $cal = $calificaciones[$indice] ?? "";

        /* Los campos vacíos se omiten */
        if (trim((string)$cal) === "") {
            continue;
        }

        if (!is_numeric($cal) || $cal < 0 || $cal > 100) {
            throw new Exception("Hay una calificación fuera del rango de 0 a 100.");
        }

        $stmtAlumno->bind_param("s", $matricula);
        $stmtAlumno->execute();
        $stmtAlumno->store_result();

        if ($stmtAlumno->num_rows === 0) {
            throw new Exception("Se encontró una matrícula que no existe.");
        }

        $stmtAlumno->free_result();

        $cal_num = (float)$cal;

        $stmtInsertar->bind_param("sdi", $matricula, $cal_num, $id_unidad);

        if (!$stmtInsertar->execute()) {
            throw new Exception("No se pudo guardar una de las calificaciones.");
        }

        $registradas++;
    }

    if ($registradas === 0) {
        throw new Exception("No ingresaste ninguna calificación.");
    }

    $conexion->commit();

} catch (Exception $e) {

    $conexion->rollback();

    $stmtAlumno->close();
    $stmtInsertar->close();
    $conexion->close();

    exit("No se guardaron las calificaciones. " . htmlspecialchars($e->getMessage()));

}

$stmtAlumno->close();
$stmtInsertar->close();
$conexion->close();
$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones Guardadas - Sistema Escolar ITGAM II</title>
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
            padding: 50px 35px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mensaje-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 40px;
            text-align: center;
            max-width: 560px;
            width: 100%;
        }

        .btn-institucional {
            background-color: #1c1e21;
            color: #ffffff;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
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
            <div class="mensaje-card">
                <div class="mb-3 text-dark" style="font-size: 2.8rem;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2">Calificaciones Guardadas</h4>
                <p class="text-muted mb-4">
                    Se registraron correctamente <strong><?php echo (int)$registradas; ?></strong> calificación(es) en el sistema.
                </p>
                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <a href="../registro/calificaciones_masivas.php" class="btn-institucional">
                        <i class="bi bi-plus-lg"></i> Capturar más calificaciones
                    </a>
                    <a href="../catalogos/crud/crudcalificaciones.php" class="btn btn-outline-secondary px-4">
                        Consultar calificaciones
                    </a>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>