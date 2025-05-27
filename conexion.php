<?php
try {
    // Ruta completa a tu archivo .db
    $rutaBaseDatos = "C:\\Users\\Dianitha\\Desktop\\Tallerbases\\biblioteca.db";

    // Crear una nueva conexión PDO
    $conexion = new PDO("sqlite:$rutaBaseDatos");

    // Configurar el modo de error para que arroje excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ ¡Conexión a SQLite exitosa!";
} catch (PDOException $e) {
    echo "❌ Error en la conexión: " . $e->getMessage();
}
?>
