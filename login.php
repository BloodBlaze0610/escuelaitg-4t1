<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include("conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = isset($_POST['usuario']) ? $conexion->real_escape_string(trim($_POST['usuario'])) : "";
    $identificador = isset($_POST['identificador']) ? $conexion->real_escape_string(trim($_POST['identificador'])) : "";
    $password = isset($_POST['pw']) ? md5($_POST['pw']) : "";

    // Validamos nombre, identificador y contraseña encriptada
    $sql = "SELECT * FROM usuarios WHERE nombreuser = '$usuario' AND identificador = '$identificador' AND pwuser = '$password' AND status_user = 'ACTA'";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $row['nombreuser'];
        $_SESSION['puesto'] = $row['puesto'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Datos incorrectos (Verifica usuario, ID/No. Control o contraseña).";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Escolar ITGAM II</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f5f7;
            font-family: system-ui, -apple-system, sans-serif;
            color: #1c1e21;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }

        .login-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(135deg, #1c1e21 0%, #2c3034 100%);
            color: #ffffff;
            padding: 28px 30px;
            text-align: center;
            border-bottom: 1px solid #343a40;
        }

        .login-header h3 {
            font-size: 1.35rem;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .login-header p {
            color: #adb5bd;
            font-size: 0.82rem;
            margin: 0;
        }

        .login-body {
            padding: 30px 32px 34px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.88rem;
            color: #1c1e21;
        }

        .input-group-text {
            background-color: #f4f5f7;
            border-color: #ced4da;
            color: #495057;
            border-radius: 8px 0 0 8px;
        }

        .form-control {
            border-color: #ced4da;
            border-radius: 0 8px 8px 0;
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
            padding: 11px 20px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
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

    <div class="login-card">
        <div class="login-header">
            <div class="mb-2">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px; background: rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-mortarboard-fill fs-4"></i>
                </span>
            </div>
            <h3>Sistema Escolar SAEIGH</h3>
            <p>Tecnológico Nacional de México – ITGAM II</p>
        </div>

        <div class="login-body">
            <h5 class="fw-bold text-dark text-center mb-1">Iniciar Sesión</h5>
            <p class="text-muted text-center small mb-4">Ingresa tus credenciales institucionales para continuar.</p>

            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger py-2 px-3 text-center small mb-3">
                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">ID Admin / No. Control</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                        <input type="text" name="identificador" class="form-control" placeholder="Ej. 241250351" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="pw" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-institucional">
                    <i class="bi bi-box-arrow-in-right"></i> Entrar
                </button>
            </form>
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