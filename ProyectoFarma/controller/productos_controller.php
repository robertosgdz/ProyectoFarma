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

function insertar()
{
    require_once("model/productos_model.php");
    $productoModel = new Productos_model();
    $mensaje = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Recoger los datos del formulario
        $datos = [
            'Referencia' => $_POST['Referencia'] ?? '',
            'Nombre' => $_POST['Nombre'] ?? '',
            'Enlace' => $_POST['Enlace'] ?? '',
            'EAN13' => $_POST['EAN13'] ?? '',
            'Resumen' => $_POST['Resumen'] ?? '',
            'PrecioSinImpuestos' => $_POST['PrecioSinImpuestos'] ?? 0,
            'PrecioConImpuestos' => $_POST['PrecioConImpuestos'] ?? 0,
            'PrecioMayorista' => $_POST['PrecioMayorista'] ?? 0,
            'IDFiscal' => $_POST['IDFiscal'] ?? '',
            'IDCategoria' => $_POST['IDCategoria'] ?? '',
            'IDMarca' => $_POST['IDMarca'] ?? '',
            'Peso' => $_POST['Peso'] ?? 0,
            'URLImagen' => $_POST['URLImagen'] ?? ''
        ];

        if ($productoModel->insertar_producto($datos)) {
            $_SESSION['message'] = "Producto insertado correctamente";
            header("Location: index.php?controlador=productos&action=home");
            exit();
        } else {
            $mensaje = "Error al insertar el producto";
        }
    }

    // Mostrar el formulario de inserción
    require_once("view/producto_form_view.php");
}
