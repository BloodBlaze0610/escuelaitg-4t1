<?php

include("../conexion.php");

$sql = "SELECT descripcion_mat FROM materias";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error al consultar las materias: " . $conexion->error);
}

$materias = $resultado->fetch_all(MYSQLI_ASSOC);

include("../navegacion/header.php");
include("../navegacion/navegacion.php");

?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Reporte de Materias
    </h2>

    <p class="text-center">
        Lista de materias registradas en el Sistema Escolar.
    </p>

    <div class="mb-3">

        <button onclick="window.print()" class="btn btn-primary">
            Imprimir reporte
        </button>

        <a href="index.php" class="btn btn-secondary">
            Regresar
        </a>

    </div>

    <div class="mb-3">
        <strong>Total de materias:</strong>
        <?php echo count($materias); ?>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Descripción de la materia</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($materias as $indice => $materia) { ?>

                    <tr>
                        <td><?php echo $indice + 1; ?></td>
                        <td>
                            <?php
                            echo htmlspecialchars(
                                $materia["descripcion_mat"] ?? ""
                            );
                            ?>
                        </td>
                    </tr>

                <?php } ?>

                <?php if (count($materias) == 0) { ?>

                    <tr>
                        <td colspan="2" class="text-center">
                            No hay materias registradas.
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

include("../navegacion/footer.php");

?>
```
