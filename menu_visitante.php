<?php
include 'conexion.php';

$busqueda = $_GET['buscar'] ?? '';
$sql = "SELECT * FROM Tblibro WHERE 
    titulo_libro LIKE :buscar OR 
    formato_libro LIKE :buscar OR 
    año_libro LIKE :buscar";
$stmt = $conexion->prepare($sql);
$stmt->execute(['buscar' => "%$busqueda%"]);
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros</title>
    <link rel="stylesheet" href="css/styles_autor.css">
</head>
<body>

<div class="container">
    <div class="butoneria">
        <a href="login.php" class="menu-button">inicio</a>
    </div>
</div>

<div class="container">
    <h2>Lista de Libros</h2>

    <!-- 🔍 Barra de búsqueda -->
    <form method="get" action="libros.php">
        <input type="text" name="buscar" placeholder="Buscar libros..." value="<?= htmlspecialchars($busqueda) ?>">
        <button type="submit">Buscar</button>
    </form>

    <div class="tabla-autores">
        <table>
            <thead>
                <tr>
                    <th>Isbn</th>
                    <th>Título</th>
                    <th>Formato</th>
                    <th>Año Publicación</th>
                    <th>Votos</th>
                    <th>Editorial</th>
                    <th>Disponibles</th>

                </tr>
            </thead>
            <tbody>
                <?php if ($libros): ?>
                    <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?= htmlspecialchars($libro['isbn']) ?></td>
                        <td><?= htmlspecialchars($libro['titulo_libro']) ?></td>
                        <td><?= htmlspecialchars($libro['formato_libro']) ?></td>
                        <td><?= htmlspecialchars($libro['año_libro']) ?></td>
                        <td><?= htmlspecialchars($libro['votos_libro']) ?></td>
                        <td><?= htmlspecialchars($libro['editorial']) ?></td>
                        <td><?= htmlspecialchars($libro['disponible']) ?></td>
                        
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9">No se encontraron libros.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
</div>
</body>
</html>
