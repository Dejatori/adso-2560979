<?php

function db_query($query) { // Función para ejecutar nuestra consulta recibiendo como parámetro la consulta SQL ($query)
	// db_query es el nombre de la función y $query es el parámetro que recibe la función (puede tener cualquier nombre)

    $connection = mysqli_connect("localhost","root","","Despachos"); // Conexión a la base de datos
    $result = mysqli_query($connection,$query); // Ejecutamos la consulta recibida por parámetro ($query)
    return $result; // Retornamos el resultado de la consulta
}

function insert($tblname,$form_data){ // Función para insertar registros en la base de datos

	// $tblname es el nombre de la tabla donde se insertarán los datos y $form_data son los datos que se insertarán en la tabla
	$sql="INSERT INTO ".$tblname." (Id_Producto,Descripcion,Precio_Unitario,Stock,Id_Medida) VALUES('Null','".$_POST['Descripcion']."',".$_POST['Precio_Unitario'].",".$_POST['Stock'].",".$_POST['Id_Medida'].")";
	return db_query($sql); // Ejecutamos nuestra consulta
}

function delete($tblname,$field_id,$id){ // Función para eliminar registros de la base de datos

	// $tblname es el nombre de la tabla donde se eliminarán los datos, $field_id es el campo que se usará para eliminar el registro y $id es el valor del campo que se usará para eliminar el registro
	$sql = "delete from ".$tblname." where ".$field_id."=".$id.""; 
	return db_query($sql); // Ejecutamos nuestra consulta
}

function edit($tblname,$form_data,$field_id,$id){ // Función para editar registros de la base de datos
	$sql = "UPDATE ".$tblname." SET "; // Iniciamos nuestra consulta SQL
	// UPDATE es la palabra reservada para actualizar registros en la base de datos y SET es la palabra reservada para establecer los campos que se actualizarán
	$data = array(); // Creamos un array para almacenar los datos que se actualizarán
	foreach($form_data as $column=>$value){ // Recorremos el array de datos que recibimos por parámetro ($form_data)
		$data[] =$column."="."'".$value."'"; // Almacenamos los datos en el array creado anteriormente
	}
	$sql .= implode(',',$data); // Convertimos el array en una cadena de texto separada por comas
	// implode() es una función de PHP que convierte un array en una cadena de texto
	$sql.=" where ".$field_id." = ".$id.""; // Agregamos el campo y el valor que se usará para actualizar el registro
	// where es la palabra reservada para establecer el campo que se usará para actualizar el registro
	return db_query($sql); // Ejecutamos nuestra consulta
}

function select_id($tblname,$field_name,$field_id){ // Función para mostrar los datos de un registro de la base de datos
	$sql = "Select * from ".$tblname." where ".$field_name." = ".$field_id.""; // Iniciamos nuestra consulta SQL
	$db=db_query($sql); // Ejecutamos nuestra consulta
	$GLOBALS['row'] = mysqli_fetch_object($db); // Almacenamos los datos en la variable $row
	// mysqli_fetch_object() es una función de PHP que convierte los datos de un registro en un objeto para poder acceder a sus campos de forma más sencilla
	return $sql; // Retornamos la consulta
}

?>