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
      return header("Location: guardado.php");
      exit();

    } else {
        die("Error al insertar datos: " . $conexion->error);
    }

}

     if(isset($_POST['borrar'])){
                $borrar = $_POST['borrar'];
                
                $sql = "INSERT INTO user(borrar, completado)
                 VALUES('$borrar', false)";

                if($conexion->query($sql) === true){
                  
                }else{
                    die("Error al insertar datos: " . $conexion->error);
                } 
            }else if(isset($_POST['completar'])){
                $id = $_POST['completar'];

                $sql = "UPDATE user SET completado = 1 WHERE id = $id";

                if($conexion->query($sql) === true){
                 
                }else{
                    die("Error al actualizar datos: " . $conexion->error);
                } 
            }else if(isset($_POST['eliminar'])){
                $id = $_POST['eliminar'];

                $sql = "DELETE FROM user WHERE id = $id";

                if($conexion->query($sql) === true){
                    echo "<h1>Se eliminó correctamente</h1>";
                }else{
                    die("Error al actualizar datos: " . $conexion->error);
                } 
                    header("Location: user.php");
                    exit();
            }

                 $conexion->close();

?>