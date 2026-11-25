<?php
session_start();

if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $descripcion = trim($_POST["descripcion"] ?? "");

    if ($descripcion == "") {
        header("Location: ../registro/unidad.php?error=vacio");
        exit();
    }

    $consulta = "INSERT INTO unidad (descripcion) VALUES (?)";

    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("s", $descripcion);

    if ($stmt->execute()) {
        $stmt->close();
        $conexion->close();
        header("Location: ../catalogos/crud/crudunidad.php?registro=correcto");
        exit();
    }

    $error_stmt = $stmt->error;
    $stmt->close();
    $conexion->close();
    $nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error al Registrar Unidad - Sistema Escolar ITGAM II</title>
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
                    <div class="mb-3 text-danger" style="font-size: 2.8rem;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h4 class="fw-bold text-danger mb-2">Error al Registrar</h4>
                    <p class="text-muted mb-4">Error al registrar la unidad: <?php echo htmlspecialchars($error_stmt); ?></p>
                    <a href="../registro/unidad.php" class="btn-institucional">
                        <i class="bi bi-arrow-left"></i> Volver al Formulario
                    </a>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
    <?php
    exit();

} else {

    header("Location: ../registro/unidad.php");
    exit();

}
?>