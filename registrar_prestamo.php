<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['isbn']) || empty($_POST['id_usuario']) || empty($_POST['fecha_prestamo']) || empty($_POST['fecha_devolucion'])) {
        echo "Faltan datos obligatorios.";
        exit;
    }

    $isbn = trim($_POST['isbn']);
    $id_usuario = (int)$_POST['id_usuario'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    $sql = "INSERT INTO TbPrestamo (id_libro, id_usuario, fecha_prestamo, fecha_devolucion)
            VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $resultado = $stmt->execute([$isbn, $id_usuario, $fecha_prestamo, $fecha_devolucion]);

    if ($resultado) {
        header("Location: prestamos.php?mensaje=registrado");
        exit;
    } else {
        echo "Error al registrar el préstamo.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
