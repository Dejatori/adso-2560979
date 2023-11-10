<?php
// Requiere el header
require_once("layouts/header.php");
?>
<!-- Tabla para mostrar los datos -->
<a href="index.php?m=nuevo" class="btn">NUEVO</a>
<table>
    <tr>
        <td>Descripcion</td>
        <td>Abreviatura</td>
        <td>ACCIÓN</td>        
    </tr>
    <tbody>
        <?php
        // Si existen datos se muestran en la tabla
            if(!empty($dato)):
                foreach($dato as $key => $value)
                    foreach($value as $v):?>
                    <tr>
                        <td><?php echo $v['Descripcion'] ?> </td>
                        <td><?php echo $v['Abreviatura'] ?> </td>
                        <td>
                            <a class="btn" href="index.php?m=editar&Id_Unidad=<?php echo $v['Id_Unidad']?>">EDITAR</a>
                            <a class="btn" href="index.php?m=eliminar&Id_Unidad=<?php echo $v['Id_Unidad']?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            <?php else: ?>
                <tr> <!-- Si no existen datos se muestra un mensaje -->
                    <td colspan="3">NO HAY REGISTROS</td>
                </tr>
            <?php endif ?>
    </tbody>
</table>
<?php
// Requiere el footer
require_once("layouts/footer.php");