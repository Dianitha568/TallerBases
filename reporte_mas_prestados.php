<?php
include 'conexion.php';

$sql = "SELECT l.titulo_libro, COUNT(p.id_prestamo) AS total_prestamos
        FROM TbPrestamo p
        INNER JOIN Tblibro l ON p.id_libro = l.isbn
        GROUP BY l.isbn
        ORDER BY total_prestamos DESC
        LIMIT 10";

$resultado = $conexion->query($sql);
$libros = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/LibrosMasPrestados.css">
    <title>Libros Más Prestados</title>
</head>
<body>
    <div class="container">
    <h2>📚 Libros Más Prestados</h2>
    <table border="1">
        <tr>
            <th>Título</th>
            <th>Total Préstamos</th>
        </tr>
        <?php foreach ($libros as $libro): ?>
        <tr>
            <td><?= htmlspecialchars($libro['titulo_libro']) ?></td>
            <td><?= $libro['total_prestamos'] ?></td>
            
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="reportes.php">← Volver a Reportes</a>
    </div>
</body>
</html>
