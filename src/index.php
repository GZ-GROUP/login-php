<?php

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre    = trim($_POST["nombre"] ?? "");
    $correo    = trim($_POST["correo"] ?? "");
    $password  = trim($_POST["password"] ?? "");
    $confirmar = trim($_POST["confirmar"] ?? "");

    try {

        if (
            empty($nombre) ||
            empty($correo) ||
            empty($password) ||
            empty($confirmar)
        ) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Correo inválido.");
        }

        if (strlen($password) < 8) {
            throw new Exception("La contraseña debe tener mínimo 8 caracteres.");
        }

        if ($password !== $confirmar) {
            throw new Exception("Las contraseñas no coinciden.");
        }

        $success = "Formulario enviado correctamente.";

    } catch (Exception $e) {

        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <title>Formulario</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

<div class="hero bg-base-200 min-h-screen">

    <div class="hero-content">

        <form method="POST">

            <fieldset class="fieldset bg-base-100 border border-base-300 rounded-box p-6 w-96">

                <legend class="fieldset-legend text-xl mb-2">
                    Iniciar Sesión
                </legend>

                <!-- MENSAJE DE ERROR -->
                <?php if (!empty($error)): ?>

                    <div class="alert alert-error mb-4">
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>

                <?php endif; ?>

                <!-- MENSAJE DE ÉXITO -->
                <?php if (!empty($success)): ?>

                    <div class="alert alert-success mb-4 flex flex-col items-start">
                        <span><?= htmlspecialchars($success) ?></span>
                        <small style="overflow-wrap:anywhere"><?= password_hash($password, PASSWORD_DEFAULT) ?></small>
                    </div>

                <?php endif; ?>

                <label class="label">Nombre</label>
                <input
                    type="text"
                    name="nombre"
                    class="input"
                    placeholder="Nombre completo"
                />

                <label class="label">Correo</label>
                <input
                    type="email"
                    name="correo"
                    class="input"
                    placeholder="Correo"
                />

                <label class="label">Contraseña</label>
                <input
                    type="password"
                    name="password"
                    class="input"
                    placeholder="Contraseña"
                />

                <label class="label">Confirmar Contraseña</label>
                <input
                    type="password"
                    name="confirmar"
                    class="input"
                    placeholder="Confirmar contraseña"
                />

                <button type="submit" class="btn btn-neutral mt-4">
                    Ingresar
                </button>

            </fieldset>

        </form>

    </div>

</div>

</body>
</html>