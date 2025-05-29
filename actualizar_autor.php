<?php
include 'conexion.php';

$id = $_POST['id_autor'];
$nombre = $_POST['nom_autor'];
$pais = $_POST['pais_autor'];
$fecha_nac = $_POST['fec_nac_autor'];
$email = $_POST['email_autor'];
$idioma = $_POST['idioma_autor'];

$sql = "UPDATE TbAutor 
        SET nom_autor = :nombre, 
            pais_autor = :pais, 
            fec_nac_autor = :fecha, 
            email_autor = :email, 
            idioma_autor = :idioma 
        WHERE id_autor = :id";

$stmt = $conexion->prepare($sql);
$resultado = $stmt->execute([
    'nombre' => $nombre,
    'pais' => $pais,
    'fecha' => $fecha_nac,
    'email' => $email,
    'idioma' => $idioma,
    'id' => $id
]);

if ($resultado) {
    echo "<script>alert('Autor actualizado correctamente'); window.location.href = 'autores.php';</script>";
} else {
    echo "Error al actualizar el autor.";
}
