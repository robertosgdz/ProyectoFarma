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
}



?>