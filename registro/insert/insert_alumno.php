<?php

include("../../conexion.php");

$matricula = $_POST['matricula_al'];
$nombre = $_POST['nombre_al'];
$apaterno = $_POST['apaterno_al'];
$amaterno = $_POST['amaterno_al'];
$domicilio = $_POST['dom_al'];
$telefono = $_POST['tel_al'];
$email = $_POST['mail_al'];

$sql = "INSERT INTO alumnos
(matricula_al, nombre_al, apaterno_al, amaterno_al, dom_al, tel_al, mail_al)
VALUES
('$matricula', '$nombre', '$apaterno', '$amaterno', '$domicilio', '$telefono', '$email')";

if ($conexion->query($sql) === TRUE) {

    echo "<script>
            alert('Alumno registrado correctamente');
            window.location.href='../../catalogos/crud/crudalumnos.php';
          </script>";

} else {

    echo "Error al registrar: " . $conexion->error;

}

$conexion->close();

?>
```
