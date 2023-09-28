<?php
include_once "base_de_datos.php";

# Por defecto hacemos la consulta de todas las personas
$consulta = "SELECT Id_Persona, Nombre, Apellido, P.Id_TipoDcto, TD.Descripcion Dcto, Nro_Dcto FROM personas P, Tipo_Documento TD Where P.Id_TipoDcto= TD.Id_TipoDcto Order By Nro_Dcto";

# Vemos si hay búsqueda
$busqueda = null;
if (isset($_GET["busqueda"])) {
    # Y si hay, búsqueda, entonces cambiamos la consulta
    # Nota: no concatenamos porque queremos prevenir inyecciones SQL
    $busqueda = $_GET["busqueda"];
    $consulta = "SELECT * FROM personas WHERE nombre LIKE ?";
	$consulta = "SELECT P.Id_Persona, P.Nombre, P.Apellido, P.Id_TipoDcto, TD.Descripcion Dcto, Nro_Dcto FROM personas P, Tipo_Documento TD Where P.Id_TipoDcto=TD.Id_TipoDcto and Nombre LIKE ? Order By Nro_Dcto";
}
# Preparar sentencia e indicar que vamos a usar un cursor
$sentencia = $base_de_datos->prepare($consulta, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
]);
# Aquí comprobamos otra vez si hubo búsqueda, ya que tenemos que pasarle argumentos al ejecutar
# Si no hubo búsqueda, entonces traer a todas las personas (mira la consulta de la línea 5)
if ($busqueda === null) {
    # Ejecutar sin parámetros
    $sentencia->execute();
} else {
    # Ah, pero en caso de que sí, le pasamos la búsqueda
    # Un arreglo que nomás llevará la búsqueda con % al inicio y al final
    $parametros = ["%$busqueda%"];
    $sentencia->execute($parametros);
}

# Sin importar si hubo búsqueda o no, se nos habrá devuelto un cursor que iteramos más abajo...
?>
<!--Recordemos que podemos intercambiar HTML y PHP como queramos-->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tabla de ejemplo</title>
	<style>
	table, th, td {
	    border: 1px solid black;
	}
	</style>
</head>
<body>
    <!--
        Un formulario que únicamente permite buscar. Se envía
        a este mismo script y se hace con GET
    -->
    <form action="listarPersonas_PDO.php" method="GET">
    <!--
        Fíjate en el atributo name="busqueda", pues esa variable
        la estamos obteniendo de $_GET allá arriba

    -->
        <input type="text" placeholder="Buscar por nombre" name="busqueda">
        <button type="submit">Buscar</button>
		<a href="Ingresar.php">Nueva Persona</a>
        <br>
        <br>
    </form>
	<table>
		<thead>
			<tr>
				<th>ID_Persona</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Tipo Documento</th>				
				<th>Nro_Dcto</th>				
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<!--
				Y aquí usamos el ciclo while y fecthObject, el cuerpo
                del ciclo queda intacto pero ahora estamos usando
                cursores :)
			-->
			<?php while ($personal = $sentencia->fetchObject()) {?>
			<tr>
				<td><?php echo $personal->Id_Persona ?></td>
				<td><?php echo $personal->Nombre ?></td>
				<td><?php echo $personal->Apellido ?></td>
				<td><?php echo $personal->Dcto ?></td>
				<td><?php echo $personal->Nro_Dcto ?></td>				
				<td><a href="<?php echo "editar.php?Id_Persona=" . $personal->Id_Persona ?>">Editar</a></td>
				<td><a href="<?php echo "eliminar.php?Id_Persona=" . $personal->Id_Persona ?>">Eliminar</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</body>
</html>