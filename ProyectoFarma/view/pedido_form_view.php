<?php
session_start();
require_once("menu.php");

$esEdicion = isset($pedido);
$action = $esEdicion ? "editar&IDPedido={$pedido['IDPedido']}" : "insertar";
$titulo = $esEdicion ? "Editar Pedido #{$pedido['IDPedido']}" : "Nuevo Pedido";
?>

<div class="container mt-5">
    <h2 class="text-center mb-4"><?= $titulo ?></h2>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-danger text-center"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?controlador=pedidos&action=<?= $action ?>">
        <div class="mb-3">
            <!-- Campo select para Estado -->
            <label for="Estado">Estado</label>
<select name="Estado" id="Estado" class="form-control" required>
    <option value="En proceso" <?= (isset($pedido['Estado']) && $pedido['Estado'] === 'En proceso') ? 'selected' : '' ?>>En proceso</option>
    <option value="Listo" <?= (isset($pedido['Estado']) && $pedido['Estado'] === 'Listo') ? 'selected' : '' ?>>Listo</option>
</select>


        </div>

        <div class="mb-3">
            <label for="ProductosFaltantes" class="form-label">Productos faltantes</label>
            <textarea class="form-control" id="ProductosFaltantes" name="ProductosFaltantes" rows="1"><?= $pedido['ProductosFaltantes'] ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="Observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="Observaciones" name="Observaciones" rows="1"><?= $pedido['Observaciones'] ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="Incidencias" class="form-label">Incidencias</label>
            <textarea class="form-control" id="Incidencias" name="Incidencias" rows="1"><?= $pedido['Incidencias'] ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="Seguimiento" class="form-label">Seguimiento</label>
            <textarea class="form-control" id="Seguimiento" name="Seguimiento" rows="1"><?= $pedido['Seguimiento'] ?? '' ?></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Guardar
            </button>
            <a href="index.php?controlador=pedidos&action=home" class="btn btn-secondary ms-2">
                <i class="bi bi-arrow-left-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>
