<?php
include("conexion.php");
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $puesto = intval($_POST['puesto']); // 1: Admin, 2: Profesor, 3: Alumno
    $identificador = $conexion->real_escape_string($_POST['identificador']); // ID de Admin o No. Control
    $password = md5($_POST['pw']); // Encriptación en MD5 como pide el profe

    $sql = "INSERT INTO usuarios (nombreuser, identificador, pwuser, puesto, status_user) 
            VALUES ('$nombre', '$identificador', '$password', $puesto, 'ACTA')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "¡Usuario registrado exitosamente!";
    } else {
        $mensaje = "Error al registrar: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow p-4">
            <h3 class="text-center text-secondary mb-3">Registro de Nuevo Usuario</h3>
            <?php if (!empty($mensaje)) { ?>
                <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
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
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="pw" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Registrar Usuario</button>
            </form>
            <div class="text-center mt-3">
                <a href="login.php" class="text-decoration-none">Ir al Login</a>
            </div>
        </div>
    </div>
</body>
</html>