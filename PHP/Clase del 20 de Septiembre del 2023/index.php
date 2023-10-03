<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> PRODUCTOS </title>
</head>

<body>

<?php
include("function.php");
if (isset($_POST['submit'])) {
    $field = array("Id_Producto" => $_POST['Id_Producto']);
    $tbl = "Productos";
    insert($tbl, $field);

}
?>

<?php
$sql = "select Id_Unidad, UM.Descripcion DescMedida from Unidades_Medida UM";
$result = db_query($sql);
?>

<h1>PRODUCTOS</h1>
<br><br>
<table border="1" width="50%">
    <tr>
        <th>Descripción</th>
        <th>Precio Unitario</th>
        <th>Stock</th>
        <th>Unidad Medida</th>
    </tr>
    <form action="" method="post">
        <tr>
            <input name="Id_Producto" type="hidden" placeholder="Id_Producto">
            <td><input name="Descripcion" type="text" placeholder="Descripcion"></td>
            <td><input name="Precio_Unitario" type="text" placeholder="Precio_Unitario"></td>
            <td><input name="Stock" type="text" placeholder="Stock"></td>
            <td>
                <select name="Id_Medida" id="Id_Medida">
                    <?php while ($row = mysqli_fetch_object($result)) {
                        echo "<option value=" . $row->Id_Unidad . ">" . $row->DescMedida . "</option>";
                    } ?>
                </select>
            </td>
            <td><input type="submit" name="submit" value="Insertar"></td>
        </tr>

    </form>
</table>
<br><br>


<table border="1" width="100%">
    <tr>
        <th>Id Producto</th>
        <th>Descripción</th>
        <th>Precio Unitario</th>
        <th>Stock</th>
        <th>Id Medida</th>
        <th>Unidad Medida</th>
        <th>ACCION</th>
    </tr>
    <?php
    $sql = "select Id_Producto, P.Descripcion DescProducto, Precio_Unitario, Stock, Id_Medida, UM.Descripcion DescMedida from Productos P, Unidades_Medida UM where P.Id_Medida=UM.Id_Unidad";
    $result = db_query($sql);


    while ($row = mysqli_fetch_object($result)) {
        ?>
        <tr>
            <td><?php echo $row->Id_Producto; ?></td>
            <td><?php echo $row->DescProducto; ?></td>
            <td><?php echo $row->Precio_Unitario; ?></td>
            <td><?php echo $row->Stock; ?></td>
            <td><?php echo $row->Id_Medida; ?></td>
            <td><?php echo $row->DescMedida; ?></td>
            <td>

                <a class="btn btn-primary" href="editar.php?Id_Producto=<?php echo $row->Id_Producto; ?>">Editar</a>
                <a class="btn btn-primary" href="borrar.php?Id_Producto=<?php echo $row->Id_Producto; ?>">Borrar</a>
            </td>
        </tr>
    <?php } ?>
</table>
</div>
</body>
</html>