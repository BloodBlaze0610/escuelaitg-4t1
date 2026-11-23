<?php
session_start();
if (!isset($_SESSION['puesto']) || $_SESSION['puesto'] != 1) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$descripcion = isset($_GET["descripcion"]) ? $conexion->real_escape_string($_GET["descripcion"]) : "";

$resultado = $conexion->query(
    "SELECT descripcion_grupo 
     FROM grupo 
     WHERE descripcion_grupo = '$descripcion'"
);

if (!$resultado || $resultado->num_rows == 0) {
    die("Grupo no encontrado");
}

$grupo = $resultado->fetch_assoc();
$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Grupo - Sistema Escolar ITGAM II</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f5f7;
            font-family: system-ui, -apple-system, sans-serif;
            color: #1c1e21;
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
            padding: 35px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 auto 25px auto;
            max-width: 720px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-title-group {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .icon-box-dark {
            width: 64px;
            height: 64px;
            background-color: #1c1e21;
            color: #ffffff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .titulo-texto h3 {
            font-size: 1.65rem;
            font-weight: 700;
            color: #1c1e21;
            margin: 0;
            padding-bottom: 6px;
            border-bottom: 1px solid #dee2e6;
        }

        .titulo-texto p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 6px 0 0 0;
        }

        .form-card {
            background-color: #ffffff;
            border-radius: 14px;
            border: 1px solid #dee2e6;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 32px;
            max-width: 720px;
            margin: 0 auto;
        }

        .form-label {
            font-weight: 600;
            color: #1c1e21;
            font-size: 0.9rem;
        }

        .btn-institucional {
            background-color: #1c1e21;
            color: #ffffff;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-institucional:hover {
            background-color: #343a40;
            color: #ffffff;
        }
    </style>
</head>

<body>

    <!-- BARRA DE NAVEGACIÓN LATERAL (SIDEBAR) -->
    <?php include("../navegacion/navegacion.php"); ?>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="main-content-wrapper">

        <!-- ENCABEZADO SUPERIOR -->
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

        <!-- ÁREA DE CONTENIDO -->
        <div class="contenido-area">

            <div class="section-header">
                <div class="section-title-group">
                    <div class="icon-box-dark">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="titulo-texto">
                        <h3>Modificar Grupo</h3>
                        <p>Actualiza la descripción del grupo escolar seleccionado.</p>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <form action="procesar_modif_grupo.php" method="POST">
                    <input type="hidden"
                           name="descripcion_actual"
                           value="<?php echo htmlspecialchars($grupo["descripcion_grupo"] ?? ""); ?>">

                    <div class="mb-3">
                        <label class="form-label">Descripción del grupo</label>
                        <input type="text"
                               name="descripcion_nueva"
                               class="form-control"
                               value="<?php echo htmlspecialchars($grupo["descripcion_grupo"] ?? ""); ?>"
                               required>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="../catalogos/crud/crudgrupos.php"
                           class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="btn-institucional">
                            <i class="bi bi-check-lg"></i> Guardar Cambios
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