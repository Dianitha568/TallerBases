<?php
include 'conexion.php';

$sql = "SELECT p.id_prestamo, l.titulo_libro, u.nombre_usuario, p.fecha_prestamo, p.fecha_devolucion
        FROM TbPrestamo p
        INNER JOIN Tblibro l ON p.id_libro = l.isbn
        INNER JOIN TbUsuario u ON p.id_usuario = u.id_usuario
        WHERE p.fecha_devolucion < DATE('now')";

$resultado = $conexion->query($sql);
$prestamos = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Préstamos Vencidos</title>
</head>
<body>
    <h2>📅 Préstamos Vencidos</h2>
    <table border="1">
        <tr>
            <th>ID Préstamo</th>
            <th>Título Libro</th>
            <th>Usuario</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
        </tr>
        <?php foreach ($prestamos as $p): ?>
        <tr>
            <td><?= $p['id_prestamo'] ?></td>
            <td><?= htmlspecialchars($p['titulo_libro']) ?></td>
            <td><?= htmlspecialchars($p['nombre_usuario']) ?></td>
            <td><?= $p['fecha_prestamo'] ?></td>
            <td><?= $p['fecha_devolucion'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="reportes.php">← Volver a Reportes</a>
</body>
</html>
