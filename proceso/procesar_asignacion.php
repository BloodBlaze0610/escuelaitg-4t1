<?php
session_start();

if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../registro/asignacion.php");
    exit();
}

$id_mat = trim($_POST["id_mat"] ?? "");
$id_alumno = trim($_POST["id_alumno"] ?? "");
$id_profesor = trim($_POST["id_profesor"] ?? "");

if ($id_mat == "" || $id_alumno == "" || $id_profesor == "") {
    die("Error: debes seleccionar una materia, un alumno y un profesor.");
}

$consulta = "INSERT INTO asigmat (id_mat, id_alumno, id_profesor)
             VALUES (?, ?, ?)";

$stmt = $conexion->prepare($consulta);
$stmt->bind_param("sss", $id_mat, $id_alumno, $id_profesor);

$registro_ok = $stmt->execute();
$error_stmt = $stmt->error;
$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';

$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación Registrada - Sistema Escolar ITGAM II</title>
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
            max-width: 540px;
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
                <?php if ($registro_ok) { ?>
                    <div class="mb-3 text-dark" style="font-size: 2.8rem;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Asignación Registrada</h4>
                    <p class="text-muted mb-4">¡La asignación de la materia se registró correctamente en el sistema!</p>
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="../registro/asignacion.php" class="btn-institucional">
                            <i class="bi bi-plus-lg"></i> Registrar otra asignación
                        </a>
                        <a href="../index.php" class="btn btn-outline-secondary px-4">
                            Regresar al inicio
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="mb-3 text-danger" style="font-size: 2.8rem;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h4 class="fw-bold text-danger mb-2">Error al Registrar</h4>
                    <p class="text-muted mb-4">Error al registrar la asignación: <?php echo htmlspecialchars($error_stmt); ?></p>
                    <a href="../registro/asignacion.php" class="btn-institucional">
                        <i class="bi bi-arrow-left"></i> Volver a intentar
                    </a>
                <?php } ?>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>