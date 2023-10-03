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
//echo "Gracias a Dios nos conectamos";

include("function.php");

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
        echo '<td>' . $row["Nombre"] . '</td>';
        echo '<td><a href="editar.php?Codigo=' . $row["Codigo"] . '&Voy=ListRegPHP-MySQL_MySQLi.php">Editar</a>';
        echo '/ <a href="borrar.php?Codigo=' . $row["Codigo"] . '&Voy=ListRegPHP-MySQL_MySQLi.php">Borrar</a></td></tr>';
    }
    $result->free_result();
    $conn->close();
    ?>
</table>

</body>
</html>
