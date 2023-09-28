<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>

 
<?php
include_once("DatosMySQL.php"); // Incluir el archivo DatosMySQL.php

try { // Intentar conectar a la base de datos
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); // Crear conexión usando PDO
    echo "Gracias a Dios: conectado a $dbname en $host Exitosamente."; // Si no hay error en la conexión, se imprime este mensaje
} catch (PDOException $pe) { // Si hay error en la conexión, se imprime este mensaje
    die("Nada de Conexión $dbname :" . $pe->getMessage()); // Terminar el script si hay un error en la conexión
}


// Sentencia SQL
$sql = "select * from datos"; // Seleccionar todos los registros de la tabla datos
$query = $conn -> prepare($sql); // Preparar la sentencia SQL
$query -> execute(); // Ejecutar la sentencia SQL
$results = $query -> fetchAll(PDO::FETCH_OBJ); // Obtener todos los resultados de la sentencia SQL como objetos
// (PDO::FETCH_OBJ es una constante de la clase PDO) que se guardan en la variable $results (arreglo de objetos)
// PDO::FETCH_OBJ: devuelve un objeto anónimo con nombres de propiedades que corresponden a las columnas
if($query -> rowCount() > 0)   { // Si hay resultados, se imprimen en una tabla
?>
<table>
  <tr>
    <th>Codigo</th>
    <th>Fecha</th>
	<th>Nombre</th>
  </tr>
<?php
foreach($results as $result) { // Se recorre el arreglo de objetos $results y se imprime cada objeto como una fila de la tabla
	ECHO "
	<tr>
	<td>".$result -> Codigo."</td>
	<td>".$result -> Fecha."</td>
	<td>".$result -> Nombre."</td>
	</tr>";
   } // Fin del foreach
 }
 // Liberar la memoria asociada con los resultados de la sentencia SQL
 $result=null; 
 $results=null; 
 $conn = null;
?>
  <tr>
  <p>
    <a href="insertar.php">Añadir un nuevo registro</a> <!-- Enlace a insertar.php -->
  </p>
  </tr>
</table>  
</body>
</html>
