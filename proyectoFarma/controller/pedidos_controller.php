<?php

function home() {
    require_once("model/pedidos_model.php");
    $modelo = new Pedidos_model();
    $pedidos = $modelo->get_pedidos();
    require_once("view/pedidos_view.php");
}

function insertar() {
    require_once("model/pedidos_model.php");
    $modelo = new Pedidos_model();
    $mensaje = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datos = [
            'Estado' => $_POST['Estado'] ?? '',
            'ProductosFaltantes' => $_POST['ProductosFaltantes'] ?? '',
            'Observaciones' => $_POST['Observaciones'] ?? '',
            'Incidencias' => $_POST['Incidencias'] ?? '',
            'Seguimiento' => $_POST['Seguimiento'] ?? ''
        ];

        if ($modelo->insertar_pedido($datos)) {
            header("Location: index.php?controlador=pedidos&action=home");
            exit();
        } else {
            $mensaje = "Error al insertar el pedido.";
        }
    }

    require_once("view/pedido_form_view.php"); // formulario compartido
}

function editar() {
    require_once("model/pedidos_model.php");
    $modelo = new Pedidos_model();
    $mensaje = "";
    $IDPedido = $_GET['IDPedido'] ?? null;

    if (!$IDPedido) {
        header("Location: index.php?controlador=pedidos&action=home");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datos = [
            'Estado' => $_POST['Estado'] ?? '',
            'ProductosFaltantes' => $_POST['ProductosFaltantes'] ?? '',
            'Observaciones' => $_POST['Observaciones'] ?? '',
            'Incidencias' => $_POST['Incidencias'] ?? '',
            'Seguimiento' => $_POST['Seguimiento'] ?? ''
        ];

        if ($modelo->actualizar_pedido($IDPedido, $datos)) {
            header("Location: index.php?controlador=pedidos&action=home");
            exit();
        } else {
            $mensaje = "Error al actualizar el pedido.";
        }
    }

    $pedido = $modelo->get_pedido($IDPedido);
    require_once("view/pedido_form_view.php"); // mismo formulario
}

function eliminar() {
    require_once("model/pedidos_model.php");
    $modelo = new Pedidos_model();
    $IDPedido = $_GET['IDPedido'] ?? null;

    if ($IDPedido) {
        $modelo->eliminar_pedido($IDPedido);
    }

    header("Location: index.php?controlador=pedidos&action=home");
    exit();
}
