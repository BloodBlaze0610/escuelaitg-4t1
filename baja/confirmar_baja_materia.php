<?php

include("../conexion.php");

$descripcion_mat = $_POST["descripcion_mat"];

$sql = "DELETE FROM materias
        WHERE descripcion_mat = '$descripcion_mat'";

if ($conexion->query($sql)) {

    echo "<script>
            alert('Materia dada de baja correctamente');
            window.location.href='../catalogos/crud/crudmaterias.php';
          </script>";

} else {

    echo "Error al dar de baja la materia: " . $conexion->error;

}

?>