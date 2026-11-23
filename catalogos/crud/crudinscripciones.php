<?php
session_start();
// Validamos control de acceso (Solo Administrador)
if (!isset($_SESSION['puesto']) || $_SESSION['puesto'] != 1) {
    header("Location: ../../index.php");
    exit();
}

include("../../conexion.php");

$consulta = "SELECT id_in, id_grupo, id_alumno, status_ins
             FROM insgrup
             ORDER BY id_in DESC";

$resultado = $conexion->query($consulta);

$inscripciones = [];
if ($resultado) {
    $inscripciones = $resultado->fetch_all(MYSQLI_ASSOC);
}
$total_inscripciones = count($inscripciones);
$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Inscripciones - Sistema Escolar ITGAM II</title>
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

        /* CABECERA DE SECCIÓN CON ICONO GRANDE */
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

        .btn-institucional {
            background-color: #1c1e21;
            color: #ffffff;
            border: none;
            padding: 11px 22px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-institucional:hover {
            background-color: #343a40;
            color: #ffffff;
        }

        /* TARJETA CONTENEDORA DE TABLA */
        .tabla-contenedor {
            background-color: #ffffff;
            border-radius: 14px;
            border: 1px solid #dee2e6;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 22px;
        }

        .table-wrapper-rounded {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead th {
            background-color: #1c1e21;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 14px 16px;
            border: none;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 14px 16px;
            font-size: 0.9rem;
            color: #212529;
            border-bottom: 1px solid #f1f3f5;
            white-space: nowrap;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* BARRA INFERIOR DE CONTEO */
        .table-footer-bar {
            background-color: #f4f5f7;
            border-radius: 10px;
            padding: 12px 18px;
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.88rem;
            color: #343a40;
        }

        .pagination-mock {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-btn-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e2e6ea;
            color: #6c757d;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .page-btn-active {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background-color: #1c1e21;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

    <!-- BARRA DE NAVEGACIÓN LATERAL (SIDEBAR) -->
    <?php include("../../navegacion/navegacion.php"); ?>

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

            <!-- TÍTULO CON ICONO GRANDE Y BOTÓN NUEVA INSCRIPCIÓN -->
            <div class="section-header">
                <div class="section-title-group">
                    <div class="icon-box-dark">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="titulo-texto">
                        <h3>Catálogo de Inscripciones a Grupos</h3>
                        <p>Consulta, registra y administra las inscripciones de alumnos a los grupos escolares.</p>
                    </div>
                </div>

                <a href="../../registro/inscripcion.php" class="btn-institucional">
                    <i class="bi bi-plus-lg"></i> Nueva Inscripción
                </a>
            </div>

            <!-- CONTENEDOR DE TABLA -->
            <div class="tabla-contenedor">
                <div class="table-responsive table-wrapper-rounded">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID Inscripción</th>
                                <th>Grupo</th>
                                <th>Matrícula del Alumno</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($total_inscripciones > 0) { ?>
                                <?php foreach ($inscripciones as $fila) { ?>
                                    <tr>
                                        <td class="fw-bold text-dark"><?php echo htmlspecialchars($fila["id_in"]); ?></td>
                                        <td class="fw-semibold"><?php echo htmlspecialchars($fila["id_grupo"]); ?></td>
                                        <td><?php echo htmlspecialchars($fila["id_alumno"]); ?></td>
                                        <td>
                                            <span class="badge bg-dark px-2.5 py-1.5" style="font-size: 0.85rem;">
                                                <?php echo htmlspecialchars($fila["status_ins"]); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        No hay inscripciones registradas en el sistema.
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- BARRA INFERIOR DE REGISTROS -->
                <div class="table-footer-bar">
                    <div class="footer-info">
                        <i class="bi bi-info-circle-fill fs-5 text-dark"></i>
                        <span>Mostrando <strong><?php echo $total_inscripciones; ?></strong> registros</span>
                    </div>
                    <div class="pagination-mock">
                        <span class="page-btn-circle"><i class="bi bi-chevron-left"></i></span>
                        <span class="page-btn-active">1</span>
                        <span class="page-btn-circle"><i class="bi bi-chevron-right"></i></span>
                    </div>
                </div>
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