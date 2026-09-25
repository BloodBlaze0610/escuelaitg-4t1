<?php

include("../../conexion.php");

$matricula = $_POST['matricula_al'];
$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$domicilio = $_POST['domicilio'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

$sql = "INSERT INTO alumno
(matricula_al, nombre, apaterno, amaterno, domicilio, telefono, email)
VALUES
('$matricula', '$nombre', '$apaterno', '$amaterno', '$domicilio', '$telefono', '$email')";

if ($conexion->query($sql) === TRUE) {

    echo "Alumno registrado correctamente";

} else {

    echo "Error al registrar: " . $conexion->error;

}

$conexion->close();

?>