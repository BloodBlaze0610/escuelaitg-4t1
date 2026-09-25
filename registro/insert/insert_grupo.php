<?php

include("../../conexion.php");

$descripcion = $_POST['descripcion_grupo'];

$sql = "INSERT INTO grupo
(descripcion_grupo)
VALUES
('$descripcion')";

if ($conexion->query($sql) === TRUE) {

    echo "Grupo registrado correctamente";

} else {

    echo "Error al registrar: " . $conexion->error;

}

$conexion->close();

?>