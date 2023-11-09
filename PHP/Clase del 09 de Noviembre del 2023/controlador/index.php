<?php
require_once("modelo/index.php");
class modeloController{
    private $model;
    public function __construct(){
        $this->model = new Modelo();
    }
    // mostrar
    static function index(){
        $Unidades_Medida   = new Modelo();
        $dato       =   $Unidades_Medida->mostrar("Unidades_Medida","1");
        require_once("vista/index.php");
    }
    //nuevo
    static function nuevo(){        
        require_once("vista/nuevo.php");
    }
    //guardar
    static function guardar(){
        $Descripcion= $_REQUEST['Descripcion'];
        $Abreviatura= $_REQUEST['Abreviatura'];
        $data = "'".$Descripcion."','".$Abreviatura."'";
        $Unidades_Medida = new Modelo();
        $dato = $Unidades_Medida->insertar("Unidades_Medida",$data);
        header("location:".urlsite);
    }



    //editar
    static function editar(){    
        $Id_Unidad = $_REQUEST['Id_Unidad'];
        $Unidades_Medida = new Modelo();
        $dato = $Unidades_Medida->mostrar("Unidades_Medida","Id_Unidad=".$Id_Unidad);        
        require_once("vista/editar.php");
    }
    //actualizar
    static function actualizar(){
        $Id_Unidad = $_REQUEST['Id_Unidad'];
        $Descripcion= $_REQUEST['Descripcion'];
        $Abreviatura= $_REQUEST['Abreviatura'];
        $data = "Descripcion='".$Descripcion."',Abreviatura='".$Abreviatura."'";
        $Unidades_Medida = new Modelo();
        $dato = $Unidades_Medida->actualizar("Unidades_Medida",$data,"Id_Unidad=".$Id_Unidad);
        header("location:".urlsite);
    }


    //eliminar
    static function eliminar(){    
        $Id_Unidad = $_REQUEST['Id_Unidad'];
        $Unidades_Medida = new Modelo();
        $dato = $Unidades_Medida->eliminar("Unidades_Medida","Id_Unidad=".$Id_Unidad);
        header("location:".urlsite);
    }


}