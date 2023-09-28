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
 $conn = null;
?>

</body>
</html>
