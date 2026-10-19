
<style>
    .dropdown-menu .dropdown-item {
        padding: 9px 14px;
        margin: 2px 0;
        border-radius: 5px;
        transition: background-color 0.2s, color 0.2s;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #4285d4;
        color: white;
    }

    .dropdown-menu .dropdown-item:active {
        background-color: #3267a8;
        color: white;
    }

    .dropdown-divider {
        margin: 5px 8px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4285d4;">
    <div class="container-fluid">

        <a class="navbar-brand" href="/escuelaitg/escuelaitg-4t1/index.php">
            Sistema Escolar
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#menuPrincipal" aria-controls="menuPrincipal"
            aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">

            <ul class="navbar-nav ms-auto">

                <!-- CATALOGOS -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Catálogos
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudalumnos.php">Alumnos</a></li>
                        <li><a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudgrupos.php">Grupos</a></li>
                        <li><a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudmaterias.php">Materias</a></li>
                        <li><a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudprofesores.php">Profesores</a></li>
                        <li><a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudunidad.php">Unidades</a></li>
                    </ul>
                </li>

                <!-- PROCESOS -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Procesos
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/proceso/index.php">
                                Registro de datos
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/registro/inscripcion.php">
                                Inscripción a Grupos
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudinscripciones.php">
                                Consultar Inscripciones
                            </a>
                        </li>
                        
                        <li><hr class="dropdown-divider"></li>

                        <li>
                          <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/registro/asignacion.php">
                             Asignación de Materias
                         </a>
                        </li>

                        <li>
                           <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudasignaciones.php">
                              Consultar Asignaciones
                           </a>
                        </li>
                        
                        <li><hr class="dropdown-divider"></li>

                        <li>
                          <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/registro/calificaciones.php">
                             Captura de Calificaciones
                         </a>
                         <a class="dropdown-item"
                              href="/escuelaitg/escuelaitg-4t1/registro/calificaciones_masivas.php">
                             Captura Masiva de Calificaciones
                         </a>
                       </li>

                        <li>
                          <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudcalificaciones.php">
                             Consultar Calificaciones
                         </a>
                    </li>


                    </ul>
                </li>

                <!-- REPORTES -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Reportes
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/reportes/index.php">
                                Consultar reportes
                            </a>
                            
                            <a class="dropdown-item"
                               href="/escuelaitg/escuelaitg-4t1/reportes/reporte_calificaciones.php">
                               Reporte de Calificaciones
                            </a>

                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="/escuelaitg/escuelaitg-4t1/reportes/reporte_unidades.php">
                                Reporte de Unidades
                            </a>
                            
                            <a class="dropdown-item"
                              href="/escuelaitg/escuelaitg-4t1/reportes/reporte_calificaciones.php">
                              Reporte de Calificaciones
                            </a>

                        </li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>
