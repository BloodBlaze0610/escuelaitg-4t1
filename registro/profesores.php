<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Profesores</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="alert alert-warning text-center">
        <h2>Sistema Escolar</h2>
    </div>

    <h1 class="text-center mb-4">Registro de Profesores</h1>

    <form action="../proceso/procesar_profesores.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Nombre</label>

            <input type="text"
                   name="nombre_prof"
                   class="form-control"
                   placeholder="Ingresa el nombre">
        </div>

        <div class="mb-3">
            <label class="form-label">Apellido Paterno</label>

            <input type="text"
                   name="apaterno_prof"
                   class="form-control"
                   placeholder="Ingresa el apellido paterno">
        </div>

        <div class="mb-3">
            <label class="form-label">Apellido Materno</label>

            <input type="text"
                   name="amaterno_prof"
                   class="form-control"
                   placeholder="Ingresa el apellido materno">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   name="email_prof"
                   class="form-control"
                   placeholder="Ingresa el email">
        </div>

        <div class="mb-3">
            <label class="form-label">Domicilio</label>

            <input type="text"
                   name="domicilio_prof"
                   class="form-control"
                   placeholder="Ingresa el domicilio">
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>

            <input type="text"
                   name="tel_prof"
                   class="form-control"
                   placeholder="Ingresa el teléfono">
        </div>

        <div class="text-center">

            <button type="submit" class="btn btn-primary">
                Guardar Profesor
            </button>

        </div>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>