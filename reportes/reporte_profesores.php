```php
<?php

include("../conexion.php");

$sql = "SELECT nocontrol_prof, nombre_prof, apaterno_prof,
               amaterno_prof, dom_prof, mail_prof, tel_prof
        FROM profesores";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error al consultar los profesores: " . $conexion->error);
}

$profesores = $resultado->fetch_all(MYSQLI_ASSOC);

include("../navegacion/header.php");
include("../navegacion/navegacion.php");

?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Reporte de Profesores
    </h2>

    <p class="text-center">
        Lista de profesores registrados en el Sistema Escolar.
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
        <strong>Total de profesores:</strong>
        <?php echo count($profesores); ?>
    </div>

    <div class="table-responsive">

        <table class="table table-sm table-bordered table-hover">

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

include("../navegacion/footer.php");

?>
```
