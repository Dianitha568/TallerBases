<?php
include 'conexion.php';

$sql = "SELECT c.nombre_categoria, COUNT(l.isbn) AS total_libros
        FROM Tblibro l
        INNER JOIN TbCategoria c ON l.categoria_id = c.id_categoria
        WHERE l.disponible > 0
        GROUP BY c.id_categoria
        ORDER BY total_libros DESC";

$resultado = $conexion->query($sql);
$categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros por Categoría</title>
</head>
<body>
    <h2>📖 Libros Disponibles por Categoría</h2>
    <table border="1">
        <tr>
            <th>Categoría</th>
            <th>Total Libros Disponibles</th>
        </tr>
        <?php foreach ($categorias as $cat): ?>
        <tr>
            <td><?= htmlspecialchars($cat['nombre_categoria']) ?></td>
            <td><?= $cat['total_libros'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="reportes.php">← Volver a Reportes</a>
</body>
</html>
