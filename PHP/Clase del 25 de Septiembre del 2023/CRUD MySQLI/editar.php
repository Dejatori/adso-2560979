<?php 
include("function.php");
$Id_Producto = $_GET['Id_Producto'];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Registros Mysql Mediante Funcion</title>
<link type="text/css" href="bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 4px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
.main-wrapper{
	width:50%;
	
	background:#E0E4E5;
	border:1px solid #292929;
	padding:25px;
}
hr {
    margin-top: 5px;
    margin-bottom: 5px;
    border: 0;
    border-top: 1px solid #eee;
}
</style>
</head>

<body>
<div class="main-wrapper">
<h1>Editar Registros con Función PHP </h1>
<br><br>
<?php 
select_id('Productos','Id_Producto',$Id_Producto);
$sql = "select Id_Unidad, UM.Descripcion DescMedida from Unidades_Medida UM";
$result = db_query($sql);
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
    <input name="Id_Producto" type="hidden" value="<?php echo $row->Id_Producto;?>" placeholder="Id_Producto">
    <td><input name="Descripcion" type="text" value="<?php echo $row->Descripcion;?>" placeholder="Descripcion"></td>
	<td><input name="Precio_Unitario" type="text" value="<?php echo $row->Precio_Unitario;?>" placeholder="Precio_Unitario"></td>  
	<td><input name="Stock" type="text" value="<?php echo $row->Stock;?>" placeholder="Stock"></td>	
    <td>
	<select name="Id_Medida" id="Id_Medida">
	<?php while($reg = mysqli_fetch_object($result)){ 
		if (trim($row->Id_Medida)==trim($reg->Id_Unidad)) {
			echo "<option value=".$reg->Id_Unidad." SELECTED>".$reg->DescMedida."</option>";
		}	
		else {
			echo "<option value=".$reg->Id_Unidad." >".$reg->DescMedida."</option>";
		}	
	} ?>
      </select>			
	</td>
	</tr>	
	<tr>
    <td></td>
    <td></td>
    <td></td>
    <td><input type="submit" name="submit" class="btn btn-primary" value="submit"></td>
	</tr>		
</form>
</table>

<?php
	
	if(isset($_POST['submit'])){
		$field = array("Id_Producto"=>$_POST['Id_Producto'],"Descripcion"=>$_POST['Descripcion'], "Precio_Unitario"=>$_POST['Precio_Unitario'], "Stock"=>$_POST['Stock'], "Id_Medida"=>$_POST['Id_Medida']);
		$tbl = "Productos";
		edit($tbl,$field,'Id_Producto',$Id_Producto);
		header("location:index.php");
	}
?>
</div>
</body>
</html>