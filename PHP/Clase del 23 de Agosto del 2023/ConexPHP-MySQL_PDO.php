<!-- Archivo PHP que realiza la conexión a la base de datos usando PDO -->

<html>
<head>
    <title>Prueba de PHP</title>
</head>
<body>

<?php
include_once("DatosMySQL.php"); // incluir el archivo DatosMySQL.php que contiene los datos de conexión a la base de datos

try { // try es un manejador de excepciones que intenta ejecutar el código que está dentro de él, si no puede, ejecuta el catch
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); // variable de conexión que se llama $conn y se le asigna la función PDO 
    // que recibe los parámetros de conexión que son el host, el usuario, la contraseña y el nombre de la base de datos que están en el archivo DatosMySQL.php
    echo "Gracias a Dios: conectado a $dbname en $host Exitosamente."; // si la conexión es exitosa, se ejecuta el mensaje de conexión exitosa
} catch (PDOException $pe) { // catch es un manejador de excepciones que captura el error que se genera en el try y lo guarda en la variable $pe
    die("Nada de Conexión $dbname :" . $pe->getMessage()); // si la conexión falla, se ejecuta el mensaje de error y se termina la ejecución del programa
}
$conn = null; // se cierra la conexión
?>

</body>
</html>