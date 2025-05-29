<?php
include 'conexion.php';


$busqueda = $_GET['buscar'] ?? '';
$sql = "SELECT * FROM TbAutor WHERE 
    nom_autor LIKE :buscar OR 
    pais_autor LIKE :buscar OR 
    idioma_autor LIKE :buscar";
$stmt = $conexion->prepare($sql);
$stmt->execute(['buscar' => "%$busqueda%"]);
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autores</title>
    <link rel="stylesheet" href="css/styles_autor.css">
</head>
<body>

    <div class="container">
        <div class="butoneria">
            <a href="menu_bibliotecario.php" class="menu-button">Menu Bibliotecario</a>
        </div>
    </div>

    <div class="container">
        <h2>Lista de Autores</h2>
        <div class="tabla-autores">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>País</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Email</th>
                        <th>Idioma</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        <th>Prestar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td><?= $autor['id_autor'] ?></td>
                        <td><?= $autor['nom_autor'] ?></td>
                        <td><?= $autor['pais_autor'] ?></td>
                        <td><?= $autor['fec_nac_autor'] ?></td>
                        <td><?= $autor['email_autor'] ?></td>
                        <td><?= $autor['idioma_autor'] ?></td>
                        <td>
                            <a href="modificar_autor.php?id=<?= $autor['id_autor'] ?>" onclick="return confirm('¿Modificar este autor?')">Modificar</a>
                        </td>
                        <td>
                            <a href="eliminar_autor.php?id=<?= $autor['id_autor'] ?>" onclick="return confirm('¿Eliminar este autor?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
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
                <label>Fecha de Nacimiento:
                    <input type="date" name="fec_nac_autor" required>
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
