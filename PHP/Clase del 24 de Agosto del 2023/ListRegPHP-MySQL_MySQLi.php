<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>
 
<?php 
$host = 'localhost';
$dbname = 'prueba';
$username = 'root';
$password = '';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Conexión Fallida: " . mysqli_connect_error());
}
echo "Gracias a Dios nos conectamos";

// Componemos la sentencia SQL
$ssql = "select * from datos";

// Ejecutamos la sentencia SQL
$result = $conn->query($ssql);
 ?>
<table>
  <tr>
    <th>Codigo</th>
    <th>Fecha</th>
	<th>Nombre</th>
  </tr>
  <?php
    //Mostramos los registros
    while ($row = $result->fetch_array()) {
      echo '<tr><td>' . $row["Codigo"] . '</td>';
      echo '<td>' . $row["Fecha"] . '</td>';
	  echo '<td>' . $row["Nombre"] . '</td></tr>';
    }
    $result->free_result();
    $conn->close();
  ?>
</table>

  <p>
    <a href="insertar.php">Añadir un nuevo registro</a>
  </p>

</body>
</html>
