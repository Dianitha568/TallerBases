<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['isbn']) || empty($_POST['titulo_libro']) || empty($_POST['formato_libro']) ||
        empty($_POST['año_libro']) || empty($_POST['votos_libro']) || empty($_POST['editorial']) ||
        empty($_POST['disponible'])) {
        echo "Faltan datos obligatorios.";
        exit;
    }

    $isbn = trim($_POST['isbn']);
    $titulo = trim($_POST['titulo_libro']);
    $formato = trim($_POST['formato_libro']);
    $anio = (int)$_POST['año_libro'];
    $votos = (int)$_POST['votos_libro'];
    $editorial = trim($_POST['editorial']);
    $disponible = (int)$_POST['disponible'];

    $sql = "UPDATE Tblibro SET 
        titulo_libro = :titulo, 
        formato_libro = :formato, 
        año_libro = :anio, 
        votos_libro = :votos, 
        editorial = :editorial, 
        disponible = :disponible 
        WHERE isbn = :isbn";

    try {
        $stmt = $conexion->prepare($sql);
        $resultado = $stmt->execute([
            'titulo' => $titulo,
            'formato' => $formato,
            'anio' => $anio,
            'votos' => $votos,
            'editorial' => $editorial,
            'disponible' => $disponible,
            'isbn' => $isbn
        ]);

        if ($resultado) {
            header("Location: libros.php?mensaje=actualizado");
            exit;
        } else {
            echo "Error al actualizar el libro.";
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Acceso no permitido.";
}
?>
