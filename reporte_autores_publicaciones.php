<?php
include 'conexion.php';

$sql = "SELECT a.nom_autor, COUNT(al.libro_isbn) AS total_libros
        FROM Tb_AutorLibro al
        INNER JOIN TbAutor a ON al.autor_id = a.id_autor
        GROUP BY a.id_autor
        ORDER BY total_libros DESC
        LIMIT 10";

$resultado = $conexion->query($sql);
$autores = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autores con Más Publicaciones</title>
</head>
<body>
    <h2>✍ Autores con Más Publicaciones</h2>
    <table border="1">
        <tr>
            <th>Autor</th>
            <th>Total Publicaciones</th>
        </tr>
        <?php foreach ($autores as $autor): ?>
        <tr>
            <td><?= htmlspecialchars($autor['nom_autor']) ?></td>
            <td><?= $autor['total_libros'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="reportes.php">← Volver a Reportes</a>
</body>
</html>
