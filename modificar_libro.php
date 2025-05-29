<?php
include 'conexion.php';

// Validar si se recibió un ISBN
if (!isset($_GET['id'])) {
    echo "ID de libro no proporcionado.";
    exit;
}

$isbn = $_GET['id'];

// Consultar el libro existente
$sql = "SELECT * FROM Tblibro WHERE isbn = :isbn";
$stmt = $conexion->prepare($sql);
$stmt->execute(['isbn' => $isbn]);
$libro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$libro) {
    echo "Libro no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Libro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Modificar Libro</h2>
        <form action="actualizar_libro.php" method="post">
            <input type="hidden" name="isbn" value="<?= $libro['isbn'] ?>">
            
            <label>Título:
                <input type="text" name="titulo_libro" value="<?= htmlspecialchars($libro['titulo_libro']) ?>" required>
            </label>
            <label>Formato:
                <input type="text" name="formato_libro" value="<?= htmlspecialchars($libro['formato_libro']) ?>" required>
            </label>
            <label>Año:
                <input type="number" name="año_libro" value="<?= $libro['año_libro'] ?>" required>
            </label>
            <label>Votos:
                <input type="number" name="votos_libro" value="<?= $libro['votos_libro'] ?>" required>
            </label>
            <label>Editorial:
                <input type="text" name="editorial" value="<?= htmlspecialchars($libro['editorial']) ?>" required>
            </label>
            <label>Disponibles:
                <input type="number" name="disponible" value="<?= $libro['disponible'] ?>" required>
            </label>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
