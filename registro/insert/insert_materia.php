<?php

include("../../conexion.php");

$descripcion = $_POST['descripcion_mat'];

$sql = "INSERT INTO materias
(descripcion_mat)
VALUES
('$descripcion')";

if ($conexion->query($sql) === TRUE) {

    echo "Materia registrada correctamente";

} else {

    echo "Error al registrar: " . $conexion->error;

}

$conexion->close();

?>