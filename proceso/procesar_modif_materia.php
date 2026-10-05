<?php

include("../conexion.php");

$materia_actual = $_POST["materia_actual"];
$descripcion_mat = $_POST["descripcion_mat"];

$sql = "UPDATE materias
        SET descripcion_mat = '$descripcion_mat'
        WHERE descripcion_mat = '$materia_actual'";

if ($conexion->query($sql)) {

    echo "<script>
            alert('Materia modificada correctamente');
            window.location.href='../catalogos/crud/crudmaterias.php';
          </script>";

} else {

    echo "Error al modificar la materia: " . $conexion->error;

}

?>