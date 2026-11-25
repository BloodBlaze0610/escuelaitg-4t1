<?php
session_start();

if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos - Sistema Escolar ITGAM II</title>
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
                        <i class="bi bi-person-plus-fill me-2"></i>Registro de Alumnos
                    </h4>
                    <p class="text-muted small mb-0">Completa los datos académicos y de contacto para dar de alta a un alumno.</p>
                </div>

                <form action="insert/insert_alumno.php" method="POST">

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Matrícula</label>
                            <input type="text"
                                   name="matricula_al"
                                   class="form-control"
                                   placeholder="Ingresa la matrícula"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text"
                                   name="nombre_al"
                                   class="form-control"
                                   placeholder="Ingresa el nombre"
                                   required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text"
                                   name="apaterno_al"
                                   class="form-control"
                                   placeholder="Ingresa el apellido paterno"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text"
                                   name="amaterno_al"
                                   class="form-control"
                                   placeholder="Ingresa el apellido materno"
                                   required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Domicilio</label>
                        <input type="text"
                               name="dom_al"
                               class="form-control"
                               placeholder="Ingresa el domicilio"
                               required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text"
                                   name="tel_al"
                                   class="form-control"
                                   placeholder="Ingresa el teléfono"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="mail_al"
                                   class="form-control"
                                   placeholder="Ingresa el email"
                                   required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 flex-wrap pt-2">
                        <a href="../catalogos/crud/crudalumnos.php" class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                        <button type="submit" class="btn-institucional">
                            <i class="bi bi-check-lg"></i> Registrar Alumno
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>