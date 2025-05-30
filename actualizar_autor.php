<?php
include 'conexion.php';

// Validar datos obligatorios
if (empty($_POST['id_autor']) || empty($_POST['nom_autor']) || empty($_POST['pais_autor']) || empty($_POST['idioma_autor'])) {
    echo "Datos obligatorios faltantes.";
    exit;
}

$id = (int)$_POST['id_autor'];
$nombre = trim($_POST['nom_autor']);
$pais = trim($_POST['pais_autor']);
$email = !empty($_POST['email_autor']) ? trim($_POST['email_autor']) : null;
$idioma = trim($_POST['idioma_autor']);

$sql = "UPDATE TbAutor 
        SET nom_autor = :nombre, 
            pais_autor = :pais, 
            email_autor = :email, 
            idioma_autor = :idioma 
        WHERE id_autor = :id";

try {
    $stmt = $conexion->prepare($sql);
    $resultado = $stmt->execute([
        'nombre' => $nombre,
        'pais' => $pais,
        'email' => $email,
        'idioma' => $idioma,
        'id' => $id
    ]);

    if ($resultado) {
        header("Location: autores.php?mensaje=actualizado");
        exit();
    } else {
        echo "Error al actualizar el autor.";
    }
} catch (PDOException $e) {
    echo "Error al actualizar el autor: " . htmlspecialchars($e->getMessage());
}
?>
