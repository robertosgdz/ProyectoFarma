<?php
class Conectar
{
    public static function conexion()
    {
        try {
            // Activar excepciones en MySQLi
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $conexion = new mysqli("127.0.0.1", "root", "", "proyectofarma");

            // Establecer el conjunto de caracteres a UTF-8
            $conexion->set_charset("utf8");

            return $conexion;
        } catch (Exception $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
