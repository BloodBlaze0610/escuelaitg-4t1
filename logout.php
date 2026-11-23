<?php
session_start();      // Reanudamos la sesión existente
session_unset();      // Liberamos todas las variables de sesión
session_destroy();    // Destruimos la sesión en el servidor

// Redirigimos al usuario de regreso a la pantalla de inicio de sesión
header("Location: login.php");
exit();
?>