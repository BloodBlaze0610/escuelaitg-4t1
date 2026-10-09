<?php

include("../navegacion/header.php");
include("../navegacion/navegacion.php");

?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Procesos
    </h2>

    <p class="text-center">
        Selecciona el proceso que deseas realizar.
    </p>

    <div class="row mt-5">

        <div class="col-md-3 mb-3">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">
                        Alumnos
                    </h5>

                    <a href="../registro/alumnos.php"
                       class="btn btn-success">
                        Registrar
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-3 mb-3">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">
                        Grupos
                    </h5>

                    <a href="../registro/grupos.php"
                       class="btn btn-success">
                        Registrar
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-3 mb-3">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">
                        Materias
                    </h5>

                    <a href="../registro/materias.php"
                       class="btn btn-success">
                        Registrar
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-3 mb-3">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">
                        Profesores
                    </h5>

                    <a href="../registro/profesores.php"
                       class="btn btn-success">
                        Registrar
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php

include("../navegacion/footer.php");

?>