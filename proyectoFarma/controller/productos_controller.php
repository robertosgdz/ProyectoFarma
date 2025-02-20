<?php

//IMPLEMENTAR LOGICA
function home()
{
    require_once("model/productos_model.php");
    $productoModel = new Productos_model();
    $productos = $productoModel->get_productos(); // Obtenemos los productos

    require_once("view/productos_view.php"); // Ahora pasamos los productos a la vista
}