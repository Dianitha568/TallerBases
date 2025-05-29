<?php
include 'conexion.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conexion->prepare("DELETE FROM TbUsuario WHERE id_usuario = :id");
    $stmt->execute(['id' => $id]);
}

header('Location: usuarios.php');
exit;
