<?php
include 'conexion.php';

$id = $_GET['id'] ?? null;

if ($id && is_numeric($id)) {
    $stmt = $conexion->prepare("DELETE FROM TbUsuario WHERE id_usuario = :id");
    $resultado = $stmt->execute(['id' => $id]);

    if ($resultado) {
        header('Location: usuarios.php?mensaje=eliminado');
        exit;
    } else {
        echo "Error al eliminar el usuario.";
    }
} else {
    echo "ID no válido.";
}
?>
