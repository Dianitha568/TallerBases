<?php
session_start();
$db = new SQLite3('biblioteca.db');

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $db->prepare('SELECT * FROM TbUsuario WHERE usuario = :username AND contrasena = :password');
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$stmt->bindValue(':password', $password, SQLITE3_TEXT);

$result = $stmt->execute();
$user = $result->fetchArray(SQLITE3_ASSOC);

if ($user) {
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['tipo'] = $user['tipo'];

    // Redirigir según tipo de usuario
    if ($user['tipo'] === 'bibliotecario') {
        header('Location: menu_bibliotecario.php');
    } else {
        header('Location: menu_visitante.php');
    }
} else {
    echo "<script>alert('Credenciales incorrectas'); window.location.href = 'login.php';</script>";
}
?>