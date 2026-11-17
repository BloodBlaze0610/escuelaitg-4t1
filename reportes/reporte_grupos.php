<?php
// Si el usuario dio clic en exportar, configuramos las cabeceras para Excel
if (isset($_GET['exportar']) && $_GET['exportar'] == 'excel') {
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporte_grupos_" . date('Y-m-d') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
}

include("../conexion.php");

$sql = "SELECT descripcion_grupo FROM grupo";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error al consultar los grupos: " . $conexion->error);
}

$grupos = $resultado->fetch_all(MYSQLI_ASSOC);

// Si NO se está exportando, cargamos la interfaz visual con su menú
if (!isset($_GET['exportar'])) {
    include("../navegacion/header.php");
    include("../navegacion/navegacion.php");
}
?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Reporte de Grupos
    </h2>

    <p class="text-center">
        Lista de grupos registrados en el Sistema Escolar.
    </p>

    <!-- Botones de acción (seocultan al exportar) -->
    <?php if (!isset($_GET['exportar'])) { ?>
        <div class="mb-3">
            <a href="reporte_grupos.php?exportar=excel" class="btn btn-success">
                📊 Exportar a Excel
            </a>

            <a href="index.php" class="btn btn-secondary">
                Regresar
            </a>
        </div>

        <div class="mb-3">
            <strong>Total de grupos:</strong>
            <?php echo count($grupos); ?>
        </div>
    <?php } ?>

    <div class="table-responsive">

        <!-- Agregamos border="1" para que Excel respete las celdas -->
        <table class="table table-bordered table-hover" border="1">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Descripción del grupo</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($grupos as $indice => $grupo) { ?>

                    <tr>
                        <td><?php echo $indice + 1; ?></td>
                        <td>
                            <?php
                            echo htmlspecialchars(
                                $grupo["descripcion_grupo"] ?? ""
                            );
                            ?>
                        </td>
                    </tr>

                <?php } ?>

                <?php if (count($grupos) == 0) { ?>

                    <tr>
                        <td colspan="2" class="text-center">
                            No hay grupos registrados.
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
