<?php
include 'conexion.php';

// Si se envió el formulario para guardar un nuevo libro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo'];
    $formato = $_POST['formato'];
    $paginas = $_POST['paginas'];
    $anio = $_POST['anio'];
    $votos = $_POST['votos'];
    $editorial_id = $_POST['editorial'];

    $sql_insert = "INSERT INTO libros (isbn, titulo, formato, paginas, año, votos, editorial) 
                   VALUES (:isbn, :titulo, :formato, :paginas, :anio, :votos, :editorial)";
    $stmt = $conexion->prepare($sql_insert);
    $stmt->execute([
        'isbn' => $isbn,
        'titulo' => $titulo,
        'formato' => $formato,
        'paginas' => $paginas,
        'anio' => $anio,
        'votos' => $votos,
        'editorial' => $editorial_id
    ]);
}

// Obtener los libros con el nombre de la editorial
$sql = "SELECT libros.*, editorial.nombre AS nombre_editorial 
        FROM libros 
        JOIN editorial ON libros.editorial = editorial.id";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener todas las editoriales para el select
$sql_editorial = "SELECT id, nombre FROM editorial";
$stmt_editorial = $conexion->prepare($sql_editorial);
$stmt_editorial->execute();
$editoriales = $stmt_editorial->fetchAll(PDO::FETCH_ASSOC);
?>

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
        <div class="tabla-autores">
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Título</th>
                        <th>Formato</th>
                        <th>Páginas</th>
                        <th>Año</th>
                        <th>Votos</th>
                        <th>Editorial</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?= $libro['isbn'] ?></td>
                        <td><?= $libro['titulo'] ?></td>
                        <td><?= $libro['formato'] ?></td>
                        <td><?= $libro['paginas'] ?></td>
                        <td><?= $libro['año'] ?></td>
                        <td><?= $libro['votos'] ?></td>
                        <td><?= $libro['nombre_editorial'] ?></td>
                        <td><a href="modificar_libro.php?isbn=<?= $libro['isbn'] ?>" onclick="return confirm('¿Modificar este libro?')">Modificar</a></td>
                        <td><a href="eliminar_libro.php?isbn=<?= $libro['isbn'] ?>" onclick="return confirm('¿Eliminar este libro?')">Eliminar</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Agregar Nuevo Libro</h2>
        <div class="formulario">
            <form action="libros.php" method="post">
                <label>ISBN:</label>
                <input type="number" name="isbn" required>

                <label>Título:</label>
                <input type="text" name="titulo" required>

                <label>Formato:</label>
                <input type="text" name="formato" required>

                <label>Páginas:</label>
                <input type="number" name="paginas">

                <label>Año:</label>
                <input type="number" name="anio" required>

                <label>Votos:</label>
                <input type="number" name="votos" required>

                <label>Editorial:</label>
                <select name="editorial" required>
                    <?php foreach ($editoriales as $editorial): ?>
                        <option value="<?= $editorial['id'] ?>"><?= $editorial['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>

                <br><br>
                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>
</body>
</html>
