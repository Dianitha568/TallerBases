<?php
include 'conexion.php';
$autores = $conexion->query("SELECT * FROM Autor")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>visistante</title>
</head>
<body>
    <h2>Bienvenido Visitante</h2>

</body>
</html>
