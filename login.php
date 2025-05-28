
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
