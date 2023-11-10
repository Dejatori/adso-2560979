<?php
// Requiere el modelo principal
require_once("modelo/index.php");

// Clase controlador principal
class modeloController{

    // Inicializa la variable model como privada
    private $model;

    // Constructor de la clase
    public function __construct(){
        $this->model = new Modelo();
    }

    // Mostrar el contenido de la tabla
    static function index(){
        // Instancia el modelo
        $Unidades_Medida   = new Modelo();
        // Ejecuta el metodo mostrar
        $dato       =   $Unidades_Medida->mostrar("Unidades_Medida","1"); // Ejemplo: SELECT * FROM Unidades_Medida WHERE 1
        // Requiere la vista index
        require_once("vista/index.php");
    }
    // Nuevo registro
    static function nuevo(){        
        // Requiere la vista nuevo
        require_once("vista/nuevo.php");
    }

    // Guardar registro
    static function guardar(){
        //Obtiene los datos del formulario
        $Descripcion= $_REQUEST['Descripcion']; // Ejemplo: $_POST['Descripcion'] = "Kilogramo";
        $Abreviatura= $_REQUEST['Abreviatura']; // Ejemplo: $_POST['Abreviatura'] = "Kg";
        // Crea un string con los datos
        $data = "'".$Descripcion."','".$Abreviatura."'"; // Ejemplo: 'Kilogramo','Kg'
        // Instancia el modelo
        $Unidades_Medida = new Modelo();
        // Ejecuta el metodo insertar
        $dato = $Unidades_Medida->insertar("Unidades_Medida",$data); // Ejemplo: INSERT INTO Unidades_Medida VALUES ('Kilogramo','Kg')
        // Redirecciona a la vista principal
        header("location:".urlsite); // Ejemplo: header("location:http://localhost/Despachos/");
    }

    // Editar registro - Enrealidad es mostrar registro que cumpla con una condición
    static function editar(){    
        // Obtiene el Id_Unidad del registro
        $Id_Unidad = $_REQUEST['Id_Unidad']; // Ejemplo: $_GET['Id_Unidad'] = 1;
        // Instancia el modelo
        $Unidades_Medida = new Modelo();
        // Ejecuta el metodo mostrar
        $dato = $Unidades_Medida->mostrar("Unidades_Medida","Id_Unidad=".$Id_Unidad); // Ejemplo: SELECT * FROM Unidades_Medida WHERE Id_Unidad=1
        require_once("vista/editar.php"); // Requiere la vista editar
    }

    // Actualizar registro
    static function actualizar(){
        // Obtiene los datos del formulario
        $Id_Unidad = $_REQUEST['Id_Unidad']; // Ejemplo: $_POST['Id_Unidad'] = 1;
        $Descripcion= $_REQUEST['Descripcion']; // Ejemplo: $_POST['Descripcion'] = "Kilogramo";
        $Abreviatura= $_REQUEST['Abreviatura']; // Ejemplo: $_POST['Abreviatura'] = "Kg";
        // Crea un string con los datos
        $data = "Descripcion='".$Descripcion."',Abreviatura='".$Abreviatura."'"; // Ejemplo: Descripcion='Kilogramo',Abreviatura='Kg'
        // Instancia el modelo
        $Unidades_Medida = new Modelo();
        // Ejecuta el metodo actualizar
        $dato = $Unidades_Medida->actualizar("Unidades_Medida",$data,"Id_Unidad=".$Id_Unidad); // Ejemplo: UPDATE Unidades_Medida SET Descripcion='Kilogramo',Abreviatura='Kg' WHERE Id_Unidad=1
        header("location:".urlsite); // Redirecciona a la vista principal
    }


    // eliminar
    static function eliminar(){
        // Obtiene el Id_Unidad del registro
        $Id_Unidad = $_REQUEST['Id_Unidad']; // Ejemplo: $_GET['Id_Unidad'] = 1;
        // Instancia el modelo
        $Unidades_Medida = new Modelo();
        // Ejecuta el metodo eliminar
        $dato = $Unidades_Medida->eliminar("Unidades_Medida","Id_Unidad=".$Id_Unidad); // Ejemplo: DELETE FROM Unidades_Medida WHERE Id_Unidad=1
        header("location:".urlsite); // Redirecciona a la vista principal
    }


}