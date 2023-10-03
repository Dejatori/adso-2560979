<?php
// Incluir la clase de conexión a la base de datos
require_once 'clase_conexion.php';

// Insertar y actualizar datos en la base de datos
if ($condicion1 && $condicion2 && $condicion3) { // Si se cumplen las condiciones, se ejecuta el código

    // Instanciar la clase de conexión y conectar a la base de datos
    $pdo = new Conexion();
    $conexion = $pdo->conectar();

    // Insertar datos en la tabla y actualizar si ya existe
    $sql = "INSERT INTO table (columna1, columna2, columna3, columna4, columna5)
        VALUES ('$dato1', '$dato2', '$dato3', '$dato4', '$fecha_actualización')
        ON DUPLICATE KEY UPDATE
        columna1 = '$columna1',
        columna2 = '$columna2',
        columna3 = '$columna3',
        columna4 = '$columna4',
        columna5 = DATE_SUB(NOW(), INTERVAL 5 HOUR),";

    // Preparar la consulta SQL
    $stmt = $conexion->prepare($sql);
    // Ejecutar la consulta SQL
    $stmt->execute();

    // Actualizar datos en la tabla si se cumple la condición
    if ($columna1 == 'X_condicion') {
        // UPDATE: actualiza los datos de la tabla
        $sql = "UPDATE tabla2 SET columna1 = 'nueva_condicion', columna2 = (SELECT columna3 FROM table3 WHERE columna3 = '$dato3') WHERE columna3 = '$dato3'";
        $stmt = $conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->execute(); // Ejecutar la consulta SQL

    } else { // Si no se cumple la condición, se ejecuta el código
        header('Location: /configuracion.php'); // Redireccionar a la página de configuración
        sleep(5); // sleep: detiene la ejecución del script por 5 segundos
        exit(); // Termina la ejecución del script
    }
} else { // Si no se cumplen las condiciones, se ejecuta el código
    header('Location: /configuracion.php'); // Redireccionar a la página de configuración
    sleep(5); // sleep: detiene la ejecución del script por 5 segundos
    exit(); // Termina la ejecución del script
}
?>