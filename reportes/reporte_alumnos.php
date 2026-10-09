<?php

include("../conexion.php");

$sql = "SELECT matricula_al, nombre_al, apaterno_al, amaterno_al,
               dom_al, mail_al, tel_al
        FROM alumnos";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error al consultar los alumnos: " . $conexion->error);
}

$alumnos = $resultado->fetch_all(MYSQLI_ASSOC);

include("../navegacion/header.php");
include("../navegacion/navegacion.php");

?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Reporte de Alumnos
    </h2>

    <p class="text-center">
        Lista de alumnos registrados en el Sistema Escolar.
    </p>

    <div class="mb-3">

        <button onclick="window.print()"
                class="btn btn-primary">
            Imprimir reporte
        </button>

        <a href="index.php"
           class="btn btn-secondary">
            Regresar
        </a>

    </div>

    <div class="mb-3">
        <strong>Total de alumnos:</strong>
        <?php echo count($alumnos); ?>
    </div>

    <div class="table-responsive">

        <table class="table table-sm table-bordered table-hover">

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

                        <td>
                            <?php echo $indice + 1; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["matricula_al"] ?? ""); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["nombre_al"] ?? ""); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["apaterno_al"] ?? ""); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["amaterno_al"] ?? ""); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["dom_al"] ?? ""); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["mail_al"] ?? ""); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($alumno["tel_al"] ?? ""); ?>
                        </td>

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
