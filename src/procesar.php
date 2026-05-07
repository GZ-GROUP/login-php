<?php

// ============================================================
// PASO 2: Procesamiento y Capa Lógica (PHP)
// Recibir los datos del formulario mediante el método POST
// ============================================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtener y limpiar los datos recibidos por POST
    $nombre    = trim($_POST["nombre"]    ?? "");
    $correo    = trim($_POST["correo"]    ?? "");
    $password  = trim($_POST["password"]  ?? "");
    $confirmar = trim($_POST["confirmar"] ?? "");

    // ============================================================
    // PASO 3: Validación y Manejo de Excepciones (reglas 4 y 5)
    // ============================================================

    try {

        // Regla 4: Verificar que ningún campo esté vacío
        if (empty($nombre) || empty($correo) || empty($password) || empty($confirmar)) {
            throw new Exception("Error: Todos los campos son obligatorios. Ningún campo puede estar vacío.");
        }

        // Regla 5: Validar que el correo electrónico tenga un formato correcto usando filter_var()
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Error: El correo electrónico '$correo' no tiene un formato válido.");
        }

        // Si todas las validaciones pasan, mostrar mensaje de éxito provisional
        echo "<p style='color: green;'>Validaciones de campo y correo superadas correctamente.</p>";

    } catch (Exception $e) {

        // Mostrar el mensaje de error al usuario
        echo "<p style='color: red; font-family: Arial; padding: 10px; border: 1px solid red; display: inline-block;'>"
           . htmlspecialchars($e->getMessage())
           . "</p>";
    }

} else {
    echo "<p style='color: orange;'>Acceso no permitido. Este archivo debe ser llamado desde un formulario POST.</p>";
}
?>