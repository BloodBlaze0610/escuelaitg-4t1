<?php

include("../conexion.php");

$matricula_al = $_POST["matricula_al"];

$nombre_anterior = $_POST["nombre_anterior"];
$apaterno_anterior = $_POST["apaterno_anterior"];
$amaterno_anterior = $_POST["amaterno_anterior"];
$dom_anterior = $_POST["dom_anterior"];
$mail_anterior = $_POST["mail_anterior"];
$tel_anterior = $_POST["tel_anterior"];

$nombre_al = $_POST["nombre_al"];
$apaterno_al = $_POST["apaterno_al"];
$amaterno_al = $_POST["amaterno_al"];
$dom_al = $_POST["dom_al"];
$mail_al = $_POST["mail_al"];
$tel_al = $_POST["tel_al"];


$sql = "UPDATE alumnos SET
        nombre_al = '$nombre_al',
        apaterno_al = '$apaterno_al',
        amaterno_al = '$amaterno_al',
        dom_al = '$dom_al',
        mail_al = '$mail_al',
        tel_al = '$tel_al'
        WHERE matricula_al = '$matricula_al'
        AND nombre_al = '$nombre_anterior'
        AND apaterno_al = '$apaterno_anterior'
        AND amaterno_al = '$amaterno_anterior'
        AND dom_al = '$dom_anterior'
        AND mail_al = '$mail_anterior'
        AND tel_al = '$tel_anterior'
        LIMIT 1";


if ($conexion->query($sql)) {

    echo "<script>
            alert('Alumno modificado correctamente');
            window.location.href='../catalogos/crud/crudalumnos.php';
          </script>";

} else {

    echo "Error al modificar: " . $conexion->error;

}

?>