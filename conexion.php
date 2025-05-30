<?php
try {
    // Usar ruta relativa al proyecto
    $rutaBaseDatos = __DIR__ . '/biblioteca.db';

    // Crear una nueva conexión PDO
    $conexion = new PDO("sqlite:$rutaBaseDatos");

    // Configurar el modo de error para que arroje excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "✅ ¡Conexión a SQLite exitosa!";
} catch (PDOException $e) {
    echo "❌ Error en la conexión: " . $e->getMessage();
    exit; // Asegura que no siga ejecutando si falla la conexión
}
?>
