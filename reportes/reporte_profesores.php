<?php
// Si el usuario dio clic en exportar, configuramos las cabeceras para Excel
if (isset($_GET['exportar']) && $_GET['exportar'] == 'excel') {
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporte_profesores_" . date('Y-m-d') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
}

include("../conexion.php");

$sql = "SELECT nocontrol_prof, nombre_prof, apaterno_prof,
               amaterno_prof, dom_prof, mail_prof, tel_prof
        FROM profesores";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error al consultar los profesores: " . $conexion->error);
}

$profesores = $resultado->fetch_all(MYSQLI_ASSOC);

// Si NO se está exportando, cargamos la interfaz visual con su menú
if (!isset($_GET['exportar'])) {
    include("../navegacion/header.php");
    include("../navegacion/navegacion.php");
}
?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Reporte de Profesores
    </h2>

    <p class="text-center">
        Lista de profesores registrados en el Sistema Escolar.
    </p>

    <!-- Botones de acción (se ocultan al exportar) -->
    <?php if (!isset($_GET['exportar'])) { ?>
        <div class="mb-3">
            <a href="reporte_profesores.php?exportar=excel" class="btn btn-success">
                📊 Exportar a Excel
            </a>

            <a href="index.php" class="btn btn-secondary">
                Regresar
            </a>
        </div>

        <div class="mb-3">
            <strong>Total de profesores:</strong>
            <?php echo count($profesores); ?>
        </div>
    <?php } ?>

    <div class="table-responsive">

        <!-- Agregamos border="1" para que Excel reconozca el mallado de celdas -->
        <table class="table table-sm table-bordered table-hover" border="1">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Número de control</th>
                    <th>Nombre</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Domicilio</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($profesores as $indice => $profesor) { ?>

                    <tr>
                        <td><?php echo $indice + 1; ?></td>
                        <td><?php echo htmlspecialchars($profesor["nocontrol_prof"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($profesor["nombre_prof"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($profesor["apaterno_prof"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($profesor["amaterno_prof"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($profesor["dom_prof"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($profesor["mail_prof"] ?? ""); ?></td>
                        <td><?php echo htmlspecialchars($profesor["tel_prof"] ?? ""); ?></td>
                    </tr>

                <?php } ?>

                <?php if (count($profesores) == 0) { ?>

                    <tr>
                        <td colspan="8" class="text-center">
                            No hay profesores registrados.
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<style>
@media print {
    nav, button, .btn {
        display: none !important;
    }

    body {
        background: white !important;
    }
}
</style>

<?php 
// Si no se está exportando, cargamos el footer normal
if (!isset($_GET['exportar'])) {
    include("../navegacion/footer.php");
}
?>