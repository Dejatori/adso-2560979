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
mysqli_close($conn);
?>