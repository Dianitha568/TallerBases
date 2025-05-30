<?php
include 'conexion.php';

$busqueda = $_GET['buscar'] ?? '';
$sql = "SELECT * FROM TbAutor WHERE 
    nom_autor LIKE :buscar OR 
    pais_autor LIKE :buscar OR 
    idioma_autor LIKE :buscar OR 
    email_autor LIKE :buscar";
$stmt = $conexion->prepare($sql);
$stmt->execute(['buscar' => "%$busqueda%"]);
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Autores</title>
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/AutoresLista.css">

</head>

<body>

    <div class="container">
        <div class="butoneria">
            <a href="menu_bibliotecario.php" class="menu-button">Menu Bibliotecario</a>
        </div>
    </div>

    <div class="container">
        <h2>Lista de Autores</h2>

        <!-- 🔍 Barra de búsqueda -->
        <form method="get" action="autores.php">
            <input type="text" name="buscar" placeholder="Buscar autores..." value="<?= htmlspecialchars($busqueda) ?>">
            <button type="submit">Buscar</button>
        </form>

        <div class="tabla-autores">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>País</th>
                        <th>Email</th>
                        <th>Idioma</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                // ... (código PHP anterior) ...
                <tbody>
                    <?php if ($autores): ?>
                        <?php foreach ($autores as $autor): ?>
                            <tr>
                                <td data-label="ID"><?= htmlspecialchars($autor['id_autor']) ?></td>
                                <td data-label="Nombre"><?= htmlspecialchars($autor['nom_autor']) ?></td>
                                <td data-label="País"><?= htmlspecialchars($autor['pais_autor']) ?></td>
                                <td data-label="Email"><?= htmlspecialchars($autor['email_autor']) ?></td>
                                <td data-label="Idioma"><?= htmlspecialchars($autor['idioma_autor']) ?></td>
                                <td data-label="Modificar">
                                    <a href="modificar_autor.php?id=<?= urlencode($autor['id_autor']) ?>" onclick="return confirm('¿Modificar este autor?')">Modificar</a>
                                </td>
                                <td data-label="Eliminar">
                                    <a href="eliminar_autor.php?id=<?= urlencode($autor['id_autor']) ?>" onclick="return confirm('¿Eliminar este autor?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No se encontraron autores.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                // ... (código PHP posterior) ...
            </table>
        </div>

        <h2>Agregar Nuevo Autor</h2>
        <div class="formulario">
            <form action="guardar_autor.php" method="post">
                <label>Nombre:
                    <input type="text" name="nom_autor" required>
                </label>
                <label>País:
                    <input type="text" name="pais_autor" required>
                </label>
                <label>Email:
                    <input type="email" name="email_autor">
                </label>
                <label>Idioma:
                    <input type="text" name="idioma_autor" required>
                </label>
                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>
</body>

</html>