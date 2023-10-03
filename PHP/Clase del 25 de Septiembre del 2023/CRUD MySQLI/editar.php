<?php
include("function.php"); //Incluimos nuestra librería de funciones (archivo function.php)
$Id_Producto = $_GET['Id_Producto']; // Recibimos el Id_Producto a editar por medio del método GET
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
    <h1>Editar Registros con Función PHP </h1>
    <br><br>
    <?php
    select_id('Productos', 'Id_Producto', $Id_Producto); // Ejecutamos nuestra función select_id para mostrar los datos del registro a editar
    $sql = "select Id_Unidad, UM.Descripcion DescMedida from Unidades_Medida UM"; // Consulta para traer los datos de la tabla Unidades_Medida
    // (UM.Descripcion DescMedida) es un alias para el campo Descripcion de la tabla Unidades_Medida (UM)
    // El campo Id_Unidad es el campo que se mostrará en el select y el campo Descripcion es el valor que se mostrará en el select
    // Ejemplo: <option value="1">Kilogramo</option>
    $result = db_query($sql); // Ejecutamos nuestra consulta
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
                       placeholder="Id_Producto"> <!-- Creamos un campo oculto para enviar el Id_Producto -->
                <td><input name="Descripcion" type="text" value="<?php echo $row->Descripcion; ?>"
                           placeholder="Descripcion"></td> <!-- Mostramos el campo Descripcion -->
                <td><input name="Precio_Unitario" type="text" value="<?php echo $row->Precio_Unitario; ?>"
                           placeholder="Precio_Unitario"></td> <!-- Mostramos el campo Precio_Unitario -->
                <td><input name="Stock" type="text" value="<?php echo $row->Stock; ?>" placeholder="Stock"></td>
                <!-- Mostramos el campo Stock -->
                <td>
                    <select name="Id_Medida" id="Id_Medida">
                        <!-- Creamos el select para mostrar las unidades de medida -->
                        <?php while ($reg = mysqli_fetch_object($result)) { // Recorremos el resultado de nuestra consulta para mostrar los datos de la tabla Unidades_Medida
                            if (trim($row->Id_Medida) == trim($reg->Id_Unidad)) { // Comparamos el valor del campo Id_Medida de la tabla Productos con el valor del campo Id_Unidad de la tabla Unidades_Medida
                                // la función trim() elimina los espacios en blanco al inicio y al final de una cadena
                                echo "<option value=" . $reg->Id_Unidad . " SELECTED>" . $reg->DescMedida . "</option>"; // Si el valor de los campos es igual mostramos el campo seleccionado
                            } else { // Si los valores son diferentes mostramos el campo sin seleccionar
                                echo "<option value=" . $reg->Id_Unidad . " >" . $reg->DescMedida . "</option>"; // Mostramos el campo sin seleccionar
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
                <!-- Creamos el botón para enviar los datos del formulario -->
            </tr>
        </form>
    </table>

    <?php
    // Si se ha enviado el formulario con el método POST ejecutamos el siguiente código
    // La función isset() nos permite saber si una variable está definida o no
    // En este caso la usamos para saber si se ha enviado el formulario por medio del botón submit
    if (isset($_POST['submit'])) {
        $field = array("Id_Producto" => $_POST['Id_Producto'], "Descripcion" => $_POST['Descripcion'], "Precio_Unitario" => $_POST['Precio_Unitario'], "Stock" => $_POST['Stock'], "Id_Medida" => $_POST['Id_Medida']);
        // Creamos un array asociativo con los campos que vamos a editar en la tabla Productos
        // El campo Id_Producto no se edita ya que es el campo que se usa para identificar el registro a editar
        // El campo Id_Medida no se edita ya que es el campo que se usa para identificar la unidad de medida del producto
        $tbl = "Productos"; // Nombre de la tabla donde se editará el registro
        edit($tbl, $field, 'Id_Producto', $Id_Producto); // Ejecutamos la función edit y le pasamos los parámetros necesarios (tabla, array de campos, campo y valor para identificar el registro a editar)
        header("location:index.php"); // Redireccionamos a nuestro archivo index.php
    }
    ?>
</div>
</body>
</html>