<?php
require_once("menu.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="m-0 p-0">

<!-- Barra de búsqueda -->
<div class="container my-4">
    <form class="d-flex" action="" method="GET">
        <!-- Selector para elegir entre Producto, Marca o Categoría -->
        <select class="form-control me-2" name="search_type">
            <option value="producto" <?= isset($_GET['search_type']) && $_GET['search_type'] == 'producto' ? 'selected' : '' ?>>Buscar por Producto</option>
            <option value="marca" <?= isset($_GET['search_type']) && $_GET['search_type'] == 'marca' ? 'selected' : '' ?>>Buscar por Marca</option>
            <option value="categoria" <?= isset($_GET['search_type']) && $_GET['search_type'] == 'categoria' ? 'selected' : '' ?>>Buscar por Categoría</option>
        </select>
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" name="search">
        <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
    </form>
</div>

<div class="table-responsive">
<table class="table table-bordered table-responsive w-100">
    <thead class="table-light">
        <tr>
            <th>IDProducto</th>
            <th>Referencia</th>
            <th>Nombre</th>
            <th>Enlace</th>
            <th>EAN13</th>
            <th>Resumen</th>
            <th>Precio Sin Impuestos</th>
            <th>Precio Con Impuestos</th>
            <th>Precio Mayorista</th>
            <th>IDFiscal</th>
            <th>IDCategoria</th>
            <th>IDMarca</th>
            <th>Peso</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchTerm = strtolower($_GET['search']);
            $searchType = $_GET['search_type'] ?? 'producto';

            $productos = array_filter($productos, function($item) use ($searchTerm, $searchType) {
                switch ($searchType) {
                    case 'producto':
                        return stripos($item['Nombre'], $searchTerm) !== false;
                    case 'marca':
                        return stripos($item['IDMarca'], $searchTerm) !== false;
                    case 'categoria':
                        $categorias = array_map('trim', explode(',', $item['IDCategoria']));
                        return in_array($searchTerm, $categorias);
                    default:
                        return false;
                }
            });
        }

        foreach ($productos as $item) : ?>
            <tr>
                <td><?= htmlspecialchars($item['IDProducto']) ?></td>
                <td><?= htmlspecialchars($item['Referencia']) ?></td>
                <td><?= htmlspecialchars($item['Nombre']) ?></td>
                <td><a href="<?= htmlspecialchars($item['Enlace']) ?>" target="_blank">Ver Producto</a></td>
                <td><?= htmlspecialchars($item['EAN13']) ?></td>
                <td><?= htmlspecialchars($item['Resumen']) ?></td>
                <td><?= number_format($item['PrecioSinImpuestos'], 2) ?> €</td>
                <td><?= number_format($item['PrecioConImpuestos'], 2) ?> €</td>
                <td><?= number_format($item['PrecioMayorista'], 2) ?> €</td>
                <td><?= htmlspecialchars($item['IDFiscal']) ?></td>
                <td><?= htmlspecialchars($item['IDCategoria']) ?></td>
                <td><?= htmlspecialchars($item['IDMarca']) ?></td>
                <td><?= htmlspecialchars($item['Peso']) ?> kg</td>
                <td><img src="<?= htmlspecialchars($item['URLImagen']) ?>" alt="Imagen del producto" width="50"></td>
                <td>
                    <button class="btn btn-primary btn-sm">Editar</button>
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

</body>
</html>
