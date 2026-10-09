<?php

include("../navegacion/header.php");
include("../navegacion/navegacion.php");

?>

<div class="container mt-5">

    <h2 class="text-center text-secondary mb-4">
        Reportes
    </h2>

    <p class="text-center">
        Selecciona el reporte que deseas consultar.
    </p>

    <div class="row mt-5">

        <div class="col-md-3 mb-3">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">
                        Alumnos
                    </h5>

                    <a href="reporte_alumnos.php"
                       class="btn btn-primary">
                        Ver reporte
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

                    <a href="reporte_grupos.php"
                       class="btn btn-primary">
                        Ver reporte
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

                    <a href="reporte_materias.php"
                       class="btn btn-primary">
                        Ver reporte
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

                    <a href="reporte_profesores.php"
                       class="btn btn-primary">
                        Ver reporte
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php

include("../navegacion/footer.php");

?>