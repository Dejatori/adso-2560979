<?php 
// Variables de conexión
$host = 'localhost';
$dbname = 'prueba';
$username = 'root';
$password = '';

// Crear conexión usando MySQLi 
$conn = mysqli_connect($host, $username, $password, $dbname);
// Verificar conexión
if (!$conn) {
    die("Conexión Fallida: " . mysqli_connect_error()); // Terminar el script si hay un error en la conexión
}
echo "Gracias a Dios nos conectamos"; // Si no hay error en la conexión, se imprime este mensaje
mysqli_close($conn); // Cerrar la conexión
?>