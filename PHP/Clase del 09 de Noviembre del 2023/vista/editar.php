<?php
require_once("layouts/header.php");
?>
<h1 class="text-center">EDITAR</h1>
<form action="" method="get">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <input type="text" value="<?php echo $v['Descripcion'] ?>" name="Descripcion"> <br>
        <input type="text" value="<?php echo $v['Abreviatura'] ?>" name="Abreviatura"> <br>
        <input type="hidden" value="<?php echo $v['Id_Unidad'] ?>" name="Id_Unidad"> <br>
        <input type="submit" class="btn" name="btn" value="ACTUALIZAR"> <br>
        <input type="hidden" name="m" value="actualizar">
        <?php
        endforeach;
    endforeach;
    ?>
</form>

<?php
require_once("layouts/footer.php");