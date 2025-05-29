<?php
include 'conexion.php';

$nombre = $_POST['nom_autor'];
$pais = $_POST['pais_autor'];
$email = $_POST['email_autor'] ?? null;
$idioma = $_POST['idioma_autor'];

try {
    $stmt = $conexion->prepare("INSERT INTO TbAutor (nom_autor, pais_autor, email_autor, idioma_autor) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $pais, $fecha_nac, $email, $idioma]);
    header("Location: autores.php?mensaje=guardado");
    exit();
} catch (PDOException $e) {
    echo "Error al guardar el autor: " . $e->getMessage();
}
?>
