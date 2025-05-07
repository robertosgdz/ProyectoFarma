<?php
class Usuarios_model{
    private $db; //conexion con la BBDD
    private $datos; //array de datos de la bbdd
    public function __construct(){
        require_once("model/conectar.php");
        $this->db = Conectar::conexion();
        $this->datos = [];
    }

    public function login($nombre,$passwd){
        $sql="SELECT * FROM usuarios WHERE nombre='$nombre' and passwd='$passwd'";
        $consulta= $this->db->query($sql);
        return (mysqli_num_rows($consulta)>0);
    }

    public function registrar($nombre, $passwd){
        $nombre = $this->db->real_escape_string($nombre);
        $passwd = $this->db->real_escape_string($passwd);
    
        // Comprobar si el nombre ya existe
        $sql_check = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
        $resultado = $this->db->query($sql_check);
    
        if ($resultado && $resultado->num_rows > 0) {
            return "existe"; // Usuario ya existe
        }
    
        // Insertar nuevo usuario
        $sql_insert = "INSERT INTO usuarios (nombre, passwd) VALUES ('$nombre', '$passwd')";
        if ($this->db->query($sql_insert)) {
            return "ok";
        } else {
            return "error"; // Fallo al insertar
        }
    }
    
}



?>