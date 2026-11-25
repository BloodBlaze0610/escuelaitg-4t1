<?php
include("conexion.php");
$mensaje = "";
$tipo_alerta = "info";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $conexion->real_escape_string(trim($_POST['nombre'])) : "";
    $puesto = isset($_POST['puesto']) ? intval($_POST['puesto']) : 0; // 1: Admin, 2: Profesor, 3: Alumno
    $identificador = isset($_POST['identificador']) ? $conexion->real_escape_string(trim($_POST['identificador'])) : "";
    $password = isset($_POST['pw']) ? md5($_POST['pw']) : ""; // Encriptación en MD5 como pide el profe

    $sql = "INSERT INTO usuarios (nombreuser, identificador, pwuser, puesto, status_user) 
            VALUES ('$nombre', '$identificador', '$password', $puesto, 'ACTA')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "¡Usuario registrado exitosamente!";
        $tipo_alerta = "success";
    } else {
        $mensaje = "Error al registrar: " . $conexion->error;
        $tipo_alerta = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios - Sistema Escolar ITGAM II</title>
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
            padding: 24px 16px;
            margin: 0;
        }

        .registro-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }

        .registro-header {
            background: linear-gradient(135deg, #1c1e21 0%, #2c3034 100%);
            color: #ffffff;
            padding: 26px 30px;
            text-align: center;
            border-bottom: 1px solid #343a40;
        }

        .registro-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .registro-header p {
            color: #adb5bd;
            font-size: 0.82rem;
            margin: 0;
        }

        .registro-body {
            padding: 28px 32px 32px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.88rem;
            color: #1c1e21;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border-color: #ced4da;
            padding: 10px 14px;
        }

        .form-control:focus,
        .form-select:focus {
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
    <script>
        function cambiarEtiqueta() {
            let puesto = document.getElementById('puesto').value;
            let labelId = document.getElementById('label-identificador');
            if (puesto == "1") {
                labelId.innerText = "ID Único de Administrador";
            } else if (puesto == "2" || puesto == "3") {
                labelId.innerText = "Número de Control";
            } else {
                labelId.innerText = "Identificador / No. Control";
            }
        }
    </script>
</head>

<body>

    <div class="registro-card">
        <div class="registro-header">
            <div class="mb-2">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 46px; height: 46px; background: rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-person-plus-fill fs-5"></i>
                </span>
            </div>
            <h3>Sistema Escolar SAEIGH</h3>
            <p>Tecnológico Nacional de México – ITGAM II</p>
        </div>

        <div class="registro-body">
            <h5 class="fw-bold text-dark text-center mb-1">Registro de Nuevo Usuario</h5>
            <p class="text-muted text-center small mb-4">Crea una cuenta asignando rol e identificador institucional.</p>

            <?php if (!empty($mensaje)) { ?>
                <div class="alert alert-<?php echo $tipo_alerta; ?> py-2 px-3 text-center small mb-3">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nombre de Usuario</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Usuario (Puesto)</label>
                    <select name="puesto" id="puesto" class="form-select" onchange="cambiarEtiqueta()" required>
                        <option value="">Selecciona un rol...</option>
                        <option value="1">Administrador</option>
                        <option value="2">Profesor</option>
                        <option value="3">Alumno</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label id="label-identificador" class="form-label">Identificador / No. Control</label>
                    <input type="text" name="identificador" class="form-control" required placeholder="Ingresa ID o No. Control correspondiente">
                </div>

                <div class="mb-4">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="pw" class="form-control" required>
                </div>

                <button type="submit" class="btn-institucional">
                    <i class="bi bi-check-lg"></i> Registrar Usuario
                </button>
            </form>

            <div class="text-center mt-3 pt-2 border-top">
                <a href="login.php" class="text-dark fw-semibold small text-decoration-none">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Ir al Login
                </a>
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