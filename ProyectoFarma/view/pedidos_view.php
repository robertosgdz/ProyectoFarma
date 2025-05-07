<?php
session_start();
require_once("menu.php");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gestión de Pedidos</h2>

    <div class="text-end mb-3">
    <?php if (isset($_SESSION['nombre'])): ?>
    <a href="index.php?controlador=pedidos&action=insertar" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Añadir pedido
    </a>
<?php endif; ?>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Nº Pedido</th>
                    <th>Estado</th>
                    <th>Productos faltantes</th>
                    <th>Observaciones</th>
                    <th>Incidencias</th>
                    <th>Seguimiento</th>
                    <?php if (isset($_SESSION['nombre'])): ?>
    <th>Acciones</th>
<?php endif; ?>

                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pedidos)): ?>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido['IDPedido'] ?></td>
                            <td>
                                <?php
                                    $estado = $pedido['Estado'];
                                    $clase = match($estado) {
                                        'Servido - Farmacia' => 'success',
                                        'Sirve MBE Molina' => 'warning text-dark',
                                        default => 'secondary'
                                    };
                                ?>
                                <span class="badge bg-<?= $clase ?>">
                                    <?= $estado ?>
                                </span>
                            </td>
                            <td><?= $pedido['ProductosFaltantes'] ?: '-' ?></td>
                            <td><?= $pedido['Observaciones'] ?: '-' ?></td>
                            <td><?= $pedido['Incidencias'] ?: '-' ?></td>
                            <td><?= $pedido['Seguimiento'] ?: '-' ?></td>
                            <?php if (isset($_SESSION['nombre'])): ?>
                            <td>
                                <a href="index.php?controlador=pedidos&action=editar&IDPedido=<?= $pedido['IDPedido'] ?>" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="index.php?controlador=pedidos&action=eliminar&IDPedido=<?= $pedido['IDPedido'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este pedido?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay pedidos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
