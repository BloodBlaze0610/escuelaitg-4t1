<?php
// reportes/index.php
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
    <title>Menú de Reportes - Sistema Escolar ITGAM II</title>
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
        }

        .reporte-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 28px 24px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .reporte-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
        }

        .reporte-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background-color: #f4f5f7;
            color: #1c1e21;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 16px;
        }

        .btn-institucional {
            background-color: #1c1e21;
            color: #ffffff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
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
            <div class="container">

                <div class="mb-4 pb-3 border-bottom">
                    <h4 class="fw-bold text-dark mb-1">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>Reportes del Sistema
                    </h4>
                    <p class="text-muted small mb-0">
                        Selecciona el reporte que deseas consultar e imprimir:
                    </p>
                </div>

                <div class="row g-4 justify-content-center">

                    <!-- Reporte Alumnos -->
                    <div class="col-md-6 col-lg-4">
                        <div class="reporte-card">
                            <div>
                                <div class="reporte-icon"><i class="bi bi-people-fill"></i></div>
                                <h5 class="fw-bold text-dark mb-2">Reporte de Alumnos</h5>
                                <p class="text-muted small mb-4">
                                    Lista completa de alumnos registrados con sus datos generales.
                                </p>
                            </div>
                            <a href="reporte_alumnos.php" class="btn-institucional">
                                Entrar a Reporte de Alumnos <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Reporte Grupos -->
                    <div class="col-md-6 col-lg-4">
                        <div class="reporte-card">
                            <div>
                                <div class="reporte-icon"><i class="bi bi-collection-fill"></i></div>
                                <h5 class="fw-bold text-dark mb-2">Reporte de Grupos</h5>
                                <p class="text-muted small mb-4">
                                    Listado de los grupos activos dentro del sistema escolar.
                                </p>
                            </div>
                            <a href="reporte_grupos.php" class="btn-institucional">
                                Entrar a Reporte de Grupos <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Reporte Materias -->
                    <div class="col-md-6 col-lg-4">
                        <div class="reporte-card">
                            <div>
                                <div class="reporte-icon"><i class="bi bi-book-fill"></i></div>
                                <h5 class="fw-bold text-dark mb-2">Reporte de Materias</h5>
                                <p class="text-muted small mb-4">
                                    Catálogo y distribución de materias correspondientes.
                                </p>
                            </div>
                            <a href="reporte_materias.php" class="btn-institucional">
                                Entrar a Reporte de Materias <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Reporte Profesores -->
                    <div class="col-md-6 col-lg-4">
                        <div class="reporte-card">
                            <div>
                                <div class="reporte-icon"><i class="bi bi-person-badge-fill"></i></div>
                                <h5 class="fw-bold text-dark mb-2">Reporte de Profesores</h5>
                                <p class="text-muted small mb-4">
                                    Plantilla de profesores registrados en la institución.
                                </p>
                            </div>
                            <a href="reporte_profesores.php" class="btn-institucional">
                                Entrar a Reporte de Profesores <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Reporte Unidades -->
                    <div class="col-md-6 col-lg-4">
                        <div class="reporte-card">
                            <div>
                                <div class="reporte-icon"><i class="bi bi-layers-fill"></i></div>
                                <h5 class="fw-bold text-dark mb-2">Reporte de Unidades</h5>
                                <p class="text-muted small mb-4">
                                    Consulta las unidades registradas en el Sistema Escolar.
                                </p>
                            </div>
                            <a href="reporte_unidades.php" class="btn-institucional">
                                Entrar a Reporte de Unidades <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>