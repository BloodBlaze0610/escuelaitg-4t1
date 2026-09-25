<?php

include("../../conexion.php");

$nocontrol = $_POST['nocontrol_prof'];
$nombre = $_POST['nombre_prof'];
$apaterno = $_POST['apaterno_prof'];
$amaterno = $_POST['amaterno_prof'];
$domicilio = $_POST['dom_prof'];
$email = $_POST['mail_prof'];
$telefono = $_POST['tel_prof'];

$sql = "INSERT INTO profesores
(nocontrol_prof, nombre_prof, apaterno_prof, amaterno_prof, dom_prof, mail_prof, tel_prof)
VALUES
('$nocontrol', '$nombre', '$apaterno', '$amaterno', '$domicilio', '$email', '$telefono')";

if ($conexion->query($sql) === TRUE) {

    echo "Profesor registrado correctamente";

} else {

    echo "Error al registrar: " . $conexion->error;

}

$conexion->close();

?>