<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title> 
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="w-full h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1508780709619-79562169bc64?auto=format&fit=crop&w=1470&q=80');">

    <form
        action="login.php"
        method="POST"
        class="backdrop-blur-md bg-white/10 border border-white/20 text-white p-8 rounded-xl shadow-xl w-full max-w-md flex flex-col gap-5">
        <h2 class="text-2xl font-bold text-center">Registro de Usuario</h2>

        <div>
            <label class="block mb-1">Nombre</label>
            <input
                type="text"
                placeholder="Nombre"
                name="nombre"
                class="w-full bg-white/20 text-white placeholder-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>
        </div>

        <div>
            <label class="block mb-1">Correo</label>
            <input
                type="email"
                placeholder="correo"
                name="correo"
                class="w-full bg-white/20 text-white placeholder-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>
        </div>

        <div>
            <label class="block mb-1">Contraseña</label>
            <input
                type="password"
                placeholder="Contraseña"
                name="contraseña"
                class="w-full bg-white/20 text-white placeholder-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>
        </div>

        <div>
            <label class="block mb-1">Teléfono</label>
            <input
                type="number"
                placeholder="Teléfono"
                name="telefono"
                class="w-full bg-white/20 text-white placeholder-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>
        </div>

        <button class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded transition">
            Enviar
        </button>
    </form>
</body>

</html>