<?php
$servidor = "localhost";
$nombreusuario = "esneider";
$password = "Hola123*";
$db = 'zulia';

$conexion = new mysqli($servidor, $nombreusuario, $password, $db);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
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

    <style>
        .fade-enter {
            opacity: 0;
            transform: scale(0.95);
        }

        .fade-enter-active {
            opacity: 1;
            transform: scale(1);
            transition: all 0.3s ease;
        }

        .fade-leave {
            opacity: 1;
            transform: scale(1);
        }

        .fade-leave-active {
            opacity: 0;
            transform: scale(0.95);
            transition: all 0.2s ease;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white flex items-center justify-center p-8">

    <div class="w-full max-w-6xl">
        <h1 class="text-3xl font-bold mb-8 text-center">👥 Lista de Usuarios</h1>

        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-2xl">
            <div class="grid grid-cols-8 md:grid-cols-8 gap-4 font-semibold border-b border-white/20 pb-3 mb-4 text-sm md:text-base">
                <p>ID</p>
                <p>Nombre</p>
                <p>Correo</p>
                <p>Contraseña</p>
                <p>Teléfono</p>
                <p class="col-span-2 text-center">Acciones</p>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="grid grid-cols-8 md:grid-cols-8 gap-8 items-center py-3 px-4 mb-2 bg-white/5 rounded hover:bg-white/10 transition">
                        <p><?php echo $row['id']; ?></p>
                        <p class="break-words truncate max-w-[160px]"><?php echo $row['nombre']; ?></p>
                        <p class="break-words truncate max-w-[160px]"><?php echo $row['correo']; ?></p>
                        <p class="break-words truncate max-w-[160px]"><?php echo $row['contraseña']; ?></p>
                        <p class="break-words truncate max-w-[160px]"><?php echo $row['telefono']; ?></p>

                        <form method="POST" action="login.php" onsubmit="event.preventDefault(); showActionModal({ type: 'delete', user: '<?php echo $row['nombre']; ?>', action: this });">
                            <input type="hidden" name="eliminar" value="<?php echo $row['id']; ?>">
                            <button class="bg-red-600 hover:bg-red-500 text-white px-4 py-1 rounded font-semibold text-sm transition">❌ Eliminar</button>
                        </form>

                        <a
                            href="editar.php?id=<?php echo $row['id']; ?>"
                            onclick="event.preventDefault(); showActionModal({ type: 'edit', user: '<?php echo $row['nombre']; ?>', url: this.href });"
                            class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-1 rounded font-semibold text-sm transition">
                            📝 Editar
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center text-white/70 py-6">No hay usuarios registrados.</p>
            <?php endif; ?>
        </div>
    </div>

    <div id="actionModal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
        <div id="modalBox" class="bg-white text-black rounded-xl shadow-xl p-6 w-full max-w-md transform scale-95 opacity-0 transition-all duration-300">
            <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
            <p id="modalMessage" class="mb-6"></p>
            <div class="flex justify-end gap-4">
                <button onclick="closeActionModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Cancelar</button>
                <button id="modalConfirmBtn" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 transition">Confirmar</button>
            </div>
        </div>
    </div>

    <script>
        let pendingAction = null;

        function showActionModal({
            type,
            user,
            action = null,
            url = null
        }) {
            const modal = document.getElementById('actionModal');
            const box = document.getElementById('modalBox');
            const title = document.getElementById('modalTitle');
            const message = document.getElementById('modalMessage');
            const confirmBtn = document.getElementById('modalConfirmBtn');

            modal.classList.remove('hidden');
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');

            if (type === 'delete') {
                title.textContent = '¿Eliminar usuario?';
                message.textContent = `¿Deseas eliminar a ${user}? Esta acción no se puede deshacer.`;
                confirmBtn.textContent = 'Eliminar';
                confirmBtn.className = 'px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded transition';
                pendingAction = () => action.submit();
            }

            if (type === 'edit') {
                title.textContent = '¿Editar usuario?';
                message.textContent = `¿Deseas editar a ${user}?`;
                confirmBtn.textContent = 'Editar';
                confirmBtn.className = 'px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded transition';
                pendingAction = () => window.location.href = url;
            }
        }

        function closeActionModal() {
            const modal = document.getElementById('actionModal');
            const box = document.getElementById('modalBox');
            box.classList.remove('scale-100', 'opacity-100');
            box.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 200);
            pendingAction = null;
        }

        document.getElementById('modalConfirmBtn').addEventListener('click', () => {
            if (pendingAction) pendingAction();
        });
    </script>
    </script>

</body>

</html>