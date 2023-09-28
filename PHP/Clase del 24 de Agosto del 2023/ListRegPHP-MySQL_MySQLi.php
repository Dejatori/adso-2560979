<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>
 
<?php
// Variables de conexión
$host = 'localhost';
$dbname = 'prueba';
$username = 'root';
$password = '';

// Crear conexión usando MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);
// Verificar conexión
if (!$conn) { // Si hay error en la conexión, se imprime este mensaje
    die("Conexión Fallida: " . mysqli_connect_error()); // Terminar el script si hay un error en la conexión
}
echo "Gracias a Dios nos conectamos"; // Si no hay error en la conexión, se imprime este mensaje

// Sentencia SQL para seleccionar todos los registros de la tabla datos
$ssql = "select * from datos";

// Ejecutamos la sentencia SQL
$result = $conn->query($ssql); // El resultado se guarda en la variable $result
 ?>
<!-- Imprimimos los resultados en una tabla -->
<table>
  <tr>
    <th>Codigo</th>
    <th>Fecha</th>
	<th>Nombre</th>
  </tr>
  <?php
    //Mostramos los registros
    while ($row = $result->fetch_array()) { // Se recorre el arreglo de objetos $result y se imprime cada objeto como una fila de la tabla
      // fetch_array(): obtiene una fila de resultados como un array asociativo, numérico, o ambos (constantes de la clase mysqli)
      // se guardan en la variable $row (arreglo asociativo) y se imprimen los valores de cada fila
      echo '<tr><td>' . $row["Codigo"] . '</td>';
      echo '<td>' . $row["Fecha"] . '</td>';
	  echo '<td>' . $row["Nombre"] . '</td></tr>';
    }
    $result->free_result(); // Liberar la memoria asociada con los resultados de la sentencia SQL
    $conn->close(); // Cerrar la conexión
  ?>
</table>

  <p>
    <a href="insertar.php">Añadir un nuevo registro</a> <!-- Enlace a insertar.php -->
  </p>

</body>
</html>