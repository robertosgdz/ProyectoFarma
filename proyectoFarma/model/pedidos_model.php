<?php
class Pedidos_model
{
    private $db;
    private $datos;

    public function __construct()
    {
        require_once("model/conectar.php");
        $this->db = Conectar::conexion();
        $this->datos = array();
    }

    public function get_pedidos()
    {
        $sql = "SELECT * FROM pedidos ORDER BY IDPedido DESC";
        $consulta = $this->db->query($sql);

        while ($registro = $consulta->fetch_assoc()) {
            $this->datos[] = $registro;
        }

        return $this->datos;
    }

    public function get_pedido($IDPedido)
    {
        $sql = "SELECT * FROM pedidos WHERE IDPedido = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $IDPedido);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function insertar_pedido($datos)
    {
        $sql = "INSERT INTO pedidos 
                (Estado, ProductosFaltantes, Observaciones, Incidencias, Seguimiento) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssss",
            $datos['Estado'],
            $datos['ProductosFaltantes'],
            $datos['Observaciones'],
            $datos['Incidencias'],
            $datos['Seguimiento']
        );

        return $stmt->execute();
    }

    public function actualizar_pedido($IDPedido, $datos)
    {
        $sql = "UPDATE pedidos SET 
                    Estado = ?, 
                    ProductosFaltantes = ?, 
                    Observaciones = ?, 
                    Incidencias = ?, 
                    Seguimiento = ?
                WHERE IDPedido = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssssi",
            $datos['Estado'],
            $datos['ProductosFaltantes'],
            $datos['Observaciones'],
            $datos['Incidencias'],
            $datos['Seguimiento'],
            $IDPedido
        );

        return $stmt->execute();
    }

    public function eliminar_pedido($IDPedido)
    {
        $sql = "DELETE FROM pedidos WHERE IDPedido = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $IDPedido);
        return $stmt->execute();
    }
}
?>
