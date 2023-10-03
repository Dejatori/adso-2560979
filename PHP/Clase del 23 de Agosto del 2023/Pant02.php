<!-- Formulario para la pantalla 02 -->
<form action="Pant03.php" method="post"> <!-- Se envia a la pantalla 03 -->
    <p>Pantalla 02</p>
    <p>Dato Dos: <input type="text" name="datoDos"/></p>  <!-- Se captura el dato dos -->

    <p><input type="button" value="Regresar" onClick="javascript:history.go(-1)"/></p> <!-- Regresa a la pantalla 01 -->
    <p><input type="submit" value="Siguiente"/></p> <!-- Se envia a la pantalla 03 -->
</form>