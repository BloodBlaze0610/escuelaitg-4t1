<?php

include("../conexion.php");

$descripcion = $_POST["descripcion"];


$sql = "DELETE FROM grupo
        WHERE descripcion_grupo = '$descripcion'";


if ($conexion->query($sql)) {

    echo "<script>
            alert('Grupo dado de baja correctamente');
            window.location.href='../catalogos/crud/crudgrupos.php';
          </script>";

} else {

    echo "Error al dar de baja el grupo: " . $conexion->error;

}

?>