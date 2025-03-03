<?php
require_once("menu.php");
require_once("model/productos_model.php");

if (!isset($_GET['IDProducto']) || !is_numeric($_GET['IDProducto'])) {
    die("ID de producto inválido.");
}

$productoModel = new Productos_model();
$producto = $productoModel->get_producto($_GET['IDProducto']);

if (!$producto) {
    die("Producto no encontrado.");
}

$mensaje = '';  // Variable para el mensaje a mostrar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datosActualizados = [
        'Referencia' => $_POST['Referencia'],
        'Nombre' => $_POST['Nombre'],
        'Enlace' => $_POST['Enlace'],
        'EAN13' => $_POST['EAN13'],
        'Resumen' => $_POST['Resumen'],
        'PrecioSinImpuestos' => $_POST['PrecioSinImpuestos'],
        'PrecioConImpuestos' => $_POST['PrecioConImpuestos'],
        'PrecioMayorista' => $_POST['PrecioMayorista'],
        'IDFiscal' => $_POST['IDFiscal'],
        'IDMarca' => $_POST['IDMarca'],
        'Peso' => $_POST['Peso'],
        'URLImagen' => $_POST['URLImagen']
    ];

    if ($productoModel->actualizar_producto($_GET['IDProducto'], $datosActualizados)) {
        $mensaje = "Producto actualizado correctamente";
        $tipoMensaje = "success";
        echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 1000);</script>";  // Redirige después de 1 segundo
    } else {
        $mensaje = "Error al actualizar el producto";
        $tipoMensaje = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/editarCss.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="m-0 p-0">
    <br>
    <h2>Editar Producto</h2>
    <form method="POST">
        <label>Referencia:</label>
        <input type="text" name="Referencia" value="<?= htmlspecialchars($producto['Referencia']) ?>" required><br>

        <label>Nombre:</label>
        <input type="text" name="Nombre" value="<?= htmlspecialchars($producto['Nombre']) ?>" required><br>

        <label>Enlace:</label>
        <input type="url" name="Enlace" value="<?= htmlspecialchars($producto['Enlace']) ?>"><br>

        <label>EAN13:</label>
        <input type="text" name="EAN13" value="<?= htmlspecialchars($producto['EAN13']) ?>"><br>

        <label>Resumen:</label>
        <textarea name="Resumen"><?= htmlspecialchars($producto['Resumen']) ?></textarea><br>

        <label>Precio Sin Impuestos:</label>
        <input type="number" step="0.01" name="PrecioSinImpuestos" value="<?= htmlspecialchars($producto['PrecioSinImpuestos']) ?>" required><br>

        <label>Precio Con Impuestos:</label>
        <input type="number" step="0.01" name="PrecioConImpuestos" value="<?= htmlspecialchars($producto['PrecioConImpuestos']) ?>" required><br>

        <label>Precio Mayorista:</label>
        <input type="number" step="0.01" name="PrecioMayorista" value="<?= htmlspecialchars($producto['PrecioMayorista']) ?>" required><br>

        <label>ID Fiscal:</label>
        <input type="text" name="IDFiscal" value="<?= htmlspecialchars($producto['IDFiscal']) ?>"><br>

        <label>ID Marca:</label>
        <input type="text" name="IDMarca" value="<?= htmlspecialchars($producto['IDMarca']) ?>"><br>

        <label>Peso:</label>
        <input type="number" step="0.01" name="Peso" value="<?= htmlspecialchars($producto['Peso']) ?>"><br>

        <label>Imagen URL:</label>
        <input type="text" name="URLImagen" value="<?= htmlspecialchars($producto['URLImagen']) ?>"><br>

        <button type="submit">Guardar Cambios</button>
        <a href="index.php">Cancelar</a>
    </form>

    <!-- Notificación -->
    <?php if ($mensaje): ?>
        <div class="notification <?= $tipoMensaje ?>">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar la notificación
        const notification = document.querySelector('.notification');
        if (notification) {
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);  // Se desvanece después de 3 segundos
        }
    </script>
</body>
</html>
