<?php
include 'conexion.php';
$autores = $conexion->query("SELECT * FROM Autor")->fetchAll(PDO::FETCH_ASSOC);

$busqueda = $_GET['buscar'] ?? '';
$sql = "SELECT * FROM autor WHERE 
    nombre LIKE :buscar OR 
    pais LIKE :buscar OR 
    idioma LIKE :buscar";
$stmt = $conexion->prepare($sql);
$stmt->execute(['buscar' => "%$busqueda%"]);
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Biblioteca</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>


   <div class="login-container">
        <h1>Inicio de Sesión </h1>
       <h2>Biblioteca</h2>

        <form method="post" action="validar_login.php">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Ingresar">
        </form>
    </div>


</body>
</html>
