<?php

include("../conexion.php");

$descripcion_mat = $_POST["descripcion_mat"];

$sql = "INSERT INTO materias (descripcion_mat)
        VALUES ('$descripcion_mat')";

if ($conexion->query($sql)) {

    echo "<script>
            alert('Materia registrada correctamente');
            window.location.href='../catalogos/crud/crudmaterias.php';
          </script>";

} else {

    echo "Error al registrar la materia: " . $conexion->error;

}

?>