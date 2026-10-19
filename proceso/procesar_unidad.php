
<?php

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $descripcion = trim($_POST["descripcion"] ?? "");

    if ($descripcion == "") {
        header("Location: ../registro/unidad.php?error=vacio");
        exit;
    }

    $consulta = "INSERT INTO unidad (descripcion) VALUES (?)";

    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("s", $descripcion);

    if ($stmt->execute()) {

        header("Location: ../catalogos/crud/crudunidad.php?registro=correcto");
        exit;

    } else {

        echo "Error al registrar la unidad: " . $stmt->error;

    }

    $stmt->close();

} else {

    header("Location: ../registro/unidad.php");
    exit;

}

?>
