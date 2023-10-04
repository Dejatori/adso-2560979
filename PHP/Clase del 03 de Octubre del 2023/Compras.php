<?php
if(!isset($_GET['Ancho']) && !isset($_GET['Alto'])){
    echo "<script language=\"JavaScript\">
    <!-- 
    document.location=\"$PHP_SELF?Ancho=\"+screen.width+\"&Alto=\"+screen.height;
    //-->
    </script>";
} else {
    if(isset($_GET['Ancho']) && isset($_GET['Alto'])) {
        // Resolución de pantalla detectada
        //echo "Esta es tu resolucion de pantalla: Ancho= ".$_GET['Ancho']." y Alto= ".$_GET['Alto'];
		$AnchoPantalla= $_GET['Ancho'];
		$AltoPantalla= $_GET['Alto'];
    } else {
        // echo "No se ha podido detectar la resolución de pantalla";
    }
}

include_once "ConexionDesp.php";

try {
    $conDesp = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $clave);
} catch (PDOException $pe) {
    die("Nada de Conexión $baseDatos :" . $pe->getMessage());
}

# Por defecto hacemos la consulta de todas las personas
$consulta = "SELECT Consecutivo, Fecha, Cantidad, Com.Precio_Unitario, Total_Compra, Com.Id_Persona, Com.Id_Producto, Com.Id_Medida, Per.Nombre, Per.Apellido, Tdc.Id_TipoDcto, Tdc.Descripcion, Per.Nro_Dcto,
					Pro.Id_Producto, Pro.Descripcion, Pro.Precio_Unitario, Pro.Stock, Uni.Id_Unidad, Uni.Descripcion, Uni.Abreviatura	
				FROM Compras Com, Personas Per, Productos Pro, Unidades_Medida Uni, Tipo_Documento Tdc
				WHERE Com.Id_Persona=Per.Id_Persona 
					and Com.Id_Producto=Pro.Id_Producto 
					and Com.Id_Medida=Uni.Id_Unidad 
					and Per.Id_TipoDcto=Tdc.Id_TipoDcto
					Order By Fecha Asc";

$query = $conDesp -> prepare($consulta); 
// Ejecutamos la sentencia SQL
$query -> execute(); 
$NumRegistros=$query->rowCount();
//$LisCompras = $query -> fetchAll(PDO::FETCH_OBJ); 

?>
    <form action="Compras.php" method="GET">
        <br>
        <br>
    </form>
<?php 

date_default_timezone_set('America/Bogota');
$FechaTmp = localtime();
$FechaTmp = new DateTime('Now');
$ahora = time();
$unDiaEnSegundos = 24 * 60 * 60;
$manana = $ahora + $unDiaEnSegundos;
$Fechamanana = date("Y-m-d", $manana);
//echo $FechaTmp->format('Y-m-d H:i:s').'<br>';			
//echo $Fechamanana.'<br>';
//echo date('d-m-Y h:i:s A');

//$datetimeP = getdate();
//$datetimeP->setDate(2001, 2, 3);
//print_r($hoy);

$AnchoCen=($AnchoPantalla*70)/100;
$AnchoCen=648;
$AnchoDato=$AnchoCen/100;
$TotalMinutos=24*60;
$TotalMinutos=1440;
$Long=0;
$Tot_Compra=0;

$Imagen = "images/Transparente.gif";
$Imagen1 = "images/Fondo01.JPG";
$Imagen2 = "images/Fondo02.JPG";
$Imagen3='images/Reglilla1024.gif';

$Estado_Color2="#000FFF";
$Estado_Color1="#B5B2B2";
$CodColorH="#FFF111";

$Compra = $query->fetchObject();
$FechaTmp = new DateTime($Compra->Fecha);
//$FechaTmp = date("Y-m-d", $FechaAnt);
$FechaAnt = $FechaTmp->format('Y-m-d').'<br>';	
$EventL = 1;

Echo "<table valign='top' cellpadding='0' cellspacing='0' border='0'>";
do {
	$FechaTmp = new DateTime($Compra->Fecha);
	$FechaPos = $FechaTmp->format('Y-m-d');
	if ($EventL == 1) {
		$FechaAnt = $FechaPos;
//		echo $EventL.'--<tr>';
//	AQUI NUEVA FILA
		Echo "<tr><td valign='middle'>".$FechaPos."</td><td>";	
		Echo "<table width='".$AnchoCen."' valign='top' cellpadding='0' cellspacing='0' border='0'><tr>";	
	}
//	else {
	if ($FechaPos != $FechaAnt) {
			$FechaAnt = $FechaPos;
			$AnchoDer=$AnchoCen-$Long;
			//$Tot_Compra=$Tot_Compra+($Compra->Total_Compra);
			$DatosP = ' Long: '.$Long.' |'. 'AnchoDer: '.$AnchoDer;
			$DatosP = 'Fecha: '.$Compra->Fecha.'<br> Compra: '.number_format($Compra->Total_Compra, 2);
			//echo 'AnchoDer: '.$AnchoDer.'<br>';						
			Echo "<td bgcolor='".$Estado_Color1."' valign='middle' width='".$AnchoDer."' height='25'>
			<img border='0' src='".$Imagen."' width='".$AnchoDer."' height='20' title='".$DatosP."'></td></tr>";
			$Cols=$EventL*2+1;
			Echo "<tr>
      <td colspan='".$Cols."' bgcolor='".$CodColorH."' valign='middle' background='images/Reglilla1024.gif' height='17' cellpadding='0' cellspacing='0'>
      </td>
      </tr></table>";
			Echo "</td><td>Total: ".number_format($Tot_Compra, 2)."</td></tr>";
			Echo "<tr><td valign='middle'>".$FechaPos."</td><td>";	
	  Echo "<table valign='top' cellpadding='0' cellspacing='0' border='0'><tr>";	
//			<tr><td>";
			$Long=0;
			$Tot_Compra=0;	
//			echo $EventL.'--</td></tr>';			
//			echo $EventL.'--<tr><td>';			
		}
		else {
			$FechaAnt = $FechaPos;
//			echo $EventL.'--</td><td>';			
		}
//	}	

$FechaIni = new DateTime($FechaAnt);
$FechaAct = new DateTime($Compra->Fecha);
$intervalo = $FechaIni->diff($FechaAct);

$Horas=$intervalo->format('%H');
$Minutos=$intervalo->format('%i');
$Segundos=$intervalo->format('%S');

$TotMinutos=($Horas)*60+$Minutos;
$Tiempo = $FechaAnt." ".$Horas.":".$Minutos.":"." Tt:".$TotMinutos;

$AnchoAnt=($AnchoCen*$TotMinutos)/$TotalMinutos;
$AnchoAct=$AnchoAnt-$Long;
//$Tot_Compra=$Tot_Compra+($Compra->Total_Compra);
$Long=$AnchoAnt;

$AnchoR=$AnchoCen-$AnchoAnt-$AnchoDato;

//Echo "Horas: ".$Horas."<br>";
//Echo "Minutos: ".$Minutos."<br>";
//Echo "Segundos: ".$Segundos."<br>";

	$DatosP = 'EventL: '.$EventL.' Fecha Ant: '.$FechaAnt .'|';
	$DatosP = $DatosP .' Fecha Pos: '.$FechaPos. '|'.' Fecha Com: '.$Compra->Fecha.'|'.' Tiempo: '.$Tiempo.'|';	
	$DatosP = $DatosP .' AnchoAnt: '.$AnchoAnt.'|'.' AnchoAct: '.$AnchoAct.'|'.' Longitud: '.$Long.'| Consecutivo: '.$Compra->Consecutivo.'|';
	$DatosP = $DatosP .' Id_Persona: '.$Compra->Id_Persona.'|'.' Id_Producto: '.$Compra->Id_Producto.'|'.'Id_Medida: '.$Compra->Id_Medida.'|';
	$DatosP = $DatosP .' Precio_Unitario: '.$Compra->Precio_Unitario.'|'.' Cantidad: '.$Compra->Cantidad.'|'.' Compra->Total_Compra: '.$Compra->Total_Compra.'|';
	$Tot_Compra=$Tot_Compra+$Compra->Total_Compra;
	$DatosP = 'Fecha: '.$Compra->Fecha.' | Compra: '.number_format($Compra->Total_Compra, 2);

	//<?php 
$AnchoAct=$AnchoAct-10;
Echo "<td bgcolor='".$Estado_Color1."' valign='middle' width='".$AnchoAct."' height='25'>
      <img border='0' src='".$Imagen."' width='".$AnchoAct."' height='20' title='".$DatosP."'></td>";
Echo "<td bgcolor='".$Estado_Color2."' valign='middle' width='10' height='25'>
      <img border='0' src='".$Imagen."' width='10' height='20' title='".$DatosP."'></td>";
	  
	$EventL=$EventL+1;

} while ($Compra = $query->fetchObject());
		$AnchoDer=$AnchoCen-$Long;
		Echo "<td bgcolor='".$Estado_Color1."' valign='middle' width='".$AnchoDer."' height='25'>
		<img border='0' src='".$Imagen."' width='".$AnchoDer."' height='20' title='".$DatosP."'></td></tr>";
		$Cols=$EventL*2+1;
		Echo "<tr>
      <td colspan='".$Cols."' bgcolor='".$CodColorH."' valign='middle' background='images/Reglilla1024.gif' height='17' cellpadding='0' cellspacing='0'>
      </td>
      </tr></table></td><td>Total: ".number_format($Tot_Compra, 2)."</td></tr>";		
	  Echo "</table>";
//		echo 'Long: '.$Long.' ||';
//		echo 'AnchoDer: '.$AnchoDer.'<br>';	
//		echo $EventL.'--</td></tr>';
?>

</body>
</html>