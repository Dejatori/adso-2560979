<!-- Este archivo es de conexión a la base de datos usando mysqli -->

<?php 
$host = 'localhost';
$dbname = 'prueba';
$username = 'root';
$password = '';

// Crear la conexión con mysqli 

$conn = mysqli_connect($host, $username, $password, $dbname); // variable de conexión que se llama $conn y se le asigna la función mysqli_connect 
// que recibe los parámetros de conexión que son el host, el usuario, la contraseña y el nombre de la base de datos
// Verificar la conexión
if (!$conn) {
    die("Conexión Fallida: " . mysqli_connect_error());
}  // si la conexión falla, se ejecuta el mensaje de error y se termina la ejecución del programa
echo "Gracias a Dios nos conectamos"; // si la conexión es exitosa, se ejecuta el mensaje de conexión exitosa
mysqli_close($conn); // se cierra la conexión
?>