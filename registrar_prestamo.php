<?php
include 'conexion.php';

$isbn = $_POST['isbn'];
$id_usuario = $_POST['id_usuario'];
$fecha_prestamo = $_POST['fecha_prestamo'];
$fecha_devolucion = $_POST['fecha_devolucion'];

$sql = "INSERT INTO TbPrestamo (id_libro, id_usuario, fecha_prestamo, fecha_devolucion)
        VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$isbn, $id_usuario, $fecha_prestamo, $fecha_devolucion]);

header("Location: prestamos.php");
exit;
?>
