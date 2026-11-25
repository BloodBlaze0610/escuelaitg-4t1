<?php

$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "saeigh";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos (" . htmlspecialchars($base_datos) . "): " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");

return $conexion;