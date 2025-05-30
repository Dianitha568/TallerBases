<?php
require 'conexion.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Tblibro WHERE isbn = :isbn";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':isbn', $id, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: libros.php?mensaje=eliminado");
        exit();
    } else {
        echo "Error al eliminar el libro.";
    }
} else {
    echo "ID no válido.";
}
?>
