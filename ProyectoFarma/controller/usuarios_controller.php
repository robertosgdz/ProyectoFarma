<?php
session_start();

function desconectar(){
    session_destroy();
    header("Location: index.php");
}
function login(){
    require_once("model/usuarios_model.php");
    $datos = new Usuarios_model();
    $message="";
    if (!isset($_SESSION["nombre"])) {
        if(isset($_POST["submit"])){
         $nombre = isset($_POST["nombre"])?$_POST["nombre"]:'';
         $passwd = isset($_POST["passwd"])?$_POST["passwd"]:'';
         if ($datos->login($nombre,$passwd)){
             $_SESSION["nombre"] = $nombre;
             header("Location: index.php");
         }else{
             $message = "Usuario o contraseña incorrectos";
         }    
        }
     }
    require_once("view/login_view.php");
}
/*
function registro(){
    require_once("model/usuarios_model.php");
    $datos = new Usuarios_model();
    $message = "";

    if (isset($_POST["submit"])) {
        $nombre = $_POST["nombre"] ?? '';
        $passwd = $_POST["passwd"] ?? '';

        $resultado = $datos->registrar($nombre, $passwd);

        if ($resultado === "ok") {
            $message = "Usuario registrado correctamente. Puedes iniciar sesión.";
        } elseif ($resultado === "existe") {
            $message = "El nombre de usuario ya está en uso. Prueba con otro.";
        } else {
            $message = "Error al registrar usuario. Inténtalo más tarde.";
        }
    }

    require_once("view/registro_view.php");
}

*/
?>