<?php
session_start();
require_once("menu.php");

// Si el usuario no ha iniciado sesión, mostrar mensaje de aviso y detener la ejecución
if (!isset($_SESSION['nombre'])): ?>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
            <h2 class="text-center mb-3" style="color: #00bcd4;">Bienvenido a PFarma</h2>
            <p class="text-center mb-4">Para acceder a la gestión de pedidos, es necesario iniciar sesión con tu cuenta.</p>
            <div class="d-flex justify-content-center">
                <a href="index.php?controlador=usuarios&action=login" class="btn btn-info text-white">
                    Iniciar sesión
                </a>
            </div>
        </div>
    </div>
<?php return; endif; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gestión de Pedidos</h2>

    <div class="text-end mb-3">
        <a href="index.php?controlador=pedidos&action=insertar" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Añadir pedido
        </a>
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
                    <th>Acciones</th>
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
            'En proceso' => 'badge-estado-en-proceso',
            'Listo' => 'badge-estado-listo',
            default => 'bg-secondary text-white'
        };
    ?>
    <span style="background-color: <?= $estado === 'Listo' ? '#28a745' : ($estado === 'En proceso' ? '#ffc107' : '#6c757d') ?>; color: <?= $estado === 'Listo' ? '#fff' : '#000' ?>; padding: 0.4em 0.7em; border-radius: 0.5rem; font-weight: 600;">

        <?= $estado ?>
    </span>
</td>

                            <td><?= $pedido['ProductosFaltantes'] ?: '-' ?></td>
                            <td><?= $pedido['Observaciones'] ?: '-' ?></td>
                            <td><?= $pedido['Incidencias'] ?: '-' ?></td>
                            <td><?= $pedido['Seguimiento'] ?: '-' ?></td>
                            <td>
                                <a href="index.php?controlador=pedidos&action=editar&IDPedido=<?= $pedido['IDPedido'] ?>" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="index.php?controlador=pedidos&action=eliminar&IDPedido=<?= $pedido['IDPedido'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este pedido?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
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
