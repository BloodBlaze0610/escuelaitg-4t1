<?php
// Si el usuario dio clic en exportar, generamos las cabeceras para Excel
if (isset($_GET['exportar']) && $_GET['exportar'] == 'excel') {
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporte_alumnos_" . date('Y-m-d') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
}

include("../conexion.php");

$sql = "SELECT matricula_al, nombre_al, apaterno_al, amaterno_al,
               dom_al, mail_al, tel_al
        FROM alumnos";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error al consultar los alumnos: " . $conexion->error);
}

$alumnos = $resultado->fetch_all(MYSQLI_ASSOC);

// Si NO se está exportando, cargamos la interfaz normal con su diseño y menú
if (!isset($_GET['exportar'])) {
    include("../navegacion/header.php");
    include("../navegacion/navegacion.php");
}
?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Reporte de Alumnos
    </h2>

    <p class="text-center">
        Lista de alumnos registrados en el Sistema Escolar.
    </p>

    <!-- Si no se está exportando, mostramos los botones de acción en la interfaz -->
    <?php if (!isset($_GET['exportar'])) { ?>
        <div class="mb-3">
            <!-- Botón que activa la descarga directa a Excel llamando a la misma página con parámetro -->
            <a href="reporte_alumnos.php?exportar=excel" class="btn btn-success">
                📊 Exportar a Excel
            </a>

            <a href="index.php" class="btn btn-secondary">
                Regresar
            </a>
        </div>

        <div class="mb-3">
            <strong>Total de alumnos:</strong>
            <?php echo count($alumnos); ?>
        </div>
    <?php } ?>

    <div class="table-responsive">

        <!-- Agregamos border="1" para que al abrirlo en Excel se respeten las celdas de la tabla -->
        <table class="table table-sm table-bordered table-hover" border="1">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Matrícula</th>
                    <th>Nombre</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Domicilio</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($alumnos as $indice => $alumno) { ?>
                    <tr>
                        <td><?php echo $indice + 1; ?></td>
                        <td><?php echo htmlspecialchars($alumno["matricula_al"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($alumno["nombre_al"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($alumno["apaterno_al"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($alumno["amaterno_al"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($alumno["dom_al"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($alumno["mail_al"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($alumno["tel_al"] ?? ""); ?></td>
                    </tr>
                <?php } ?>

                <?php if (count($alumnos) == 0) { ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            No hay alumnos registrados.
                        </td>
                    </tr>
                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<?php 
// Si no se está exportando, cargamos el footer normal
if (!isset($_GET['exportar'])) {
    include("../navegacion/footer.php");
}
?>