<?php
require 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM TbAutor WHERE id_autor = :id_autor";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_autor', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: autores.php?mensaje=eliminado");
        exit();
    } else {
        echo "Error al eliminar el autor.";
    }
} else {
    echo "ID no válido.";
}
?>
