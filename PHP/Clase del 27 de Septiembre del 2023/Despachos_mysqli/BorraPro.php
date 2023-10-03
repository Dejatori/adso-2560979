<br>
<h2>ELIMINAR PRODUCTOS</h2>
<br><br>
<?php
$Id_Producto = $_GET['Id_Producto'];

// Conexion a la Base Datos
include_once 'ConexionPro.php';
$mysqli = new mysqli($host, $usuario, $clave, $baseDatos);

// Averigua si hya problemas de Conexión
if ($mysqli->connect_errno) {
    printf("Conexión fallida: %s\n", $mysqli->connect_error);
    exit();
}

$Sql = "Select Id_Producto, Descripcion , Precio_Unitario, Stock, Id_Medida
		From Productos Where Id_Producto=" . $Id_Producto;

$Producto = $mysqli->query($Sql);
$row = mysqli_fetch_object($Producto);

$Cadena = "select Id_Unidad, Descripcion DescMedida from Unidades_Medida";
$Unidades = $mysqli->query($Cadena);
?>

<table border="1" width="50%">
    <tr>
        <th>Descripción</th>
        <th>Precio Unitario</th>
        <th>Stock</th>
        <th>Unidad Medida</th>
    </tr>
    <form action="" method="post">
        <tr>
            <input name="Id_Producto" type="hidden" value="<?= $row->Id_Producto ?>">
            <td><input name="Descripcion" type="text" value="<?= $row->Descripcion ?>"</td>
            <td><input name="Precio_Unitario" type="text" value="<?= $row->Precio_Unitario ?>"
                       placeholder="Precio_Unitario"></td>
            <td><input name="Stock" type="text" value="<?= $row->Stock ?>" placeholder="Stock"></td>
            <td>
                <select name="Id_Medida" id="Id_Medida">
                    <?php while ($reg = mysqli_fetch_object($Unidades)) {
                        if (trim($row->Id_Medida) == trim($reg->Id_Unidad)) {
                            echo "<option value=" . $reg->Id_Unidad . " SELECTED>" . $reg->DescMedida . "</option>";
                        } else {
                            echo "<option value=" . $reg->Id_Unidad . " >" . $reg->DescMedida . "</option>";
                        }
                    } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan=2 align="center"><input type="submit" name="Cancelar" class="btn btn-primary" value="Cancelar">
            </td>
            <td colspan=2 align="center"><input type="submit" name="Eliminar" class="btn btn-primary" value="Eliminar">
            </td>
        </tr>
    </form>
</table>

<?php
if (isset($_POST['Eliminar'])) {
    $Cadena = "DELETE FROM Productos WHERE Id_Producto=" . trim($_POST['Id_Producto']);
    $Producto = $mysqli->query($Cadena);
    header("location:Productos.php");
} else {
    if (isset($_POST['Cancelar'])) {
        header("location:Productos.php");
    }
}
?>