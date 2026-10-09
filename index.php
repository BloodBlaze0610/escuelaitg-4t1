<?php

include("navegacion/header.php");
include("navegacion/navegacion.php");

?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Sistema Escolar
    </h2>

    <p class="text-center">
        Selecciona una opción del menú para comenzar.
    </p>

    <div class="row mt-5">

        <div class="col-md-3 mb-3">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">
                        Alumnos
                    </h5>

                    <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudalumnos.php"
                       class="btn btn-primary">
                        Ver catálogo
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

                    <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudgrupos.php"
                       class="btn btn-primary">
                        Ver catálogo
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

                    <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudmaterias.php"
                       class="btn btn-primary">
                        Ver catálogo
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

                    <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudprofesores.php"
                       class="btn btn-primary">
                        Ver catálogo
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php

include("navegacion/footer.php");

?>