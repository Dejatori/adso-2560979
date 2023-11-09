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
$Sql="SELECT p.Id_Producto, p.Descripcion DescPro, p.Id_Medida, p.Precio_Unitario, p.Stock, um.Abreviatura, e.Id_TipoEvento
, te.nombre, e.Id_Evento, e.Fecha, e.Descripcion DescEve 
FROM productos p, eventos e, UNIDADES_MEDIDA um, Tipo_Eventos te 
WHERE p.Id_Producto=e.Id_Producto and um.Id_Unidad=P.Id_Medida and te.Id_TipoEvento=e.Id_TipoEvento 
UNION SELECT p.Id_Producto, p.Descripcion, p.Id_Medida, p.Precio_Unitario, p.Stock, um.Abreviatura, '','','','','' 
FROM productos p, eventos e, UNIDADES_MEDIDA um WHERE p.Id_Producto<>e.Id_Producto and um.Id_Unidad=p.Id_Medida
Order By Id_Producto, Fecha Desc;";

$LisPro = $conn -> prepare($Sql); 
// Ejecutamos la sentencia SQL
$LisPro -> execute(); 

//Verificar existencia de resultados
if($LisPro -> rowCount() > 0)   { 
echo 'Id' . " | " . 'Producto' . " | " . 'Precio' . " | " . 'Stock' . " | ".'Medida<br><br>';
$IdProducto = "";
// Recorre el listado de Productos 
while($Row = $LisPro->fetchObject()) {
	if ($IdProducto <> $Row -> Id_Producto) {
		echo $Row -> Id_Producto . " | " . $Row -> DescPro . " | " . $Row -> Precio_Unitario . " | "
		. $Row -> Stock . " | "  . $Row -> Abreviatura. " | " ;	 
		echo "<a href='AdicEvento.php?Id_Producto=" . $Row -> Id_Producto . "'>Evento Producto</a><br>";
		$IdProducto= $Row -> Id_Producto;
	   }
	 if ($Row -> Id_TipoEvento<>"") {
	 	echo "--- EVENTO: ". $Row -> Fecha . " | " . $Row -> nombre . " | " . $Row -> DescEve . "<br>";
		}
	}
}
?>
<br><a href="RegEvento.php">Registrar Eventos Generales</a><br>

