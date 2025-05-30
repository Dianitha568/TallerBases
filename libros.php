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
        <a href="menu_bibliotecario.php" class="menu-button">Menu Bibliotecario</a>
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
                    <th>Modificar</th>
                    <th>Eliminar</th>
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
                        <td>
                            <a href="modificar_libro.php?id=<?= urlencode($libro['isbn']) ?>" onclick="return confirm('¿Modificar este libro?')">Modificar</a>
                        </td>
                        <td>
                            <a href="eliminar_libro.php?id=<?= urlencode($libro['isbn']) ?>" onclick="return confirm('¿Eliminar este libro?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9">No se encontraron libros.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <h2>Agregar Nuevo Libro</h2>
    <div class="formulario">
        <form action="guardar_libro.php" method="post">
            <label>Título:
                <input type="text" name="titulo_libro" required>
            </label>
            <label>Formato:
                <input type="text" name="formato_libro" required>
            </label>
            <label>Año:
                <input type="number" name="año_libro" required>
            </label>
            <label>Votos:
                <input type="number" name="votos_libro" required>
            </label>
            <label>Editorial:
                <input type="text" name="editorial" required>
            </label>
            <label>Disponible:
                <input type="number" name="disponible" required>
            </label>
            <button type="submit">Guardar</button>
        </form>
    </div>
</div>
</body>
</html>
