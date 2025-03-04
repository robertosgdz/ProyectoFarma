<?php
session_start();

function home()
{
    require_once("model/productos_model.php");
    $productoModel = new Productos_model();
    $message = "";

    if (isset($_POST["action"]) && $_POST["action"] == "eliminar") {
        $idProducto = isset($_POST["IDProducto"]) ? $_POST["IDProducto"] : "";
        if ($productoModel->eliminar_producto($idProducto)) {
            $_SESSION['message'] = "Producto borrado correctamente";
        } else {
            $_SESSION['message'] = "Error al borrar el producto";
        }
        // Redirigir a la misma página después de la acción
        header("Location: index.php");
        exit();
    }

    // Obtener productos actualizados
    $productos = $productoModel->get_productos();  
    require_once("view/productos_view.php");
}
