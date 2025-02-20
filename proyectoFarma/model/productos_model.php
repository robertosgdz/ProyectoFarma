<?php
class Productos_model
{
    private $db; //se almacena la conexion a la bbdd
    private $datos; //datos que se selecionan

    public function __construct()
    {
        require_once("model/conectar.php"); 
        $this->db = Conectar::conexion(); 
        $this->datos = array();

    }

    public function get_productos()
    {
        $sql = "SELECT * FROM productos";
        $consulta = $this->db->query($sql);
        while ($registro = $consulta->fetch_assoc()) {
            $this->datos[] = $registro;
        }
        return $this->datos;
    }
}



?>