<h2>LISTADO DE PRODUCTOS</h2>

<?php
// Conexion a la Base Datos
include_once 'ConexionDesp.php';
$mysqli = new mysqli($host, $usuario, $clave, $baseDatos);

// Averigua si hya problemas de Conexión
if ($mysqli->connect_errno) {
    printf("Conexión fallida: %s\n", $mysqli->connect_error);
    exit();
}  
// Recupera el listado de Productos y lo guarda en $ListPro
$Sql="Select Id_Producto, P.Descripcion , P.Precio_Unitario, Stock, Id_Medida, UM.Descripcion DescMed 
		From Productos P, UNIDADES_MEDIDA UM	
		Where UM.Id_Unidad=P.Id_Medida";
		
$ListPro=$mysqli->query($Sql);	  

echo 'Id' . " | " . 'Producto' . " | " . 'Precio' . " | " . 'Stock' . " | ".'Medida<br><br>';
// Recorre el listado de Productos 
while($Row=$ListPro->fetch_assoc()) {
     echo $Row['Id_Producto'] . " | " . $Row['Descripcion'] . " | " . $Row['Precio_Unitario'] . " | "
	 . $Row['Stock'] . " | "  . $Row['DescMed']. " | " ;
?>
	  <a href="EditaPro.php?Id_Producto=<?=$Row['Id_Producto']?>">Editar</a> | 
	  <a href="BorraPro.php?Id_Producto=<?=$Row['Id_Producto']?>">Borrar</a>	  
	  <br>
 <?php
}
?>

<br><a href="IngresaPro.php">Nuevo Producto</a><br>

