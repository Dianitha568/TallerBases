<?php
include 'conexion.php';

$sql = "SELECT u.nombre_usuario, COUNT(p.id_prestamo) AS total_prestamos
        FROM TbPrestamo p
        INNER JOIN TbUsuario u ON p.id_usuario = u.id_usuario
        GROUP BY u.id_usuario
        ORDER BY total_prestamos DESC
        LIMIT 10";

$resultado = $conexion->query($sql);
$usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/UsuariosPrestamos.css">
    <title>Usuarios con Más Préstamos</title>
</head>
<body>
    <div class="container">
    <h2>👤 Usuarios con Más Préstamos</h2>
    <table border="1">
        <tr>
            <th>Nombre Usuario</th>
            <th>Total Préstamos</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= htmlspecialchars($usuario['nombre_usuario']) ?></td>
            <td><?= $usuario['total_prestamos'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="reportes.php">← Volver a Reportes</a>
    </div>
</body>
</html>
