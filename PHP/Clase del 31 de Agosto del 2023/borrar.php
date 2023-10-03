<?php
include("function.php");
$Codigo = $_GET['Codigo'];
$DondeVengo = $_GET['Voy'];
delete('datos', 'Codigo', $Codigo);
header("location:$DondeVengo");
?>