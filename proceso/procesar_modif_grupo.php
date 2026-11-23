<?php

include("../conexion.php");

$descripcion_actual = $_POST["descripcion_actual"];
$descripcion_nueva = $_POST["descripcion_nueva"];


$sql = "UPDATE grupo
        SET descripcion_grupo = '$descripcion_nueva'
        WHERE descripcion_grupo = '$descripcion_actual'";


if ($conexion->query($sql)) {

    echo "<script>
            alert('Grupo modificado correctamente');
            window.location.href='../catalogos/crud/crudgrupos.php';
          </script>";

} else {

    echo "Error al modificar el grupo: " . $conexion->error;

}

?>