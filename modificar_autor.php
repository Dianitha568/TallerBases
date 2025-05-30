<?php
include 'conexion.php';

// Verificar si se recibió el ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de autor no especificado o inválido.";
    exit;
}

$id = (int)$_GET['id'];

// Obtener los datos del autor
$sql = "SELECT * FROM TbAutor WHERE id_autor = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id' => $id]);
$autor = $stmt->fetch(PDO::FETCH_ASSOC);

// Validar que exista el autor
if (!$autor) {
    echo "Autor no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Autor</title>
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/ModificarAutor.css">
</head>
<body>
    <div class="container">
        <h2>Modificar Autor</h2>
        <form action="actualizar_autor.php" method="post">
            <input type="hidden" name="id_autor" value="<?= htmlspecialchars($autor['id_autor']) ?>">

            <label>Nombre:
                <input type="text" name="nom_autor" value="<?= htmlspecialchars($autor['nom_autor']) ?>" required>
            </label>
            <label>País:
                <input type="text" name="pais_autor" value="<?= htmlspecialchars($autor['pais_autor']) ?>" required>
            </label>            
            <label>Email:
                <input type="email" name="email_autor" value="<?= htmlspecialchars($autor['email_autor']) ?>">
            </label>
            <label>Idioma:
                <input type="text" name="idioma_autor" value="<?= htmlspecialchars($autor['idioma_autor']) ?>" required>
            </label>
            <button type="submit">Actualizar</button>
        </form>
        <br>
        <a href="autores.php">Volver a la lista</a>
    </div>
</body>
</html>
