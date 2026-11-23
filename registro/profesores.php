<?php
session_start();
// Validamos que solo entren usuarios autorizados (Admin)
if (!isset($_SESSION['puesto']) || $_SESSION['puesto'] != 1) {
    header("Location: ../index.php");
    exit();
}

include("../conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nocontrol = $conexion->real_escape_string($_POST['nocontrol_prof']);
    $nombre    = $conexion->real_escape_string($_POST['nombre_prof']);
    $apaterno  = $conexion->real_escape_string($_POST['apaterno_prof']);
    $amaterno  = $conexion->real_escape_string($_POST['amaterno_prof']);
    $domicilio = $conexion->real_escape_string($_POST['dom_prof']);
    $email     = $conexion->real_escape_string($_POST['mail_prof']);
    $telefono  = $conexion->real_escape_string($_POST['tel_prof']);

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
    } else {
        $mensaje = "Error al registrar profesor: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Profesores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f6f8;
        }
        .encabezado {
            background-color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .contenido {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .formulario-contenedor {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>

    <!-- ENCABEZADO -->
    <div class="encabezado">
        <h4 class="text-secondary mb-0">
            Sistema Escolar
        </h4>
    </div>

    <!-- BARRA DE NAVEGACIÓN -->
    <?php include("../navegacion/navegacion.php"); ?>

    <!-- CONTENIDO -->
    <div class="container contenido" style="max-width: 700px;">

        <div class="formulario-contenedor">
            <h3 class="text-center mb-4 text-secondary">
                Registro de Profesores
            </h3>

            <?php if (!empty($mensaje)) { ?>
                <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
            <?php } ?>

            <form action="" method="POST">

                <div class="mb-3">
                    <label class="form-label">No. de Control (Identificador de Profesor)</label>
                    <input type="text" name="nocontrol_prof" class="form-control" maxlength="15" required placeholder="Ej. 241250352">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre_prof" class="form-control" maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" name="apaterno_prof" class="form-control" maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellido Materno</label>
                    <input type="text" name="amaterno_prof" class="form-control" maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Domicilio</label>
                    <input type="text" name="dom_prof" class="form-control" maxlength="80" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="mail_prof" class="form-control" maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="tel_prof" class="form-control" maxlength="35" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success w-50">
                        Registrar Profesor
                    </button>
                    <a href="../catalogos/crud/crudprofesores.php" class="btn btn-secondary w-50 text-center pt-2">
                        Regresar al Catálogo
                    </a>
                </div>

            </form>
        </div>

    </div>

    <!-- SCRIPT DE BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>