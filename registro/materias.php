<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Materias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="alert alert-warning text-center">
        <h2>Sistema Escolar</h2>
    </div>

    <h1 class="text-center mb-4">Registro de Materias</h1>

    <form action="insert/insert_materia.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Descripción de la Materia</label>

            <input type="text"
                   name="descripcion_mat"
                   class="form-control"
                   placeholder="Ingresa la materia"
                   maxlength="25"
                   required>
        </div>

        <div class="text-center">

            <button type="submit" class="btn btn-primary">
                Guardar Materia
            </button>

        </div>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>