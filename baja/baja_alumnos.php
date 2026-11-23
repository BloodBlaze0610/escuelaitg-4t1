<?php
session_start();
// Validamos control de acceso (Solo Admin o Profesor pueden realizar bajas)
if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$fila = isset($_GET["fila"]) ? intval($_GET["fila"]) : 0;

$resultado = $conexion->query("SELECT matricula_al, nombre_al, apaterno_al, amaterno_al, dom_al, mail_al, tel_al 
FROM alumnos 
LIMIT 1 OFFSET $fila");

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$alumno = $resultado->fetch_assoc();

if (!$alumno) {
    die("No se encontró el alumno.");
}

$nombre_usuario = $_SESSION['usuario'] ?? 'Usuario';
$rol = $_SESSION['puesto'] ?? 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baja de Alumno - Sistema Escolar ITGAM II</title>
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

        .btn-institucional-dark {
            background-color: #1c1e21;
            color: #ffffff;
            border: none;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-institucional-dark:hover {
            background-color: #343a40;
            color: #fff;
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
                    <h4 class="mb-0 fs-5">Confirmación de Baja de Alumno</h4>
                </div>

                <div class="card-body p-4 p-md-5">

                    <div class="alert alert-warning text-center mb-4 border-0 shadow-sm" role="alert" style="background-color: #fff3cd; color: #856404;">
                        <strong>¡Atención!</strong> ¿Estás seguro de dar de baja permanentemente a este alumno del sistema institucional?
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 info-label">Matrícula:</div>
                        <div class="col-sm-8 text-dark fw-semibold"><?php echo htmlspecialchars($alumno["matricula_al"]); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 info-label">Nombre Completo:</div>
                        <div class="col-sm-8 text-dark"><?php echo htmlspecialchars($alumno["nombre_al"] . " " . $alumno["apaterno_al"] . " " . $alumno["amaterno_al"]); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 info-label">Domicilio:</div>
                        <div class="col-sm-8 text-dark"><?php echo htmlspecialchars($alumno["dom_al"]); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 info-label">Correo Electrónico:</div>
                        <div class="col-sm-8 text-dark"><?php echo htmlspecialchars($alumno["mail_al"]); ?></div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 info-label">Teléfono:</div>
                        <div class="col-sm-8 text-dark"><?php echo htmlspecialchars($alumno["tel_al"]); ?></div>
                    </div>

                    <form action="confirmar_baja.php" method="POST" class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
                        <input type="hidden" name="fila" value="<?php echo $fila; ?>">

                        <button type="submit" class="btn btn-danger px-4 fw-semibold">
                            Sí, Dar de Baja
                        </button>

                        <a href="../catalogos/crud/crudalumnos.php" class="btn btn-outline-secondary px-4 fw-semibold">
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