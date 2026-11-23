<?php
session_start();

if (!isset($_SESSION['puesto']) || $_SESSION['puesto'] != 1) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$matricula_al = isset($_POST["matricula_al"]) ? $conexion->real_escape_string($_POST["matricula_al"]) : "";

$nombre_anterior = isset($_POST["nombre_anterior"]) ? $conexion->real_escape_string($_POST["nombre_anterior"]) : "";
$apaterno_anterior = isset($_POST["apaterno_anterior"]) ? $conexion->real_escape_string($_POST["apaterno_anterior"]) : "";
$amaterno_anterior = isset($_POST["amaterno_anterior"]) ? $conexion->real_escape_string($_POST["amaterno_anterior"]) : "";
$dom_anterior = isset($_POST["dom_anterior"]) ? $conexion->real_escape_string($_POST["dom_anterior"]) : "";
$mail_anterior = isset($_POST["mail_anterior"]) ? $conexion->real_escape_string($_POST["mail_anterior"]) : "";
$tel_anterior = isset($_POST["tel_anterior"]) ? $conexion->real_escape_string($_POST["tel_anterior"]) : "";

$nombre_al = isset($_POST["nombre_al"]) ? $conexion->real_escape_string($_POST["nombre_al"]) : "";
$apaterno_al = isset($_POST["apaterno_al"]) ? $conexion->real_escape_string($_POST["apaterno_al"]) : "";
$amaterno_al = isset($_POST["amaterno_al"]) ? $conexion->real_escape_string($_POST["amaterno_al"]) : "";
$dom_al = isset($_POST["dom_al"]) ? $conexion->real_escape_string($_POST["dom_al"]) : "";
$mail_al = isset($_POST["mail_al"]) ? $conexion->real_escape_string($_POST["mail_al"]) : "";
$tel_al = isset($_POST["tel_al"]) ? $conexion->real_escape_string($_POST["tel_al"]) : "";

$sql = "UPDATE alumnos SET
        nombre_al = '$nombre_al',
        apaterno_al = '$apaterno_al',
        amaterno_al = '$amaterno_al',
        dom_al = '$dom_al',
        mail_al = '$mail_al',
        tel_al = '$tel_al'
        WHERE matricula_al = '$matricula_al'
        AND nombre_al = '$nombre_anterior'
        AND apaterno_al = '$apaterno_anterior'
        AND amaterno_al = '$amaterno_anterior'
        AND dom_al = '$dom_anterior'
        AND mail_al = '$mail_anterior'
        AND tel_al = '$tel_anterior'
        LIMIT 1";

$resultado = $conexion->query($sql);
$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Modificación - Sistema Escolar ITGAM II</title>
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
            max-width: 500px;
            width: 100%;
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
                <?php if ($resultado) { ?>
                    <div class="mb-3 text-dark" style="font-size: 2.8rem;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h4 class="text-dark fw-bold mb-2">Alumno Modificado</h4>
                    <p class="text-muted mb-4">Los datos del alumno se actualizaron correctamente en el sistema.</p>
                    <div class="spinner-border spinner-border-sm text-dark" role="status"></div>
                    <span class="text-muted small ms-2">Redirigiendo al catálogo...</span>
                    <script>
                        setTimeout(function() {
                            window.location.href = '../catalogos/crud/crudalumnos.php';
                        }, 1500);
                    </script>
                <?php } else { ?>
                    <div class="mb-3 text-danger" style="font-size: 2.8rem;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h4 class="text-danger fw-bold mb-2">Error al Modificar</h4>
                    <p class="text-muted mb-4">No se pudo completar la actualización: <?php echo htmlspecialchars($conexion->error); ?></p>
                    <a href="../catalogos/crud/crudalumnos.php" class="btn btn-dark px-4 fw-semibold">Regresar al Catálogo</a>
                <?php } ?>
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