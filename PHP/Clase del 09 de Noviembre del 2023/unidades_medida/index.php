<?php
// Añade el archivo de configuración
require_once("config.php");
// Añade el controlador principal
require_once("controlador/index.php");

// Si se envia un formulario por metodo GET con el parametro m
if(isset($_GET['m'])):    
    // Si existe el metodo en el controlador
    if(method_exists("modeloController",$_GET['m'])):
        // El controlador llama al metodo
        modeloController::{$_GET['m']}();
    endif;
    // Si no existe el metodo en el controlador
else:
    // El controlador llama al metodo index
    modeloController::index();
endif;
