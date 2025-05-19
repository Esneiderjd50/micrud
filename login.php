<?php

$servidor = "localhost";
$nombreusuario = "esneider";
$password = "Hola123*";
$db = 'zulia';

$conexion = new mysqli($servidor, $nombreusuario, $password, $db);

if($conexion-> connect_error){
    die("Conexión fallida: " . $conexion-> connect_error);
}

if (
    isset($_POST['nombre']) && $_POST['nombre'] != '' &&
    isset($_POST['correo']) && $_POST['correo'] != '' &&
    isset($_POST['contraseña']) && $_POST['contraseña'] != '' &&
    isset($_POST['telefono']) && $_POST['telefono'] != ''
) {
    $name = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $phone = $_POST['telefono'];

    $sql = "INSERT INTO user (nombre, correo, contraseña, telefono) VALUES ('$name', '$correo', '$contraseña', '$phone')";

    if ($conexion->query($sql) == true) {
        echo "<h1>Se guardó correctamente</h1>";
    } else {
        echo "<h1>Error al guardar</h1>";
    }
}

$conexion->close();

?>