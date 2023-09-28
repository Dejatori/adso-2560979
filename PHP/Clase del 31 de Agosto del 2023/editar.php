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
include("function.php");
$Codigo = $_GET['Codigo'];
$DondeVengo= $_GET['Voy'];
select_id('datos','Codigo',$Codigo);
?>
<form action="" method="post">
	<input type="text" value="<?php echo $row->Codigo;?>" name="Codigo">
	<input type="text" value="<?php echo $row->Nombre;?>" name="Nombre">
	<input type="text" value="<?php echo $row->Fecha;?>" name="Fecha">
	<input type="submit" name="submit">
</form>

<?php
	
	if(isset($_POST['submit'])){
		$field = array("Nombre"=>$_POST['Nombre'], "Fecha"=>$_POST['Fecha']);
		$tbl = "datos";
		edit($tbl,$field,'Codigo',$Codigo);
		header("location:$DondeVengo");
	}
?>
</div>
</body>
</html>