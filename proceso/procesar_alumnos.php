<?php

// Conexión a la base de datos

$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "escuela";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);


// Comprobar conexión

if ($conexion->connect_error) {

    die("Error de conexión: " . $conexion->connect_error);

}


// Recibir los datos del formulario

$matricula = $_POST['matricula_al'];
$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$domicilio = $_POST['domicilio'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];


// Insertar los datos

$sql = "INSERT INTO alumno
(matricula_al, nombre, apaterno, amaterno, domicilio, telefono, email)
VALUES
('$matricula', '$nombre', '$apaterno', '$amaterno', '$domicilio', '$telefono', '$email')";


// Ejecutar

if ($conexion->query($sql) === TRUE) {

    echo "Alumno registrado correctamente";

} else {

    echo "Error al registrar: " . $conexion->error;

}


// Cerrar conexión

$conexion->close();

?>