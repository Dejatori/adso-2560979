<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>

 
<?php
include_once("DatosMySQL.php");
 //$conn=Conexion::ConexionBD();
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Gracias a Dios: conectado a $dbname en $host Exitosamente.";
} catch (PDOException $pe) {
    die("Nada de Conexión $dbname :" . $pe->getMessage());
}


// Componemos la sentencia SQL
$sql = "select * from datos";
$query = $conn -> prepare($sql); 
// Ejecutamos la sentencia SQL
$query -> execute(); 
$results = $query -> fetchAll(PDO::FETCH_OBJ); 
//Verificar existencia de resultados
if($query -> rowCount() > 0)   { 
?>
<table>
  <tr>
    <th>Codigo</th>
    <th>Fecha</th>
	<th>Nombre</th>
  </tr>
<?php
foreach($results as $result) { 
	ECHO "
	<tr>
	<td>".$result -> Codigo."</td>
	<td>".$result -> Fecha."</td>
	<td>".$result -> Nombre."</td>
	</tr>";
   }
 }
 $result=null;
 $results=null;
 $conn = null;
?>
  <tr>
  <p>
    <a href="insertar.php">Añadir un nuevo registro</a>
  </p>
  </tr>
</table>  
</body>
</html>
