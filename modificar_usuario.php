<?php
include 'conexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID no válido";
    exit;
}

$sql = "SELECT * FROM TbUsuario WHERE id_usuario = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="../css/styles_autor.css">
</head>
<body>
    <div class="container">
        <h2>Modificar Usuario</h2>
        <form action="actualizar_usuario.php" method="post">
            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
            
            <label>Nombre:
                <input type="text" name="nombre_usuario" value="<?= $usuario['nombre_usuario'] ?>" required>
            </label>
            <label>Email:
                <input type="email" name="email_usuario" value="<?= $usuario['email_usuario'] ?>" required>
            </label>
            <label>Teléfono:
                <input type="text" name="telefono_usuario" value="<?= $usuario['telefono_usuario'] ?>">
            </label>
            <label>Dirección:
                <input type="text" name="direccion_usuario" value="<?= $usuario['direccion_usuario'] ?>">
            </label>
            <label>Usuario:
                <input type="text" name="usuario" value="<?= $usuario['usuario'] ?>" required>
            </label>
            <label>Contraseña:
                <input type="text" name="contrasena" value="<?= $usuario['contrasena'] ?>" required>
            </label>
            <label>Tipo:
                <input type="text" name="tipo" value="<?= $usuario['tipo'] ?>" required>
            </label>

            <button type="submit">Actualizar</button>
        </form>
        <br>
        <a href="usuarios.php">← Volver</a>
    </div>
</body>
</html>
