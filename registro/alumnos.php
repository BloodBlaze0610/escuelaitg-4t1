<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Alumnos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <!-- Título -->
    <div class="alert alert-warning text-center">
        <h2>Sistema Escolar</h2>
    </div>

    <h1 class="text-center mb-4">Registro de Alumnos</h1>


    <!-- Formulario -->

    <form action="insert/insert_alumno.php" method="POST">

        <!-- Matrícula -->
        <div class="mb-3">
            <label class="form-label">Matrícula</label>

            <input type="text"
                   name="matricula_al"
                   class="form-control"
                   placeholder="Ingresa la matrícula">
        </div>


        <!-- Nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre</label>

            <input type="text"
                   name="nombre"
                   class="form-control"
                   placeholder="Ingresa el nombre">
        </div>


        <!-- Apellido paterno -->
        <div class="mb-3">
            <label class="form-label">Apellido Paterno</label>

            <input type="text"
                   name="apaterno"
                   class="form-control"
                   placeholder="Ingresa el apellido paterno">
        </div>


        <!-- Apellido materno -->
        <div class="mb-3">
            <label class="form-label">Apellido Materno</label>

            <input type="text"
                   name="amaterno"
                   class="form-control"
                   placeholder="Ingresa el apellido materno">
        </div>


        <!-- Domicilio -->
        <div class="mb-3">
            <label class="form-label">Domicilio</label>

            <input type="text"
                   name="domicilio"
                   class="form-control"
                   placeholder="Ingresa el domicilio">
        </div>


        <!-- Teléfono -->
        <div class="mb-3">
            <label class="form-label">Teléfono</label>

            <input type="text"
                   name="telefono"
                   class="form-control"
                   placeholder="Ingresa el teléfono">
        </div>


        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Ingresa el email">
        </div>


        <!-- Botón -->
        <div class="text-center">

            <button type="submit" class="btn btn-primary">
                Guardar Alumno
            </button>

        </div>

    </form>

</div>


<!-- Bootstrap JavaScript -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>