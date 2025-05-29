<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $stmt->execute([
        'nombre' => $_POST['nombre_usuario'],
        'email' => $_POST['email_usuario'],
        'telefono' => $_POST['telefono_usuario'],
        'direccion' => $_POST['direccion_usuario'],
        'usuario' => $_POST['usuario'],
        'contrasena' => $_POST['contrasena'],
        'tipo' => $_POST['tipo'],
        'id' => $_POST['id_usuario'],
    ]);

    header('Location: usuarios.php');
    exit;
}
