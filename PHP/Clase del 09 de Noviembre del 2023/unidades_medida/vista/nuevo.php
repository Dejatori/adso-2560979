<?php
// Requiere el header
require_once("layouts/header.php");
?>
<!-- Formulario para crear un nuevo registro -->
<h1 class="text-center">NUEVO</h1>
<form action="" method="get">
    <input type="text" placeholder="Descripcion:" name="Descripcion"> <br>
    <input type="text" placeholder="Abreviatura:" name="Abreviatura"> <br>
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
    <input type="hidden" name="m" value="guardar">
</form>

<?php
// Requiere el footer
require_once("layouts/footer.php");