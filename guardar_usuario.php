<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['nombre_usuario']) || empty($_POST['email_usuario']) || empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['tipo'])) {
        echo "Faltan datos obligatorios.";
        exit;
    }

    $nombre = trim($_POST['nombre_usuario']);
    $email = trim($_POST['email_usuario']);
    $telefono = trim($_POST['telefono_usuario']);
    $direccion = trim($_POST['direccion_usuario']);
    $usuario = trim($_POST['usuario']);
    $contrasena = password_hash(trim($_POST['contrasena']), PASSWORD_DEFAULT);  // hasheo seguro
    $tipo = trim($_POST['tipo']);

    $sql = "INSERT INTO TbUsuario (nombre_usuario, email_usuario, telefono_usuario, direccion_usuario, fecha_registro, usuario, contrasena, tipo)
            VALUES (:nombre, :email, :telefono, :direccion, datetime('now'), :usuario, :contrasena, :tipo)";
    
    $stmt = $conexion->prepare($sql);
    $resultado = $stmt->execute([
        'nombre' => $nombre,
        'email' => $email,
        'telefono' => $telefono,
        'direccion' => $direccion,
        'usuario' => $usuario,
        'contrasena' => $contrasena,
        'tipo' => $tipo,
    ]);

    if ($resultado) {
        header('Location: usuarios.php?mensaje=guardado');
        exit;
    } else {
        echo "Error al guardar el usuario.";
    }
}
?>
