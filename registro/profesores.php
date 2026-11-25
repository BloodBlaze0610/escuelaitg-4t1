<?php
session_start();
// Validamos que solo entren usuarios autorizados (Admin)
if (!isset($_SESSION['puesto']) || $_SESSION['puesto'] != 1) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$mensaje = "";
$tipo_alerta = "info";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nocontrol = isset($_POST['nocontrol_prof']) ? $conexion->real_escape_string(trim($_POST['nocontrol_prof'])) : "";
    $nombre    = isset($_POST['nombre_prof']) ? $conexion->real_escape_string(trim($_POST['nombre_prof'])) : "";
    $apaterno  = isset($_POST['apaterno_prof']) ? $conexion->real_escape_string(trim($_POST['apaterno_prof'])) : "";
    $amaterno  = isset($_POST['amaterno_prof']) ? $conexion->real_escape_string(trim($_POST['amaterno_prof'])) : "";
    $domicilio = isset($_POST['dom_prof']) ? $conexion->real_escape_string(trim($_POST['dom_prof'])) : "";
    $email     = isset($_POST['mail_prof']) ? $conexion->real_escape_string(trim($_POST['mail_prof'])) : "";
    $telefono  = isset($_POST['tel_prof']) ? $conexion->real_escape_string(trim($_POST['tel_prof'])) : "";

    // 1. Insertamos en la tabla profesores
    $sql_prof = "INSERT INTO profesores (nocontrol_prof, nombre_prof, apaterno_prof, amaterno_prof, dom_prof, mail_prof, tel_prof) 
                 VALUES ('$nocontrol', '$nombre', '$apaterno', '$amaterno', '$domicilio', '$email', '$telefono')";

    if ($conexion->query($sql_prof) === TRUE) {
        // 2. Creamos su usuario automático en la tabla usuarios con puesto 2 (Profesor)
        $password_default = md5('1234'); // Contraseña por defecto
        $sql_user = "INSERT INTO usuarios (nombreuser, identificador, pwuser, puesto, status_user) 
                     VALUES ('$nombre', '$nocontrol', '$password_default', 2, 'ACTA')
                     ON DUPLICATE KEY UPDATE identificador=VALUES(identificador)";
        $conexion->query($sql_user);

        $mensaje = "¡Profesor registrado correctamente y usuario de acceso creado!";
        $tipo_alerta = "success";
    } else {
        $mensaje = "Error al registrar profesor: " . $conexion->error;
        $tipo_alerta = "danger";
    }
}

$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Profesores - Sistema Escolar ITGAM II</title>
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
            max-width: 720px;
            width: 100%;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1c1e21;
        }

        .form-control {
            border-radius: 8px;
            border-color: #ced4da;
            padding: 10px 14px;
        }

        .form-control:focus {
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
            justify-content: center;
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
                        <i class="bi bi-person-badge-fill me-2"></i>Registro de Profesores
                    </h4>
                    <p class="text-muted small mb-0">Registra al docente y genera automáticamente su usuario de acceso con rol de profesor.</p>
                </div>

                <?php if (!empty($mensaje)) { ?>
                    <div class="alert alert-<?php echo $tipo_alerta; ?> text-center mb-4">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php } ?>

                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">No. de Control (Identificador de Profesor)</label>
                        <input type="text" name="nocontrol_prof" class="form-control" maxlength="15" required placeholder="Ej. 241250352">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre_prof" class="form-control" maxlength="15" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text" name="apaterno_prof" class="form-control" maxlength="15" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text" name="amaterno_prof" class="form-control" maxlength="15" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Domicilio</label>
                        <input type="text" name="dom_prof" class="form-control" maxlength="80" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="mail_prof" class="form-control" maxlength="50" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="tel_prof" class="form-control" maxlength="35" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 flex-wrap pt-2">
                        <a href="../catalogos/crud/crudprofesores.php" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left"></i> Regresar al Catálogo
                        </a>
                        <button type="submit" class="btn-institucional">
                            <i class="bi bi-check-lg"></i> Registrar Profesor
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