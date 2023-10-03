<?php
include_once "base_de_datos.php"; // Incluimos el archivo de conexión a la base de datos

// Consulta para obtener los tipos de documentos
$TiposDctos = "SELECT Id_TipoDcto, Descripcion FROM Tipo_Documento";
$TipDtos = $base_de_datos->prepare($TiposDctos, [ // Preparamos la consulta
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL, // Necesitamos que el cursor sea de tipo scroll para poder recorrer los resultados
]);
$TipDtos->execute(); // Ejecutamos la consulta

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar persona</title>
</head>
<body>
<form method="post" action="nuevaPersona.php"> <!-- Este formulario envía los datos a guardarDatos.php -->
    <h1>PERSONAS</h1>
    <br><br>
    <table border="1" width="50%">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Tipo Dcto</th>
            <th># Dcto</th>
        </tr>
        <tr>
            <input type="hidden" name="Id_Persona" placeholder="Id_Persona">
            <!-- Este campo es invisible pero es necesario para guardar el Id_Persona de la persona a editar -->
            <td><input name="Nombre" required type="text" id="Nombre" placeholder="Nombre"></td>
            <!-- El campo "Nombre" tiene como valor por defecto el nombre de la persona a editar -->
            <td><input name="Apellido" required type="text" id="Apellido" placeholder="Apellido"></td>
            <!-- El campo "Apellido" tiene como valor por defecto el apellido de la persona a editar -->
            <td>
                <select name="Id_TipoDcto" id="Id_TipoDcto">
                    <!-- El campo "Id_TipoDcto" tiene como valor por defecto el Id_TipoDcto de la persona a editar -->
                    <?php while ($TD = $TipDtos->fetchObject()) { // Recorremos los resultados de la consulta y los mostramos en un elemento select
                        echo "<option value=" . $TD->Id_TipoDcto . " >" . $TD->Descripcion . "</option>"; // Si el Id_TipoDcto de la persona a editar no es igual al Id_TipoDcto del tipo de documento que se está recorriendo, se muestra ese tipo de documento en el elemento select
                    }
                    ?>
                </select>
            </td>
            <td><input name="Nro_Dcto" type="text" placeholder="Nro_Dcto"></td>
            <!-- El campo "Nro_Dcto" tiene como valor por defecto el Nro_Dcto de la persona a editar -->
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <input type="submit" name="submit" value="Guardar cambios">
                <!-- Este botón envía los datos a guardarDatosEditados.php -->
            </td>
        </tr>
</form>
</table>
<br><br>
</form>
</body>
</html>