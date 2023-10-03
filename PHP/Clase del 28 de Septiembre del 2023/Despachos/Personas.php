<h2>LISTADO DE PERSONAS</h2>

<?php
// Conexion a la Base Datos
include_once 'ConexionDesp.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $clave);
} catch (PDOException $pe) {
    die("Nada de Conexión $baseDatos :" . $pe->getMessage());
}

$sql = "select * from Tipo_Documento";
$query = $conn->prepare($sql);
// Ejecutamos la sentencia SQL
$query->execute();
$LisTipos = $query->fetchAll(PDO::FETCH_OBJ);

// Componemos la sentencia SQL
$sql = "select * from Personas";
$query = $conn->prepare($sql);
// Ejecutamos la sentencia SQL
$query->execute();
$LisPer = $query->fetchAll(PDO::FETCH_OBJ);

//Verificar existencia de resultados
if ($query->rowCount() > 0) {


    echo 'Id' . " | " . 'Nombre' . " | " . 'Apellido' . " | " . 'Id_TipoDcto' . " | " . 'Nro_Dcto<br><br>';
// Recorre el listado de Personas
    foreach ($LisPer as $Per) {
        echo $Per->Id_Persona . " | " . $Per->Nombre . " | " . $Per->Apellido . " | ";
        foreach ($LisTipos as $TDcto) {
            if ($TDcto->Id_TipoDcto == $Per->Id_TipoDcto)
                echo $TDcto->Descripcion;
        }
        echo " | " . $Per->Nro_Dcto . " | ";
        ?>
        <a href="EditaPer.php?Id_Persona=<?= $Per->Id_Persona ?>">Editar</a> |
        <a href="BorraPer.php?Id_Persona=<?= $Per->Id_Persona ?>">Borrar</a>
        <br>
        <?php
    }
}
?>

<br><a href="IngresaPer.php">Nueva Persona</a><br>

