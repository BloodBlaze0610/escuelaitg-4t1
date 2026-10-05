<?php

include("../conexion.php");

$fila = $_POST["fila"];


$resultado = $conexion->query("SELECT matricula_al, nombre_al, apaterno_al, amaterno_al, dom_al, mail_al, tel_al
FROM alumnos
LIMIT 1 OFFSET $fila");

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$alumno = $resultado->fetch_assoc();

if (!$alumno) {
    die("No se encontró el alumno.");
}


$sql = "DELETE FROM alumnos
        WHERE matricula_al = '{$alumno["matricula_al"]}'
        AND nombre_al = '{$alumno["nombre_al"]}'
        AND apaterno_al = '{$alumno["apaterno_al"]}'
        AND amaterno_al = '{$alumno["amaterno_al"]}'
        AND dom_al = '{$alumno["dom_al"]}'
        AND mail_al = '{$alumno["mail_al"]}'
        AND tel_al = '{$alumno["tel_al"]}'
        LIMIT 1";


if ($conexion->query($sql)) {

    echo "<script>
            alert('Alumno dado de baja correctamente');
            window.location.href='../catalogos/crud/crudalumnos.php';
          </script>";

} else {

    echo "Error al dar de baja: " . $conexion->error;

}

?>