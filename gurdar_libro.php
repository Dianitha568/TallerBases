<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo'];
    $formato = $_POST['formato'];
    $paginas = $_POST['paginas'];
    $anio = $_POST['anio'];
    $votos = $_POST['votos'];
    $editorial = $_POST['editorial'];

    $sql = "INSERT INTO libros (isbn, titulo, formato, paginas, año, votos, editorial)
            VALUES (:isbn, :titulo, :formato, :paginas, :anio, :votos, :editorial)";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':formato', $formato);
    $stmt->bindParam(':paginas', $paginas);
    $stmt->bindParam(':anio', $anio);
    $stmt->bindParam(':votos', $votos);
    $stmt->bindParam(':editorial', $editorial);

    if ($stmt->execute()) {
        echo "Libro registrado con éxito.";
        // Puedes redirigir también:
        // header("Location: vistaLibros.php?mensaje=insertado");
    } else {
        echo "Error al registrar el libro.";
    }
}
?>
