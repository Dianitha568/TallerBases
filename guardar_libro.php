<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="css/styles_autor.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Libros</h2>
        <form method="get" action="libros.php">
            <input type="text" name="buscar" placeholder="Buscar libro..." value="<?= htmlspecialchars($busqueda) ?>">
            <button type="submit">Buscar</button>
        </form>
        <div class="tabla-autores">
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Título</th>
                        <th>Formato</th>
                        <th>Año</th>
                        <th>Votos</th>
                        <th>Editorial</th>
                        <th>Disponible</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?= $libro['isbn'] ?></td>
                        <td><?= $libro['titulo_libro'] ?></td>
                        <td><?= $libro['formato_libro'] ?></td>
                        <td><?= $libro['año_libro'] ?></td>
                        <td><?= $libro['votos_libro'] ?></td>
                        <td><?= $libro['nombre_editorial'] ?></td>
                        <td><?= $libro['disponible'] ? 'Sí' : 'No' ?></td>
                        <td><a href="modificar_libro.php?isbn=<?= $libro['isbn'] ?>" onclick="return confirm('¿Modificar este libro?')">Modificar</a></td>
                        <td><a href="eliminar_libro.php?isbn=<?= $libro['isbn'] ?>" onclick="return confirm('¿Eliminar este libro?')">Eliminar</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Agregar Nuevo Libro</h2>
        <div class="formulario">
            <form action="guardar_libro.php" method="post">
                <label>ISBN:
                    <input type="text" name="isbn" required>
                </label>
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
                    <input type="number" name="votos_libro" value="0" required>
                </label>
                <label>Editorial:
                    <select name="editorial" required>
                        <?php foreach ($editoriales as $editorial): ?>
                        <option value="<?= $editorial['id_editorial'] ?>"><?= $editorial['nombre_editorial'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label>Disponible:
                    <select name="disponible">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </label>
                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>
</body>
</html>

