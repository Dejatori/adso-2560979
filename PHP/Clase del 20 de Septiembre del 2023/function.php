<?php
function db_query($query) // Función para ejecutar una consulta
{
    $connection = mysqli_connect("localhost", "root", "", "Despachos"); // Conexión a la base de datos
    $result = mysqli_query($connection, $query); // Ejecuta la consulta
    return $result; // Retorna el resultado de la consulta
}

function insert($tblname, $form_data) // Función para insertar un registro en una tabla
{
//	$fields = array_keys($form_data);
//	$sql="INSERT INTO ".$tblname."(".implode(',', $fields).")  VALUES('".implode("','", $form_data)."')";

    $sql = "INSERT INTO " . $tblname . " (Id_Producto,Descripcion,Precio_Unitario,Stock,Id_Medida) VALUES('Null','" . $_POST['Descripcion'] . "'," . $_POST['Precio_Unitario'] . "," . $_POST['Stock'] . "," . $_POST['Id_Medida'] . ")"; // Consulta para insertar un registro
    return db_query($sql); // Ejecuta la consulta

}

function delete($tblname, $field_id, $id) // Función para eliminar un registro de una tabla
{
    $sql = "delete from " . $tblname . " where " . $field_id . "=" . $id . ""; // Consulta para eliminar un registro
    return db_query($sql); // Ejecuta la consulta
}

function edit($tblname, $form_data, $field_id, $id) // Función para editar un registro de una tabla
{
    $sql = "UPDATE " . $tblname . " SET "; // Consulta para actualizar un registro
    $data = array(); // Arreglo para almacenar los datos
    foreach ($form_data as $column => $value) { // Ciclo para recorrer los datos
        $data[] = $column . "=" . "'" . $value . "'"; // Almacena los datos en el arreglo
    }
    $sql .= implode(',', $data); // Une los datos del arreglo
    // implode() une elementos de una matriz en una cadena
    $sql .= " where " . $field_id . " = " . $id . ""; // Consulta para actualizar un registro
    return db_query($sql); // Ejecuta la consulta
}

function select_id($tblname, $field_name, $field_id) // Función para seleccionar un registro de una tabla
{
    $sql = "Select * from " . $tblname . " where " . $field_name . " = " . $field_id . ""; // Consulta para seleccionar un registro
    $db = db_query($sql); // Ejecuta la consulta
    $GLOBALS['row'] = mysqli_fetch_object($db); // Almacena el registro en una variable global
    return $sql; // Retorna el resultado de la consulta
}

?>