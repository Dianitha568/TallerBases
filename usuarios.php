<?php
include 'conexion.php';

$busqueda = $_GET['buscar'] ?? '';
$sql = "SELECT * FROM TbUsuario WHERE 
    nombre_usuario LIKE :buscar OR 
    email_usuario LIKE :buscar OR 
    usuario LIKE :buscar OR 
    tipo LIKE :buscar";

$stmt = $conexion->prepare($sql);
$stmt->execute(['buscar' => "%$busqueda%"]);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/GestionUsuario.css">
</head>
<body>

<div class="container">
    <div class="butoneria">
        <a href="menu_bibliotecario.php" class="menu-button">Menu Bibliotecario</a>
    </div>
</div>

<div class="container">
    <h2>Gestión de Usuarios</h2>

    <form method="get">
        <input type="text" name="buscar" placeholder="Buscar usuario..." value="<?= htmlspecialchars($busqueda) ?>">
        <button type="submit">Buscar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($usuarios): ?>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['email_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['telefono_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['direccion_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['tipo']) ?></td>
                    <td><a href="modificar_usuario.php?id=<?= urlencode($usuario['id_usuario']) ?>">Modificar</a></td>
                    <td><a href="eliminar_usuario.php?id=<?= urlencode($usuario['id_usuario']) ?>" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="9">No se encontraron usuarios.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h3>Registrar Nuevo Usuario</h3>
    <form action="guardar_usuario.php" method="post">
        <label>Nombre:
            <input type="text" name="nombre_usuario" required>
        </label>
        <label>Email:
            <input type="email" name="email_usuario" required>
        </label>
        <label>Teléfono:
            <input type="text" name="telefono_usuario">
        </label>
        <label>Dirección:
            <input type="text" name="direccion_usuario">
        </label>
        <label>Usuario:
            <input type="text" name="usuario" required>
        </label>
        <label>Contraseña:
            <input type="password" name="contrasena" required>
        </label>
        <label>Tipo:
            <input type="text" name="tipo" placeholder="Ej: visitante o admin" required>
        </label>
        <button type="submit">Guardar</button>
    </form>
</div>
</body>
</html>
