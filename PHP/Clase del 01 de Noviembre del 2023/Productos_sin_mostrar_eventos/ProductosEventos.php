<h3>LISTADO DE PRODUCTOS</h3>
<a href="RegEvento.php">Registrar Eventos Generales</a><br><br>
<?php
// Conexion a la Base Datos
include_once 'Conexion.php';
date_default_timezone_set('America/Bogota');
try {
    $conn = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $clave);
} catch (PDOException $pe) {
    die("Nada de Conexión $baseDatos :" . $pe->getMessage());
}

// Recupera el listado de Productos y lo guarda en $ListPro
$Sql="Select Id_Producto, P.Descripcion DescPro, P.Precio_Unitario, Stock, Id_Medida, UM.Descripcion DescMed 
		From Productos P, UNIDADES_MEDIDA UM	
		Where UM.Id_Unidad=P.Id_Medida Order By p.Id_Producto";

$LisPro = $conn -> prepare($Sql); 
// Ejecutamos la sentencia SQL
$LisPro -> execute(); 

//Verificar existencia de resultados
if($LisPro -> rowCount() > 0)   { 

echo 'Id' . " | " . 'Producto' . " | " . 'Precio' . " | " . 'Stock' . " | ".'Medida<br><br>';
// Recorre el listado de Productos 
while($Row = $LisPro->fetchObject()) {
     echo $Row -> Id_Producto . " | " . $Row -> DescPro . " | " . $Row -> Precio_Unitario . " | "
	 . $Row -> Stock . " | "  . $Row -> DescMed. " | " ;	 
	 echo "<a href='AdiEvento.php?Id_Producto=" . $Row -> Id_Producto . "'>Evento Producto</a><br>";
	}
}
?>

<br><a href="RegEvento.php">Registrar Eventos Generales</a><br>
