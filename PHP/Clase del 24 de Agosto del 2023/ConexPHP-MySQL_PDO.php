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
$conn = null; // Cerrar la conexión
?>

</body>
</html>