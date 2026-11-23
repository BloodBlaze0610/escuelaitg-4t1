<?php
// Validamos la sesión si no está iniciada previamente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$rol = $_SESSION['puesto'] ?? 0;
$nombre_usuario = $_SESSION['usuario'] ?? 'Usuario';
$pagina_actual = basename($_SERVER['PHP_SELF']);
$ruta_actual = $_SERVER['PHP_SELF'] ?? '';

$etiqueta_rol = match ((int)$rol) {
    1 => 'Administrador',
    2 => 'Profesor',
    3 => 'Alumno',
    default => 'Invitado',
};
?>

<!-- ESTILOS DEL SIDEBAR INSTITUCIONAL -->
<style>
    .sidebar-institucional {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 260px;
        background-color: #161a1d;
        color: #adb5bd;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        z-index: 1000;
        box-shadow: 4px 0 18px rgba(0, 0, 0, 0.14);
        border-right: 1px solid #282d32;
        font-family: system-ui, -apple-system, sans-serif;
    }

    .sidebar-brand {
        padding: 20px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #282d32;
        background-color: #111416;
        text-decoration: none;
    }

    .sidebar-brand img {
        width: 42px;
        height: 42px;
        object-fit: contain;
        border-radius: 6px;
        background-color: #ffffff;
        padding: 2px;
        flex-shrink: 0;
    }

    .brand-text h5 {
        color: #ffffff;
        font-size: 0.98rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .brand-text small {
        color: #adb5bd;
        font-size: 0.75rem;
        display: block;
    }

    .sidebar-session-badge {
        margin: 14px 14px 4px 14px;
        padding: 10px 12px;
        border-radius: 8px;
        background-color: #1c1e21;
        border: 1px solid #282d32;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .sidebar-session-name {
        color: #ffffff;
        font-size: 0.84rem;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar-session-role {
        font-size: 0.7rem;
        color: #adb5bd;
        background-color: #282d32;
        padding: 2px 8px;
        border-radius: 999px;
        flex-shrink: 0;
    }

    .sidebar-menu {
        padding: 12px 10px;
        overflow-y: auto;
        flex-grow: 1;
    }

    .sidebar-menu .nav-link {
        color: #adb5bd;
        padding: 9px 14px;
        border-radius: 7px;
        margin-bottom: 4px;
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .sidebar-menu .nav-link-left {
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-menu .nav-link:hover,
    .sidebar-menu .nav-link.active {
        background-color: #1c1e21;
        color: #ffffff;
        box-shadow: inset 3px 0 0 #ffffff;
    }

    .sidebar-menu .submenu {
        padding-left: 14px;
        list-style: none;
        margin-top: 4px;
        margin-bottom: 6px;
    }

    .sidebar-menu .submenu .nav-link {
        font-size: 0.85rem;
        padding: 7px 12px;
    }

    .sidebar-section-title {
        color: #6c757d;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 0 14px;
        margin-top: 16px;
        margin-bottom: 6px;
    }

    .sidebar-footer {
        padding: 14px 16px;
        border-top: 1px solid #282d32;
        background-color: #111416;
    }

    .sidebar-logout-btn {
        color: #f8d7da;
        background-color: rgba(220, 53, 69, 0.12);
        border: 1px solid rgba(220, 53, 69, 0.28);
        border-radius: 7px;
        padding: 9px 12px;
        font-size: 0.88rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .sidebar-logout-btn:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
    }

    /* Ajuste para el contenido principal cuando el sidebar está fijo */
    .main-content-wrapper {
        margin-left: 260px;
        background-color: #f4f5f7;
        min-height: 100vh;
    }

    @media (max-width: 992px) {
        .sidebar-institucional {
            width: 72px;
        }
        .sidebar-brand .brand-text,
        .sidebar-session-badge,
        .sidebar-section-title,
        .sidebar-menu .nav-label,
        .sidebar-logout-label,
        .menu-arrow {
            display: none;
        }
        .sidebar-menu .nav-link {
            justify-content: center;
            padding: 10px;
        }
        .sidebar-logout-btn {
            padding: 10px;
        }
        .main-content-wrapper {
            margin-left: 72px;
        }
    }
</style>

<aside class="sidebar-institucional" aria-label="Navegación principal del sistema">
    <div>
        <!-- LOGO / ESCUDO DESDE LA RAÍZ -->
        <a href="/escuelaitg/escuelaitg-4t1/index.php" class="sidebar-brand">
            <img src="/escuelaitg/escuelaitg-4t1/Emblema institucional ITGAM II.jpg" alt="Escudo ITGAM II">
            <div class="brand-text">
                <h5>SAEIGH • ITGAM II</h5>
                <small>Sistema Escolar</small>
            </div>
        </a>

        <!-- USUARIO Y ROL ACTIVO -->
        <div class="sidebar-session-badge">
            <span class="sidebar-session-name" title="<?php echo htmlspecialchars($nombre_usuario); ?>">
                <i class="bi bi-person-check-fill me-1 text-secondary"></i><?php echo htmlspecialchars($nombre_usuario); ?>
            </span>
            <span class="sidebar-session-role"><?php echo htmlspecialchars($etiqueta_rol); ?></span>
        </div>

        <!-- MENÚ DE NAVEGACIÓN LATERAL -->
        <nav class="sidebar-menu">
            <a href="/escuelaitg/escuelaitg-4t1/index.php" class="nav-link <?php echo ($pagina_actual == 'index.php' && strpos($ruta_actual, '/proceso/') === false && strpos($ruta_actual, '/reportes/') === false) ? 'active' : ''; ?>">
                <span class="nav-link-left">
                    <i class="bi bi-house-door-fill"></i>
                    <span class="nav-label">Inicio</span>
                </span>
            </a>

            <?php if ($rol == 1) { ?>
                <div class="sidebar-section-title">Administración</div>

                <a href="#catSubmenu" data-bs-toggle="collapse" aria-expanded="true" class="nav-link">
                    <span class="nav-link-left">
                        <i class="bi bi-folder2-open"></i>
                        <span class="nav-label">Catálogos</span>
                    </span>
                    <i class="bi bi-chevron-down menu-arrow small"></i>
                </a>
                <div class="collapse show" id="catSubmenu">
                    <ul class="submenu">
                        <li>
                            <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudalumnos.php" class="nav-link <?php echo ($pagina_actual == 'crudalumnos.php') ? 'active' : ''; ?>">
                                <span class="nav-link-left"><i class="bi bi-people"></i><span class="nav-label">Alumnos</span></span>
                            </a>
                        </li>
                        <li>
                            <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudgrupos.php" class="nav-link <?php echo ($pagina_actual == 'crudgrupos.php') ? 'active' : ''; ?>">
                                <span class="nav-link-left"><i class="bi bi-collection"></i><span class="nav-label">Grupos</span></span>
                            </a>
                        </li>
                        <li>
                            <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudmaterias.php" class="nav-link <?php echo ($pagina_actual == 'crudmaterias.php') ? 'active' : ''; ?>">
                                <span class="nav-link-left"><i class="bi bi-book"></i><span class="nav-label">Materias</span></span>
                            </a>
                        </li>
                        <li>
                            <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudprofesores.php" class="nav-link <?php echo ($pagina_actual == 'crudprofesores.php') ? 'active' : ''; ?>">
                                <span class="nav-link-left"><i class="bi bi-person-badge"></i><span class="nav-label">Profesores</span></span>
                            </a>
                        </li>
                        <li>
                            <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudunidad.php" class="nav-link <?php echo ($pagina_actual == 'crudunidad.php') ? 'active' : ''; ?>">
                                <span class="nav-link-left"><i class="bi bi-layers"></i><span class="nav-label">Unidades</span></span>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php } ?>

            <?php if ($rol == 1 || $rol == 2) { ?>
                <div class="sidebar-section-title">Gestión Académica</div>
                <a href="/escuelaitg/escuelaitg-4t1/proceso/index.php" class="nav-link <?php echo (strpos($ruta_actual, '/proceso/') !== false) ? 'active' : ''; ?>">
                    <span class="nav-link-left"><i class="bi bi-gear-wide-connected"></i><span class="nav-label">Procesos</span></span>
                </a>
                <a href="/escuelaitg/escuelaitg-4t1/reportes/index.php" class="nav-link <?php echo (strpos($ruta_actual, '/reportes/') !== false) ? 'active' : ''; ?>">
                    <span class="nav-link-left"><i class="bi bi-bar-chart-line-fill"></i><span class="nav-label">Reportes</span></span>
                </a>
                <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudinscripciones.php" class="nav-link <?php echo ($pagina_actual == 'crudinscripciones.php') ? 'active' : ''; ?>">
                    <span class="nav-link-left"><i class="bi bi-journal-check"></i><span class="nav-label">Inscripciones</span></span>
                </a>
                <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudasignaciones.php" class="nav-link <?php echo ($pagina_actual == 'crudasignaciones.php') ? 'active' : ''; ?>">
                    <span class="nav-link-left"><i class="bi bi-link-45deg"></i><span class="nav-label">Asignaciones</span></span>
                </a>
                <a href="/escuelaitg/escuelaitg-4t1/catalogos/crud/crudcalificaciones.php" class="nav-link <?php echo ($pagina_actual == 'crudcalificaciones.php') ? 'active' : ''; ?>">
                    <span class="nav-link-left"><i class="bi bi-star-fill"></i><span class="nav-label">Calificaciones</span></span>
                </a>
            <?php } ?>

            <?php if ($rol == 3) { ?>
                <div class="sidebar-section-title">Alumno</div>
                <a href="/escuelaitg/escuelaitg-4t1/reportes/reporte_calificaciones.php" class="nav-link <?php echo ($pagina_actual == 'reporte_calificaciones.php') ? 'active' : ''; ?>">
                    <span class="nav-link-left"><i class="bi bi-star-fill"></i><span class="nav-label">Mis Calificaciones</span></span>
                </a>
            <?php } ?>
        </nav>
    </div>

    <!-- FOOTER / CERRAR SESIÓN -->
    <div class="sidebar-footer">
        <a href="/escuelaitg/escuelaitg-4t1/logout.php" class="sidebar-logout-btn" title="Cerrar sesión">
            <i class="bi bi-box-arrow-right"></i>
            <span class="sidebar-logout-label">Cerrar Sesión</span>
        </a>
    </div>
</aside>