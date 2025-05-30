<?php
include 'conexion.php';

// Obtener parámetro de búsqueda si existe
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta SQL con filtro de búsqueda
$sql = "SELECT * FROM Tblibro 
        WHERE titulo_libro LIKE :search 
        OR editorial LIKE :search 
        OR isbn LIKE :search
        ORDER BY titulo_libro";

$stmt = $conexion->prepare($sql);
$stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
$stmt->execute();
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Libros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/BASESDEDATOS/TallerBases-master/css/index.css">
    <style>
        /* Estilos adicionales para el buscador */
        .search-container {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }
        
        .search-input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 30px;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .search-input:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 2px 10px rgba(67, 97, 238, 0.2);
        }
        
        .search-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .search-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }
        
        .clear-btn {
            background: #f1f1f1;
            color: #555;
            border: none;
            padding: 12px 15px;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .clear-btn:hover {
            background: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Biblioteca Digital</h1>
            <a href="login.php" class="login-btn">
                <i class="fas fa-sign-in-alt"></i>
                Iniciar Sesión
            </a>
        </div>
        
        <h2>Catálogo de Libros</h2>
        
        <!-- Formulario de búsqueda -->
        <form method="GET" action="">
            <div class="search-container">
                <input type="text" 
                       name="search" 
                       class="search-input" 
                       placeholder="Buscar por título, editorial o ISBN..." 
                       value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Buscar
                </button>
                <?php if($search): ?>
                    <a href="?" class="clear-btn">Limpiar</a>
                <?php endif; ?>
            </div>
        </form>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Título</th>
                        <th>Formato</th>
                        <th>Año</th>
                        <th>Votos</th>
                        <th>Editorial</th>
                        <th>Disponibilidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($libros): ?>
                        <?php foreach ($libros as $libro): ?>
                        <tr>
                            <td><?= htmlspecialchars($libro['isbn']) ?></td>
                            <td><?= htmlspecialchars($libro['titulo_libro']) ?></td>
                            <td><?= htmlspecialchars($libro['formato_libro']) ?></td>
                            <td><?= htmlspecialchars($libro['año_libro']) ?></td>
                            <td><?= htmlspecialchars($libro['votos_libro']) ?></td>
                            <td><?= htmlspecialchars($libro['editorial']) ?></td>
                            <td class="<?= $libro['disponible'] ? 'disponible' : 'no-disponible' ?>">
                                <?= $libro['disponible'] ? 'Disponible' : 'No disponible' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="no-books">
                                <?= $search ? 'No se encontraron resultados para "'.htmlspecialchars($search).'"' : 'No se encontraron libros en el catálogo' ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>