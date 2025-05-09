<?php
session_start(); // Necesario para acceder a la sesión

function home() {
    require_once("menu.php");

    if (isset($_SESSION['nombre'])) {
        // redirige al controlador de productos y a su acción 'home'
        header("Location: index.php?controlador=productos&action=home");
        exit();
    }

    require_once("view/home_view.php");
}
