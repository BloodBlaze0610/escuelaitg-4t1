<?php
session_start();
if (!isset($_SESSION['puesto']) || $_SESSION['puesto'] != 1) {
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

$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno - Sistema Escolar ITGAM II</title>
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
            margin-bottom: 25px;
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
            max-width: 780px;
            margin: 0 auto;
        }

        .form-label {
            font-weight: 600;
            color: #1c1e21;
            font-size: 0.9rem;
        }

        .form-control:read-only {
            background-color: #f4f5f7;
            color: #6c757d;
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

            <div class="section-header" style="max-width: 780px; margin: 0 auto 25px auto;">
                <div class="section-title-group">
                    <div class="icon-box-dark">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="titulo-texto">
                        <h3>Modificar Alumno</h3>
                        <p>Actualiza los datos personales y de contacto del alumno seleccionado.</p>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <form action="guardar_modificacion.php" method="POST">
                    <input type="hidden" name="nombre_anterior" value="<?php echo htmlspecialchars($alumno["nombre_al"] ?? ""); ?>">
                    <input type="hidden" name="apaterno_anterior" value="<?php echo htmlspecialchars($alumno["apaterno_al"] ?? ""); ?>">
                    <input type="hidden" name="amaterno_anterior" value="<?php echo htmlspecialchars($alumno["amaterno_al"] ?? ""); ?>">
                    <input type="hidden" name="dom_anterior" value="<?php echo htmlspecialchars($alumno["dom_al"] ?? ""); ?>">
                    <input type="hidden" name="mail_anterior" value="<?php echo htmlspecialchars($alumno["mail_al"] ?? ""); ?>">
                    <input type="hidden" name="tel_anterior" value="<?php echo htmlspecialchars($alumno["tel_al"] ?? ""); ?>">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Matrícula</label>
                            <input type="text"
                                   name="matricula_al"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($alumno["matricula_al"] ?? ""); ?>"
                                   readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text"
                                   name="nombre_al"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($alumno["nombre_al"] ?? ""); ?>"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text"
                                   name="apaterno_al"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($alumno["apaterno_al"] ?? ""); ?>"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text"
                                   name="amaterno_al"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($alumno["amaterno_al"] ?? ""); ?>"
                                   required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Domicilio</label>
                            <input type="text"
                                   name="dom_al"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($alumno["dom_al"] ?? ""); ?>"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text"
                                   name="tel_al"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($alumno["tel_al"] ?? ""); ?>"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="mail_al"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($alumno["mail_al"] ?? ""); ?>"
                                   required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="../catalogos/crud/crudalumnos.php" class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                        <button type="submit" class="btn-institucional">
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