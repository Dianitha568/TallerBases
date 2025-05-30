<?php
include 'conexion.php';

// Validar datos obligatorios
if (empty($_POST['titulo_libro']) || empty($_POST['formato_libro']) || empty($_POST['año_libro']) || empty($_POST['votos_libro']) || empty($_POST['editorial']) || empty($_POST['disponible'])) {
    echo "Datos obligatorios faltantes.";
    exit;
}

$titulo = trim($_POST['titulo_libro']);
$formato = trim($_POST['formato_libro']);
$año = (int)$_POST['año_libro'];
$votos = (int)$_POST['votos_libro'];
$editorial = trim($_POST['editorial']);
$disponible = (int)$_POST['disponible'];

try {
    $stmt = $conexion->prepare("INSERT INTO TbLibro (titulo_libro, formato_libro, año_libro, votos_libro, editorial, disponible) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$titulo, $formato, $año, $votos, $editorial, $disponible]);
    header("Location: libros.php?mensaje=guardado");
    exit();
} catch (PDOException $e) {
    echo "Error al guardar el libro: " . htmlspecialchars($e->getMessage());
}
?>
