<?php
class Productos_model
{
    private $db; // Se almacena la conexión a la base de datos
    private $datos; // Datos seleccionados

    public function __construct()
    {
        require_once("model/conectar.php"); 
        $this->db = Conectar::conexion(); 
        $this->datos = array();
    }
    public function get_productos()
{
    // Realizamos un JOIN con la tabla 'categoria' para obtener los nombres de las categorías
    // y un JOIN con la tabla 'marca' para obtener el nombre de la marca
    $sql = "SELECT p.*, 
                   GROUP_CONCAT(c.NombreCategoria SEPARATOR ', ') AS categorias, 
                   m.NombreMarca
            FROM productos p
            LEFT JOIN categoria c ON FIND_IN_SET(c.IDCategoria, p.IDCategoria) > 0
            LEFT JOIN marca m ON p.IDMarca = m.IDMarca
            GROUP BY p.IDProducto"; // Usamos GROUP_CONCAT para concatenar las categorías por producto
    $consulta = $this->db->query($sql);
    
    while ($registro = $consulta->fetch_assoc()) {
        $this->datos[] = $registro;
    }
    return $this->datos;
}
public function eliminar_producto($IDProducto)
{
    // Verificar si $IDProducto está presente y es un número válido
    if (empty($IDProducto) || !is_numeric($IDProducto)) {
        return false; // Si el ID no es válido, no eliminar
    }

    // Consulta para eliminar el producto de la base de datos
    $sql = "DELETE FROM productos WHERE IDProducto = ?";

    try {
        // Preparar la consulta
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta SQL");
        }

        // Vincular el parámetro
        $stmt->bind_param("i", $IDProducto);  // 'i' para un entero
        $stmt->execute();  // Ejecutar la consulta

        // Verificar si la eliminación fue exitosa
        if ($stmt->affected_rows > 0) {
            return true;  // Producto eliminado
        } else {
            return false;  // No se eliminó ningún producto (puede ser que el producto no exista)
        }
    } catch (Exception $e) {
        // Captura cualquier error y lo devuelve
        error_log("Error al eliminar producto: " . $e->getMessage());
        return false;
    }
}
public function get_producto($IDProducto)
{
    $sql = "SELECT * FROM productos WHERE IDProducto = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $IDProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
}
public function actualizar_producto($IDProducto, $datos)
{
    // Verificamos si los datos son válidos
    if (empty($IDProducto) || !is_numeric($IDProducto) || empty($datos)) {
        return false;
    }

    // Preparamos la consulta SQL de actualización
    $sql = "UPDATE productos SET
                Referencia = ?, 
                Nombre = ?, 
                Enlace = ?, 
                EAN13 = ?, 
                Resumen = ?, 
                PrecioSinImpuestos = ?, 
                PrecioConImpuestos = ?, 
                PrecioMayorista = ?, 
                IDFiscal = ?, 
                IDCategoria = ?, 
                IDMarca = ?, 
                Peso = ?, 
                URLImagen = ?
            WHERE IDProducto = ?";

    try {
        // Preparamos la consulta
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta SQL");
        }

        // Vinculamos los parámetros
        $stmt->bind_param("sssssssssssssi", 
            $datos['Referencia'], 
            $datos['Nombre'], 
            $datos['Enlace'], 
            $datos['EAN13'], 
            $datos['Resumen'], 
            $datos['PrecioSinImpuestos'], 
            $datos['PrecioConImpuestos'], 
            $datos['PrecioMayorista'], 
            $datos['IDFiscal'], 
            $datos['IDCategoria'], 
            $datos['IDMarca'], 
            $datos['Peso'], 
            $datos['URLImagen'], 
            $IDProducto
        );

        // Ejecutar la consulta
        $stmt->execute();

        // Verificamos si se actualizó algún registro
        if ($stmt->affected_rows > 0) {
            return true;  // Actualización exitosa
        } else {
            return false;  // No se actualizó nada (puede ser que los datos no hayan cambiado)
        }
    } catch (Exception $e) {
        // Capturamos errores
        error_log("Error al actualizar producto: " . $e->getMessage());
        return false;
    }
}

public function insertar_producto($datos)
{
    $sql = "INSERT INTO productos (
                Referencia, Nombre, Enlace, EAN13, Resumen, 
                PrecioSinImpuestos, PrecioConImpuestos, PrecioMayorista,
                IDFiscal, IDCategoria, IDMarca, Peso, URLImagen
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta SQL");
        }

        $stmt->bind_param("sssssssssssis",
            $datos['Referencia'], 
            $datos['Nombre'], 
            $datos['Enlace'], 
            $datos['EAN13'], 
            $datos['Resumen'], 
            $datos['PrecioSinImpuestos'], 
            $datos['PrecioConImpuestos'], 
            $datos['PrecioMayorista'], 
            $datos['IDFiscal'], 
            $datos['IDCategoria'], 
            $datos['IDMarca'], 
            $datos['Peso'], 
            $datos['URLImagen']
        );

        return $stmt->execute();
    } catch (Exception $e) {
        error_log("Error al insertar producto: " . $e->getMessage());
        return false;
    }
}
    

    
}

?>