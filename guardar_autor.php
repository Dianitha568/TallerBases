<?php
include 'conexion.php';

// Validar datos recibidos
if (empty($_POST['nom_autor']) || empty($_POST['pais_autor']) || empty($_POST['idioma_autor'])) {
    echo " Datos obligatorios faltantes.";
    exit;
}

$nombre = trim($_POST['nom_autor']);
$pais = trim($_POST['pais_autor']);
$email = !empty($_POST['email_autor']) ? trim($_POST['email_autor']) : null;
$idioma = trim($_POST['idioma_autor']);

try {
    $stmt = $conexion->prepare("INSERT INTO TbAutor (nom_autor, pais_autor, email_autor, idioma_autor) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $pais, $email, $idioma]);
    header("Location: autores.php?mensaje=guardado");
    exit();
} catch (PDOException $e) {
    echo " Error al guardar el autor: " . htmlspecialchars($e->getMessage());
}
?>
