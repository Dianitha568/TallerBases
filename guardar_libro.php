<?php
include 'conexion.php';

$titulo = $_POST['titulo_libro'];
$formato = $_POST['formato_libro'];
$año = $_POST['año_libro'];
$votos = $_POST['votos_libro'];
$editorial = $_POST['editorial'];
$disponible = $_POST['disponible'];

try {
    $stmt = $conexion->prepare("INSERT INTO TbLibro (titulo_libro, formato_libro, año_libro, votos_libro, editorial, disponible) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$titulo, $formato, $año, $votos, $editorial, $disponible]);
    header("Location: libros.php?mensaje=guardado");
    exit();
} catch (PDOException $e) {
    echo "Error al guardar el libro: " . $e->getMessage();
}
?>
