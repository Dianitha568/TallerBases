<?php
include 'conexion.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    echo "ID no válido";
    exit;
}

$sql = "SELECT * FROM TbUsuario WHERE id_usuario = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/ModificarUsuario.css">
</head>
<body>
    <div class="container">
        <h2>Modificar Usuario</h2>
        <form action="actualizar_usuario.php" method="post">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">
            
            <label>Nombre:
                <input type="text" name="nombre_usuario" value="<?= htmlspecialchars($usuario['nombre_usuario']) ?>" required>
            </label>
            <label>Email:
                <input type="email" name="email_usuario" value="<?= htmlspecialchars($usuario['email_usuario']) ?>" required>
            </label>
            <label>Teléfono:
                <input type="text" name="telefono_usuario" value="<?= htmlspecialchars($usuario['telefono_usuario']) ?>">
            </label>
            <label>Dirección:
                <input type="text" name="direccion_usuario" value="<?= htmlspecialchars($usuario['direccion_usuario']) ?>">
            </label>
            <label>Usuario:
                <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>
            </label>
            <label>Contraseña:
                <input type="password" name="contrasena" value="<?= htmlspecialchars($usuario['contrasena']) ?>" required>
            </label>
            <label>Tipo:
                <input type="text" name="tipo" value="<?= htmlspecialchars($usuario['tipo']) ?>" required>
            </label>

            <button type="submit">Actualizar</button>
        </form>
        <br>
        <a href="usuarios.php">← Volver</a>
    </div>
</body>
</html>
