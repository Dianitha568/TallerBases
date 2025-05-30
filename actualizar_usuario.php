<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['id_usuario']) || empty($_POST['nombre_usuario']) || empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['tipo'])) {
        echo "Faltan datos obligatorios.";
        exit;
    }

    $sql = "UPDATE TbUsuario SET 
            nombre_usuario = :nombre,
            email_usuario = :email,
            telefono_usuario = :telefono,
            direccion_usuario = :direccion,
            usuario = :usuario,
            contrasena = :contrasena,
            tipo = :tipo
            WHERE id_usuario = :id";

    $stmt = $conexion->prepare($sql);
    $resultado = $stmt->execute([
        'nombre' => trim($_POST['nombre_usuario']),
        'email' => trim($_POST['email_usuario']),
        'telefono' => trim($_POST['telefono_usuario']),
        'direccion' => trim($_POST['direccion_usuario']),
        'usuario' => trim($_POST['usuario']),
        'contrasena' => trim($_POST['contrasena']),
        'tipo' => trim($_POST['tipo']),
        'id' => (int)$_POST['id_usuario'],
    ]);

    if ($resultado) {
        header('Location: usuarios.php?mensaje=actualizado');
        exit;
    } else {
        echo "Error al actualizar el usuario.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
