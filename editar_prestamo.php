<?php
include 'conexion.php';

// Validar ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de préstamo no válido.";
    exit;
}
$id = (int)$_GET['id'];

// Obtener préstamo
$sql = "SELECT * FROM TbPrestamo WHERE id_prestamo = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id' => $id]);
$prestamo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$prestamo) {
    echo "Préstamo no encontrado.";
    exit;
}

// Obtener libros y usuarios para los datalist
$libros = $conexion->query("SELECT isbn, titulo_libro FROM Tblibro")->fetchAll(PDO::FETCH_ASSOC);
$usuarios = $conexion->query("SELECT id_usuario, nombre_usuario FROM TbUsuario")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Préstamo</title>
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/Prestamo.css">
</head>
<body>
    <div class="container">
        <h2>Editar Préstamo</h2>
        <form action="actualizar_prestamo.php" method="post">
            <input type="hidden" name="id_prestamo" value="<?= htmlspecialchars($prestamo['id_prestamo']) ?>">

            <label>ISBN del Libro:
                <input list="lista_libros" name="isbn" value="<?= htmlspecialchars($prestamo['id_libro']) ?>" required>
                <datalist id="lista_libros">
                    <?php foreach ($libros as $libro): ?>
                        <option value="<?= $libro['isbn'] ?>"><?= htmlspecialchars($libro['titulo_libro']) ?></option>
                    <?php endforeach; ?>
                </datalist>
            </label>

            <label>Usuario:
                <input list="lista_usuarios" name="id_usuario" value="<?= htmlspecialchars($prestamo['id_usuario']) ?>" required>
                <datalist id="lista_usuarios">
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id_usuario'] ?>"><?= htmlspecialchars($usuario['nombre_usuario']) ?></option>
                    <?php endforeach; ?>
                </datalist>
            </label>

            <label>Fecha Préstamo:
                <input type="date" name="fecha_prestamo" value="<?= htmlspecialchars($prestamo['fecha_prestamo']) ?>" required>
            </label>
            <label>Fecha Devolución:
                <input type="date" name="fecha_devolucion" value="<?= htmlspecialchars($prestamo['fecha_devolucion']) ?>" required>
            </label>
            <button type="submit">Actualizar</button>
        </form>
        <br>
        <a href="prestamos.php" class="menu-button">Volver a la lista</a>
    </div>
</body>
</html>
