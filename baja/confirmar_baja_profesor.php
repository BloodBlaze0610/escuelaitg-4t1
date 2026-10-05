<?php

include("../conexion.php");

$nocontrol_prof = $_POST["nocontrol_prof"];

$sql = "DELETE FROM profesores
        WHERE nocontrol_prof = '$nocontrol_prof'";

if ($conexion->query($sql)) {

    echo "<script>
            alert('Profesor dado de baja correctamente');
            window.location.href='../catalogos/crud/crudprofesores.php';
          </script>";

} else {

    echo "Error al dar de baja el profesor: " . $conexion->error;

}

?>