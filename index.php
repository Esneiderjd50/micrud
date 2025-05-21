<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="w-full h-screen bg-neutral-800 flex items-center justify-center">
    

    <form
        action="login.php"
        method="POST"
        class="p-6 bg-neutral-100 rounded-md flex flex-col gap-4"
    >
        <p>registro de usuario</p>

        <label for="">Nombre</label>
        <input
            type="text"
            placeholder="Nombre"
            name="nombre"
            class="bg-neutral-300 px-4 py-2 rounded"
            required
        >

        <label for="">correo</label>
        <input
            type="email"
            placeholder="correo"
            name="correo"
            class="bg-neutral-300 px-4 py-2 rounded"
            required
        >

        <label for="">Contraseña</label>
        <input
            type="password"
            placeholder="Contraseña"
            name="contraseña"
            class="bg-neutral-300 px-4 py-2 rounded"
            required
        >


        <label for="">Teléfono</label>
        <input
            type="number"
            placeholder="Teléfono"
            name="telefono"
            class="bg-neutral-300 px-4 py-2 rounded"
            required
        >

        <button class="px-4 py-2 rounded bg-blue-500 text-white">
            Enviar
        </button>
    </form>

</body>
</html>