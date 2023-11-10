<?php
class Modelo{
    
    private $Modelo; // Inicializar como array => Aquí se pueden guardar los datos de la consulta

    private $db;    // Inicializar como PDO => Aquí se guarda la conexión a la base de datos
    
    private $datos;    // Inicializar como array => Aquí se guardan los datos de la consulta

    // Constructor que crea la conexión a la base de datos
    public function __construct(){
        // Este array puede usarse para guardar los datos de la consulta
        $this->Modelo = array();
        // Inicializar como PDO => Aquí se guarda la conexión a la base de datos
        $this->db = new PDO('mysql:host=localhost;dbname=despachos;port=3310',"root","");
    }

    // Función para insertar datos en la base de datos (Requiere el nombre de la tabla y los datos a insertar)
    public function insertar($tabla, $data){

        // La consulta es INSERTAR DENTRO DE LA TABLA TAL LOS VALORES NULL(Es el ID) Y LOS VALORES DE DATA
        $consulta="insert into ".$tabla." values(null,". $data .")";
        // Ejecutar la consulta
        $resultado=$this->db->query($consulta);
        // Si la consulta se ejecuta correctamente, retorna true
        if ($resultado) {
            return true;
            // Sino retorna false
        }else {
            return false;
        }
     }

     // Función para mostrar datos de la base de datos (Requiere el nombre de la tabla y la condición) Si no hay condición se muestra todo
     public function mostrar($tabla,$condicion){
        // La consulta es SELECCIONAR TODO DE LA TABLA TAL DONDE LA CONDICION
        $consul="select * from ".$tabla." where ".$condicion.";"; // Ejemplo: select * from Unidades_Medida where 1;
        // Ejecutar la consulta
        $resu=$this->db->query($consul);
        // Mientras existan filas
        while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {
            // Guardar los datos en el array datos
            $this->datos[]=$filas;
        }
        // Retornar los datos
        return $this->datos;
    } 

    // Función para actualizar datos de la base de datos (Requiere el nombre de la tabla, los datos a actualizar y la condición)
    public function actualizar($tabla, $data, $condicion){
        // La consulta es ACTUALIZAR LA TABLA TAL CON LOS VALORES DE DATA DONDE LA CONDICION
        $consulta="update ".$tabla." set ". $data ." where ".$condicion; // Ejemplo: update Unidades_Medida set Descripcion='Kilogramo',Abreviatura='Kg' where Id_Unidad=1
        // Ejecutar la consulta
        $resultado=$this->db->query($consulta);
        // Si la consulta se ejecuta correctamente, retorna true
        if ($resultado) {
            return true;
            // Sino retorna false
        }else {
            return false;
        }
    }

    // Función para eliminar datos de la base de datos (Requiere el nombre de la tabla y la condición)
    public function eliminar($tabla, $condicion){
        // La consulta es ELIMINAR DE LA TABLA TAL DONDE LA CONDICION
        $eli="delete from ".$tabla." where ".$condicion; // Ejemplo: delete from Unidades_Medida where Id_Unidad=1
        // Ejecutar la consulta
        $res=$this->db->query($eli);
        // Si la consulta se ejecuta correctamente, retorna true
        if ($res) {
            return true; 
            // Sino retorna false
        }else {
            return false;
        }
    }
}