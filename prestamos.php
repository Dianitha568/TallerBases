<?php
include 'conexion.php';

$busqueda = $_GET['buscar'] ?? '';

// Consulta base con búsqueda opcional
$sql = "SELECT 
            p.id_prestamo,
            l.isbn,
            l.titulo_libro,
            COALESCE(a.nom_autor, 'No asignado') AS nom_autor,
            u.nombre_usuario,
            p.fecha_prestamo,
            p.fecha_devolucion
        FROM TbPrestamo p
        INNER JOIN Tblibro l ON p.id_libro = l.isbn
        LEFT JOIN Tb_AutorLibro al ON al.libro_isbn = l.isbn
        LEFT JOIN TbAutor a ON al.autor_id = a.id_autor
        INNER JOIN TbUsuario u ON p.id_usuario = u.id_usuario
        WHERE l.titulo_libro LIKE :buscar OR
              a.nom_autor LIKE :buscar OR
              u.nombre_usuario LIKE :buscar";

$stmt = $conexion->prepare($sql);
$stmt->execute(['buscar' => "%$busqueda%"]);
$prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener libros
$sql_libros = "SELECT isbn, titulo_libro FROM Tblibro";
$stmt_libros = $conexion->query($sql_libros);
$libros = $stmt_libros->fetchAll(PDO::FETCH_ASSOC);

// Obtener usuarios
$sql_usuarios = "SELECT id_usuario, nombre_usuario FROM TbUsuario";
$stmt_usuarios = $conexion->query($sql_usuarios);
$usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Préstamos</title>
    <link rel="stylesheet" href="css/styles_prestamo.css">
</head>
<body>

<h1>Listado de Préstamos</h1>

<div class="container">
    <div class="butoneria">
        <a href="menu_bibliotecario.php" class="menu-button">Menu Bibliotecario</a>
    </div>
</div>

<!-- 🔍 Barra de búsqueda -->
<form method="get" action="prestamos.php">
    <input type="text" name="buscar" placeholder="Buscar por título, autor o usuario..." value="<?= htmlspecialchars($busqueda) ?>">
    <button type="submit">Buscar</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Usuario</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($prestamos): ?>
        <?php foreach ($prestamos as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['id_prestamo']) ?></td>
                <td><?= htmlspecialchars($p['isbn']) ?></td>
                <td><?= htmlspecialchars($p['titulo_libro']) ?></td>
                <td><?= htmlspecialchars($p['nom_autor']) ?></td>
                <td><?= htmlspecialchars($p['nombre_usuario']) ?></td>
                <td><?= htmlspecialchars($p['fecha_prestamo']) ?></td>
                <td><?= htmlspecialchars($p['fecha_devolucion']) ?></td>
                <td class="actions">
                    <a class="edit-btn" href="editar_prestamo.php?id=<?= urlencode($p['id_prestamo']) ?>">✏ Editar</a>
                    <a class="delete-btn" href="eliminar_prestamo.php?id=<?= urlencode($p['id_prestamo']) ?>" onclick="return confirm('¿Seguro que quieres eliminar este préstamo?')">🗑 Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="8">No hay préstamos registrados.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<h2>📚 Registrar Nuevo Préstamo</h2>
<form action="registrar_prestamo.php" method="POST">
    <label for="isbn">ISBN del Libro:</label>
    <input list="lista_libros" name="isbn" id="isbn" required>
    <datalist id="lista_libros">
        <?php foreach ($libros as $libro): ?>
            <option value="<?= $libro['isbn'] ?>"><?= htmlspecialchars($libro['titulo_libro']) ?></option>
        <?php endforeach; ?>
    </datalist>

    <label for="id_usuario">Usuario:</label>
    <input list="lista_usuarios" name="id_usuario" id="id_usuario" required>
    <datalist id="lista_usuarios">
        <?php foreach ($usuarios as $usuario): ?>
            <option value="<?= $usuario['id_usuario'] ?>"><?= htmlspecialchars($usuario['nombre_usuario']) ?></option>
        <?php endforeach; ?>
    </datalist>

    <label for="fecha_prestamo">Fecha Préstamo:</label>
    <input type="date" name="fecha_prestamo" required>

    <label for="fecha_devolucion">Fecha Devolución:</label>
    <input type="date" name="fecha_devolucion" required>

    <button type="submit">Registrar Préstamo</button>
</form>

</body>
</html>
