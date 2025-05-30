<?php
include 'conexion.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de préstamo no válido.";
    exit;
}

$id = (int)$_GET['id'];

$sql = "DELETE FROM TbPrestamo WHERE id_prestamo = ?";
$stmt = $conexion->prepare($sql);
$resultado = $stmt->execute([$id]);

if ($resultado) {
    header("Location: prestamos.php?mensaje=eliminado");
    exit;
} else {
    echo "Error al eliminar el préstamo.";
}
?>
