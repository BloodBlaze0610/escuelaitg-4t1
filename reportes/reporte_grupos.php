<?php

include("../conexion.php");

$sql = "SELECT descripcion_grupo FROM grupo";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error al consultar los grupos: " . $conexion->error);
}

$grupos = $resultado->fetch_all(MYSQLI_ASSOC);

include("../navegacion/header.php");
include("../navegacion/navegacion.php");

?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Reporte de Grupos
    </h2>

    <p class="text-center">
        Lista de grupos registrados en el Sistema Escolar.
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
        <strong>Total de grupos:</strong>
        <?php echo count($grupos); ?>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

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

include("../navegacion/footer.php");

?>
```
