<?php
session_start();

if (!isset($_SESSION['puesto']) || ($_SESSION['puesto'] != 1 && $_SESSION['puesto'] != 2)) {
    header("Location: ../index.php");
    exit();
}

$es_excel = (isset($_GET['exportar']) && $_GET['exportar'] == 'excel');

if ($es_excel) {
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporte_calificaciones_" . date('Y-m-d') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo "\xEF\xBB\xBF";
}

include("../conexion.php");

$sql = "SELECT 
            capcal.id_capcal,
            capcal.id_alumno,
            alumnos.nombre_al,
            alumnos.apaterno_al,
            alumnos.amaterno_al,
            capcal.cal,
            unidad.descripcion
        FROM capcal
        INNER JOIN alumnos
            ON capcal.id_alumno = alumnos.matricula_al
        INNER JOIN unidad
            ON capcal.id_unidad = unidad.id_unidad
        ORDER BY alumnos.apaterno_al ASC";

$resultado = $conexion->query($sql);

$registros = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $registros[] = $fila;
    }
}

$nombre_usuario = $_SESSION['usuario'] ?? 'Israel';
?>

<?php if ($es_excel) { ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Matrícula</th>
                <th>Nombre del alumno</th>
                <th>Unidad</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($registros) > 0) { ?>
                <?php foreach ($registros as $fila) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila["id_capcal"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($fila["id_alumno"] ?? ""); ?></td>
                        <td>
                            <?php
                            echo htmlspecialchars(
                                trim(
                                    ($fila["nombre_al"] ?? "") . " " .
                                    ($fila["apaterno_al"] ?? "") . " " .
                                    ($fila["amaterno_al"] ?? "")
                                )
                            );
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($fila["descripcion"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($fila["cal"] ?? ""); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5">No hay calificaciones registradas.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Calificaciones - Sistema Escolar ITGAM II</title>
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
            padding: 30px 35px;
        }

        .table-institucional thead th {
            background-color: #1c1e21;
            color: #ffffff;
            font-weight: 600;
            border-color: #1c1e21;
            padding: 12px 14px;
            white-space: nowrap;
        }

        .table-institucional tbody td {
            vertical-align: middle;
            padding: 10px 14px;
        }

        .btn-institucional {
            background-color: #1c1e21;
            color: #ffffff;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s ease;
        }

        .btn-institucional:hover {
            background-color: #343a40;
            color: #ffffff;
        }

        @media print {
            .no-imprimir,
            .top-header {
                display: none !important;
            }

            body {
                background-color: #ffffff;
            }

            .contenido-area {
                padding: 0;
            }

            .reporte-card {
                border: none;
                box-shadow: none;
                padding: 0;
            }
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
            <div class="container-fluid">
                <div class="reporte-card">

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 pb-3 mb-4 border-bottom">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">
                                <i class="bi bi-award-fill me-2"></i>Reporte de Calificaciones
                            </h4>
                            <p class="text-muted small mb-0">
                                Calificaciones registradas por alumno y unidad en el Sistema Escolar.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2 no-imprimir">
                            <a href="reporte_calificaciones.php?exportar=excel" class="btn-institucional">
                                <i class="bi bi-file-earmark-spreadsheet"></i> Exportar a Excel
                            </a>
                            <button type="button" onclick="window.print()" class="btn btn-outline-dark px-3">
                                <i class="bi bi-printer"></i> Imprimir
                            </button>
                            <a href="index.php" class="btn btn-outline-secondary px-3">
                                <i class="bi bi-arrow-left"></i> Regresar
                            </a>
                        </div>
                    </div>

                    <div class="mb-3 text-muted small">
                        <strong class="text-dark">Total de registros:</strong> <?php echo count($registros); ?>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-institucional mb-0" border="1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Matrícula</th>
                                    <th>Nombre del alumno</th>
                                    <th>Unidad</th>
                                    <th>Calificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($registros) > 0) { ?>
                                    <?php foreach ($registros as $fila) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($fila["id_capcal"] ?? ""); ?></td>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($fila["id_alumno"] ?? ""); ?></td>
                                            <td>
                                                <?php
                                                echo htmlspecialchars(
                                                    trim(
                                                        ($fila["nombre_al"] ?? "") . " " .
                                                        ($fila["apaterno_al"] ?? "") . " " .
                                                        ($fila["amaterno_al"] ?? "")
                                                    )
                                                );
                                                ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($fila["descripcion"] ?? ""); ?></td>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($fila["cal"] ?? ""); ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No hay calificaciones registradas.
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php } ?>

<?php
if (isset($conexion) && $conexion) {
    $conexion->close();
}
?>