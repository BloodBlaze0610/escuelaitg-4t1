<?php
session_start();      // Reanudamos la sesión existente
session_unset();      // Liberamos todas las variables de sesión

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();    // Destruimos la sesión en el servidor

// Redirigimos al usuario de regreso a la pantalla de inicio de sesión
header("Location: login.php");
exit();