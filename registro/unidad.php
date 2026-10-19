
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Unidades</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>

<?php include("../navegacion/navegacion.php"); ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Registro de Unidades</h2>

    <form action="../proceso/procesar_unidad.php" method="POST">

        <div class="mb-3">
            <label for="descripcion" class="form-label">
                Descripción de la unidad:
            </label>

            <input
                type="text"
                class="form-control"
                id="descripcion"
                name="descripcion"
                maxlength="50"
                required
            >
        </div>

        <button type="submit" class="btn btn-success">
            Registrar unidad
        </button>

        <a href="../index.php" class="btn btn-secondary">
            Regresar
        </a>

    </form>

</div>

</body>
</html>
