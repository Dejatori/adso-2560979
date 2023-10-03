<?php
include("function.php"); //Incluye la función
$Id_Producto = $_GET['Id_Producto']; //Obtiene el Id_Producto
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Registros Mysql Mediante Funcion</title>
    <link type="text/css" href="bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="https://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 4px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .main-wrapper {
            width: 50%;

            background: #E0E4E5;
            border: 1px solid #292929;
            padding: 25px;
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
    <h1>Editar Registros con Función PHP</h1>
    <br><br>
    <?php
    select_id('Productos', 'Id_Producto', $Id_Producto); // Ejecuta la función
    $sql = "select Id_Unidad, UM.Descripcion DescMedida from Unidades_Medida UM"; // Consulta para obtener las unidades de medida
    $result = db_query($sql); // Ejecuta la consulta
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
                <input name="Id_Producto" type="hidden" value="<?php echo $row->Id_Producto; ?>"
                       placeholder="Id_Producto"> <!-- Campo oculto para el Id_Producto -->
                <td><input name="Descripcion" type="text" value="<?php echo $row->Descripcion; ?>"
                           placeholder="Descripcion"></td> <!-- Campo para la descripción -->
                <td><input name="Precio_Unitario" type="text" value="<?php echo $row->Precio_Unitario; ?>"
                           placeholder="Precio_Unitario"></td> <!-- Campo para el precio unitario -->
                <td><input name="Stock" type="text" value="<?php echo $row->Stock; ?>" placeholder="Stock"></td>
                <!-- Campo para el stock -->
                <td>
                    <select name="Id_Medida" id="Id_Medida">
                        <?php while ($reg = mysqli_fetch_object($result)) { // Ciclo para mostrar las unidades de medida
                            if (trim($row->Id_Medida) == trim($reg->Id_Unidad)) { // Compara si la unidad de medida es igual a la que se esta recorriendo
                                // trim() elimina los espacios en blanco al inicio y al final de la cadena
                                echo "<option value=" . $reg->Id_Unidad . " SELECTED>" . $reg->DescMedida . "</option>"; // Muestra la unidad de medida seleccionada
                            } else {
                                echo "<option value=" . $reg->Id_Unidad . " >" . $reg->DescMedida . "</option>"; // Muestra las unidades de medida
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
                <!-- Botón para enviar los datos -->
            </tr>
        </form>
    </table>

    <?php

    if (isset($_POST['submit'])) { // Verifica si se ha enviado el formulario
        $field = array("Id_Producto" => $_POST['Id_Producto'], "Descripcion" => $_POST['Descripcion'], "Precio_Unitario" => $_POST['Precio_Unitario'], "Stock" => $_POST['Stock'], "Id_Medida" => $_POST['Id_Medida']); // Campos a actualizar
        $tbl = "Productos"; // Tabla
        edit($tbl, $field, 'Id_Producto', $Id_Producto); // Ejecuta la función
        header("location:index.php"); // Redirecciona a la página principal
    }
    ?>
</div>
</body>
</html>