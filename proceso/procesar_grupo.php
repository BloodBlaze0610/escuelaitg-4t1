<?php

include("../conexion.php");

$descripcion = $_POST["descripcion"];

$sql = "INSERT INTO grupo (descripcion_grupo)
        VALUES ('$descripcion')";

if ($conexion->query($sql)) {

    echo "<script>
            alert('Grupo registrado correctamente');
            window.location.href='../catalogos/crud/crudgrupos.php';
          </script>";

} else {

    echo "Error al registrar el grupo: " . $conexion->error;

}

?>