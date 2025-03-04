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
?>