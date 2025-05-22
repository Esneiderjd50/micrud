<?php
$servidor = "localhost";
$nombreusuario = "esneider";
$password = "Hola123*";
$db = 'zulia';

$conexion = new mysqli($servidor, $nombreusuario, $password, $db);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $telefono = $_POST['telefono'];

    $update = $conexion->prepare("UPDATE user SET nombre = ?, correo = ?, contraseña = ?, telefono = ? WHERE id = ?");
    $update->bind_param("ssssi", $nombre, $correo, $contraseña, $telefono, $id);

    if ($update->execute()) {
        header("Location: user.php?mensaje=actualizado");
        exit;
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
} else {
    $id = $_GET['id'];
    $update = $conexion->prepare("SELECT * FROM user WHERE id = ?");
    $update->bind_param("i", $id);
    $update->execute();
    $result = $update->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Editar Usuario</h2>
        <form method="POST" class="flex flex-col gap-4">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

            <div>
                <label for="nombre" class="block mb-1 text-sm">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required class="w-full px-3 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="correo" class="block mb-1 text-sm">Correo:</label>
                <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($row['correo']); ?>" required class="w-full px-3 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="contraseña" class="block mb-1 text-sm">Contraseña:</label>
                <input type="password" name="contraseña" id="contraseña" value="<?php echo htmlspecialchars($row['contraseña']); ?>" required class="w-full px-3 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="telefono" class="block mb-1 text-sm">Teléfono:</label>
                <input type="tel" name="telefono" id="telefono" value="<?php echo htmlspecialchars($row['telefono']); ?>" required class="w-full px-3 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded transition-all">
                Guardar cambios
            </button>
        </form>
    </div>
</body>
</html>
