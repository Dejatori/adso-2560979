<?php
#Salir si alguno de los datos no está presente

// Si no se recibe el Id_Persona, el Nombre, el Apellido, el Id_TipoDcto o el Nro_Dcto por POST, el script termina usando "exit();"
if (!isset($_POST["Id_Persona"]) || !isset($_POST["Nombre"]) || !isset($_POST["Apellido"]) || !isset($_POST["Id_TipoDcto"]) || !isset($_POST["Nro_Dcto"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php"; // Incluimos el archivo de conexión a la base de datos

// Obtener los valores que el usuario escribió en el formulario
$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$Id_TipoDcto = $_POST["Id_TipoDcto"];
$Nro_Dcto = $_POST["Nro_Dcto"];

// Consulta para obtener a la persona con el Nro_Dcto recibido por POST
$consulta = "SELECT Id_Persona, Nombre, Apellido, Id_TipoDcto, Nro_Dcto FROM personas Where Nro_Dcto = ?;";
$sentencia = $base_de_datos->prepare($consulta); // Preparamos la consulta
$sentencia->execute([$Nro_Dcto]); // Ejecutamos la consulta
$persona = $sentencia->fetch(PDO::FETCH_OBJ); // Obtenemos la primera persona usando la extensión PDO::FETCH_OBJ
if ($persona === FALSE) { // Si no existe alguna persona con ese Nro_Dcto, se ejecuta esta parte del código
    #No existe
    /*
    Al incluir el archivo "base_de_datos.php", todas sus variables están
    a nuestra disposición. Por lo que podemos acceder a ellas tal como si hubiéramos
    copiado y pegado el código
    */

    // Preparamos la consulta para insertar los datos de la persona con el Nro_Dcto recibido por POST
    $sentencia = $base_de_datos->prepare("INSERT INTO personas(Nombre, Apellido, Id_TipoDcto, Nro_Dcto) VALUES (?, ?, ?, ?);");
    $resultado = $sentencia->execute([$Nombre, $Apellido, $Id_TipoDcto, $Nro_Dcto]); # Pasar en el mismo orden de los ?

    #execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
    #Con eso podemos evaluar

    // Si la consulta se ejecutó correctamente, mostramos un mensaje de éxito y redireccionamos a la lista de personas
    if ($resultado === TRUE) {
        echo "Insertado correctamente";
        header("location:listarPersonas_PDO.php");
    } // Si la consulta no se ejecutó correctamente, mostramos un mensaje de error y redireccionamos a la lista de personas
    else {
        echo "Algo salió mal. Por favor verifica que la tabla exista";
        header("location:listarPersonas_PDO.php");
    }
} // Si existe alguna persona con ese Nro_Dcto, se ejecuta esta parte del código
else {
    // Mostramos un mensaje de error y redireccionamos a la lista de personas
    echo "¡Ya existe una persona con ese Número de Documento!";
    header("location:listarPersonas_PDO.php");
    exit(); // Terminamos la ejecución del script
}
?>