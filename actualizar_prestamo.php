<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        empty($_POST['id_prestamo']) ||
        empty($_POST['isbn']) ||
        empty($_POST['id_usuario']) ||
        empty($_POST['fecha_prestamo']) ||
        empty($_POST['fecha_devolucion'])
    ) {
        echo "Faltan datos obligatorios.";
        exit;
    }

    $id_prestamo = (int)$_POST['id_prestamo'];
    $isbn = trim($_POST['isbn']);
    $id_usuario = (int)$_POST['id_usuario'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    $sql = "UPDATE TbPrestamo SET id_libro = ?, id_usuario = ?, fecha_prestamo = ?, fecha_devolucion = ? WHERE id_prestamo = ?";
    $stmt = $conexion->prepare($sql);
    $resultado = $stmt->execute([$isbn, $id_usuario, $fecha_prestamo, $fecha_devolucion, $id_prestamo]);

    if ($resultado) {
        header("Location: prestamos.php?mensaje=actualizado");
        exit;
    } else {
        echo "Error al actualizar el préstamo.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
