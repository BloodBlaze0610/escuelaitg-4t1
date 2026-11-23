<?php
session_start();
// Validamos control de acceso (Solo Administrador o Profesor)
if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$nocontrol = isset($_GET["nocontrol"]) ? $_GET["nocontrol"] : "";

$sql = "SELECT nocontrol_prof, nombre_prof, apaterno_prof, amaterno_prof
        FROM profesores
        WHERE nocontrol_prof = '$nocontrol'";

$resultado = $conexion->query($sql);

if (!$resultado || $resultado->num_rows == 0) {
    die("Profesor no encontrado");
}

$profesor = $resultado->fetch_assoc();
$nombre_usuario = $_SESSION['usuario'] ?? 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baja de Profesor - Sistema Escolar ITGAM II</title>
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
            padding: 35px;
        }

        .card-baja {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            max-width: 650px;
            margin: 0 auto;
            overflow: hidden;
        }

        .card-header-custom {
            background-color: #1c1e21;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-weight: 600;
        }

        .info-label {
            color: #6c757d;
            font-weight: 600;
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

            <div class="card card-baja">
                
                <div class="card-header-custom">
                    <h4 class="mb-0 fs-5">Confirmación de Baja de Profesor</h4>
                </div>

                <div class="card-body p-4 p-md-5">

                    <div class="alert alert-warning text-center mb-4 border-0 shadow-sm" role="alert" style="background-color: #fff3cd; color: #856404;">
                        <strong>¡Atención!</strong> ¿Estás seguro de que deseas dar de baja a este profesor del sistema institucional?
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 info-label">No. de Control:</div>
                        <div class="col-sm-8 text-dark fw-semibold"><?php echo htmlspecialchars($profesor["nocontrol_prof"]); ?></div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4 info-label">Nombre Completo:</div>
                        <div class="col-sm-8 text-dark">
                            <?php echo htmlspecialchars($profesor["nombre_prof"] . " " . $profesor["apaterno_prof"] . " " . $profesor["amaterno_prof"]); ?>
                        </div>
                    </div>

                    <form action="confirmar_baja_profesor.php" method="POST" class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
                        <input type="hidden" name="nocontrol_prof" value="<?php echo htmlspecialchars($profesor["nocontrol_prof"]); ?>">

                        <button type="submit" class="btn btn-danger px-4 fw-semibold">
                            Sí, dar de baja
                        </button>

                        <a href="../catalogos/crud/crudprofesores.php" class="btn btn-outline-secondary px-4 fw-semibold">
                            Cancelar
                        </a>
                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- SCRIPT DE BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>