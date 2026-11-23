<?php
session_start();
include("conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $conexion->real_escape_string($_POST['usuario']);
    $identificador = $conexion->real_escape_string($_POST['identificador']);
    $password = md5($_POST['pw']);

    // Validamos nombre, identificador y contraseña encriptada
    $sql = "SELECT * FROM usuarios WHERE nombreuser = '$usuario' AND identificador = '$identificador' AND pwuser = '$password' AND status_user = 'ACTA'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
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
    <title>Login - Sistema Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 380px;">
        <h3 class="text-center text-secondary mb-3">Iniciar Sesión</h3>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger p-2 text-center small"><?php echo $error; ?></div>
        <?php } ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ID Admin / No. Control</label>
                <input type="text" name="identificador" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="pw" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</body>
</html>