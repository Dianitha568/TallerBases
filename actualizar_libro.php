<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo_libro'];
    $formato = $_POST['formato_libro'];
    $anio = $_POST['año_libro'];
    $votos = $_POST['votos_libro'];
    $editorial = $_POST['editorial'];
    $disponible = $_POST['disponible'];

    $sql = "UPDATE Tblibro SET 
        titulo_libro = :titulo, 
        formato_libro = :formato, 
        año_libro = :anio, 
        votos_libro = :votos, 
        editorial = :editorial, 
        disponible = :disponible 
        WHERE isbn = :isbn";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        'titulo' => $titulo,
        'formato' => $formato,
        'anio' => $anio,
        'votos' => $votos,
        'editorial' => $editorial,
        'disponible' => $disponible,
        'isbn' => $isbn
    ]);

    header("Location: libros.php");
    exit;
} else {
    echo "Acceso no permitido.";
}
