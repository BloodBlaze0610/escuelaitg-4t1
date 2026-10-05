<?php

include("../conexion.php");

$nocontrol_actual = $_POST["nocontrol_actual"];

$nocontrol_prof = $_POST["nocontrol_prof"];
$nombre_prof = $_POST["nombre_prof"];
$apaterno_prof = $_POST["apaterno_prof"];
$amaterno_prof = $_POST["amaterno_prof"];
$dom_prof = $_POST["dom_prof"];
$mail_prof = $_POST["mail_prof"];
$tel_prof = $_POST["tel_prof"];

$sql = "UPDATE profesores
        SET nocontrol_prof = '$nocontrol_prof',
            nombre_prof = '$nombre_prof',
            apaterno_prof = '$apaterno_prof',
            amaterno_prof = '$amaterno_prof',
            dom_prof = '$dom_prof',
            mail_prof = '$mail_prof',
            tel_prof = '$tel_prof'
        WHERE nocontrol_prof = '$nocontrol_actual'";

if ($conexion->query($sql)) {

    echo "<script>
            alert('Profesor modificado correctamente');
            window.location.href='../catalogos/crud/crudprofesores.php';
          </script>";

} else {

    echo "Error al modificar el profesor: " . $conexion->error;

}

?>