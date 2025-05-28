<?php
include 'conexion.php';

$busqueda = $_GET['buscar'] ?? '';
$sql = "SELECT * FROM Tblibro WHERE 
    titulo_libro LIKE :buscar OR 
    formato_libro LIKE :buscar OR 
    año_libro LIKE :buscar";
$stmt = $conexion->prepare($sql);
$stmt->execute(['buscar' => "%$busqueda%"]);
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2>Lista de Libros</h2>
        <div class="tabla-autores">
            <table>
                <thead>
                    <tr>
                        <th>Isbn</th>
                        <th>Titulo</th>
                        <th>Formato</th>
                        <th>Año Publicacion</th>
                        <th>Votos</th>
                        <th>Editorial</th>
                        <th>Disponibles</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        <th>Prestar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td><?= $autor['isbn'] ?></td>
                        <td><?= $autor['titulo_libro'] ?></td>
                        <td><?= $autor['formato_libro'] ?></td>
                        <td><?= $autor['año_libro'] ?></td>
                        <td><?= $autor['votos_libro'] ?></td>
                        <td><?= $autor['editorial'] ?></td>
                        <td><?= $autor['disponible'] ?></td>
                        <td>
                            <a href="modificar_libro.php?id=<?= $autor['isbn'] ?>" onclick="return confirm('¿Modificar este libro?')">Modificar</a>
                        </td>
                        <td>
                            <a href="eliminar_libro.php?id=<?= $autor['isbn'] ?>" onclick="return confirm('¿Eliminar este libro?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Agregar Nuevo Autor</h2>
        <div class="formulario">
            <form action="guardar_libro.php" method="post">
                <label>Titulo:
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
