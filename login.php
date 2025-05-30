<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login Biblioteca</title>
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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