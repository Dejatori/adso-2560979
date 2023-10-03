<br>
<h2>INGRESAR PERSONAS</h2>
<br><br>
<?php

// Conexion a la Base Datos
include_once 'ConexionDesp.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $clave);
} catch (PDOException $pe) {
    die("Nada de Conexión $baseDatos :" . $pe->getMessage());
}

$sql = "select Id_TipoDcto, Descripcion from Tipo_Documento";
$query = $conn->prepare($sql);
// Ejecutamos la sentencia SQL
$query->execute();
$LisTipos = $query->fetchAll(PDO::FETCH_OBJ);

?>

<table border="1" width="50%">
    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Tipo Dcto</th>
        <th>Nro Dcto</th>
    </tr>
    <form action="" method="post">
        <tr>
            <input name="Id_Persona" type="hidden">
            <td><input name="Nombre" type="text"></td>
            <td><input name="Apellido" type="text"></td>
            <td>
                <select name="Id_TipoDcto" id="Id_TipoDcto">
                    <?php
                    foreach ($LisTipos as $Td) {
                        echo "<option value='" . $Td->Id_TipoDcto . "' >" . $Td->Descripcion . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td><input name="Nro_Dcto" type="text"></td>
        </tr>
        <tr>
            <td colspan=2 colspan=2 align="center"><input type="submit" name="Cancelar" class="btn btn-primary"
                                                          value="Cancelar"></td>
            <td colspan=2 colspan=2 align="center"><input type="submit" name="Ingresa" class="btn btn-primary"
                                                          value="Ingresa"></td>
        </tr>
    </form>
</table>

<?php
if (isset($_POST['Ingresa'])) {
    $Cadena = "INSERT INTO PERSONAS (Nombre, Apellido, Id_TipoDcto, Nro_Dcto) ";
    $Cadena = $Cadena . "VALUES ('" . $_POST['Nombre'] . "','" . $_POST['Apellido'] . "', " . $_POST['Id_TipoDcto']
        . ", '" . $_POST['Nro_Dcto'] . "')";
    echo "$Cadena: " . $Cadena;
    $query = $conn->prepare($Cadena);
    // Ejecutamos la sentencia SQL
    $query->execute();
    header("location:Personas.php");
} else {
    if (isset($_POST['Cancelar'])) {
        header("location:Personas.php");
    }
}
?>
