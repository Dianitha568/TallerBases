<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO TbUsuario (nombre_usuario, email_usuario, telefono_usuario, direccion_usuario, fecha_registro, usuario, contrasena, tipo)
            VALUES (:nombre, :email, :telefono, :direccion, datetime('now'), :usuario, :contrasena, :tipo)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        'nombre' => $_POST['nombre_usuario'],
        'email' => $_POST['email_usuario'],
        'telefono' => $_POST['telefono_usuario'],
        'direccion' => $_POST['direccion_usuario'],
        'usuario' => $_POST['usuario'],
        'contrasena' => $_POST['contrasena'],
        'tipo' => $_POST['tipo'],
    ]);

    header('Location: usuarios.php');
    exit;
}
