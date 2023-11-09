<?php
include_once "conexion.php";

$Host="mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=3306";
try {
    $conVent = new PDO($Host, DB_USER, DB_PASS);
} 
catch (PDOException $pe) {
    die("No hay Conexión en ". DB_NAME .":" . $pe->getMessage());
}

$consulta = "SELECT * FROM Venta Order By Fecha_Envio Asc";

$query = $conVent -> prepare($consulta); 
// Ejecutamos la sentencia SQL
$query -> execute(); 
$Ventas = $query->fetchObject();

$NumRegistros=$query->rowCount();

Echo "NumRegistros: " . $NumRegistros;

do {

   Echo 'Fecha Envio: '. $Ventas->Fecha_Envio; 
   Echo 'Fecha Envio: '. $Ventas->Fecha_Envio;


} while ($Ventas = $query->fetchObject());

?>