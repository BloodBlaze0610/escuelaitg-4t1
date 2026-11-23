<?php
session_start();
// Validamos control de acceso (Solo Admin o Profesor)
if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$descripcion = isset($_POST["descripcion"]) ? $conexion->real_escape_string($_POST["descripcion"]) : "";

$sql = "DELETE FROM grupo WHERE descripcion_grupo = '$descripcion'";

$resultado = $conexion->query($sql);
$nombre_usuario = $_SESSION['usuario'] ?? 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Baja - Sistema Escolar ITGAM II</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f5f7;
            font-family: system-ui, -apple-system, sans-serif;
            color: #212529;
            margin: 0;
        }

        /* HEADER SUPERIOR INSTITUCIONAL */
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

        /* CONTENIDO PRINCIPAL */
        .contenido-area {
            padding: 50px 35px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mensaje-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- BARRA DE NAVEGACIÓN LATERAL (SIDEBAR) -->
    <?php include("../navegacion/navegacion.php"); ?>

    <!-- CONTENEDOR PRINCIPAL QUE RESPETA EL MARGEN DEL SIDEBAR -->
    <div class="main-content-wrapper">

        <!-- ENCABEZADO SUPERIOR -->
        <div class="top-header">
            <div>
                <h2>Sistema Escolar Institucional</h2>
                <p>Tecnológico Nacional de México – ITGAM II</p>
            </div>
            <div class="user-profile">
                <div class="user-avatar">👤</div>
                <div>
                    <div style="font-size: 0.8rem; color: #adb5bd;">Bienvenido(a)</div>
                    <div style="font-size: 0.9rem; font-weight: 600;"><?php echo htmlspecialchars($nombre_usuario); ?></div>
                </div>
            </div>
        </div>

        <!-- ÁREA DE CONTENIDO -->
        <div class="contenido-area">
            <div class="mensaje-card">
                <?php if ($resultado) { ?>
                    <div class="mb-3">
                        <span style="font-size: 3rem;">✅</span>
                    </div>
                    <h4 class="text-dark fw-bold mb-2">¡Operación Exitosa!</h4>
                    <p class="text-muted mb-4">El grupo ha sido dado de baja correctamente del sistema institucional.</p>
                    <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                    <span class="text-muted small ms-2">Redirigiendo...</span>
                    <script>
                        setTimeout(function() {
                            window.location.href = '../catalogos/crud/crudgrupos.php';
                        }, 1500);
                    </script>
                <?php } else { ?>
                    <div class="mb-3">
                        <span style="font-size: 3rem;">❌</span>
                    </div>
                    <h4 class="text-danger fw-bold mb-2">Error en el Proceso</h4>
                    <p class="text-muted mb-4">No se pudo completar la baja: <?php echo $conexion->error; ?></p>
                    <a href="../catalogos/crud/crudgrupos.php" class="btn btn-dark px-4 fw-semibold">Regresar al Catálogo</a>
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