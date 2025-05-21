<?php
$servidor = "localhost";
$nombreusuario = "esneider";
$password = "Hola123*";
$db = 'zulia';

$conexion = new mysqli($servidor, $nombreusuario, $password, $db);

if($conexion-> connect_error){
    die("Conexión fallida: " . $conexion-> connect_error);
}

$sql = "SELECT * FROM user";
$result = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>usuarios</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-neutral-600">
    <div class="container w-full max-w-10xl h-screen p-4 mx-auto flex items-center justify-center">
        <div class="w-full h-full bg-neutral-900 rounded-xl p-5 text-white flex flex-col">
            <p class="text-xl font-light py-5">Lista de usuarios</p>

            <div class="w-full h-full bg-neutral-800 rounded-md shadow-inner shadow-neutral-950 p-5 flex flex-col gap-">

                <?php
                
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            ?>

                                <div 
                                    class="grid grid-cols-6 items-center justify-items-center bg-neutral-900 px-5 py-2 rounded shadow shadow-neutral-900 mb-2"
                                >
                                    <p><?php echo($row['id']) ?></p>
                                    <p><?php echo($row['nombre']) ?></p>
                                    <p><?php echo($row['correo']) ?></p>
                                    <p><?php echo($row['contraseña']) ?></p>
                                    <p><?php echo($row['telefono']) ?></p>
                                    <form action="login.php" method="POST">
                                        <input type="hidden" name="eliminar" value="<?php echo($row['id']) ?>">
                                        <button 
                                            type="submit" 
                                            class="bg-red-600 hover:bg-red-400 text-white font-bold py-2 px-3 rounded"

                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');"
                                        >
                                            DELETE 
                                        </button>
                                        


                                    </form>
                                </div>

                            <?php
                        }
                    } else {
                        ?>

                        <div 
                            class="grid grid-cols-6 items-center justify-items-center bg-neutral-900 px-5 py-2 rounded shadow shadow-neutral-900"
                        >
                            <p>ID</p>
                            <p>Nombre</p>
                            <p>Correo</p>
                            <p>Contraseña</p>
                            <p>Teléfono</p>
                      

                        </div>

                        <?php
                    }
                
                ?>

            </div>
        </div>
    </div>

    
</body>
</html>