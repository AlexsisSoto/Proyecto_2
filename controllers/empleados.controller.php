<?php

require_once '../models/empleados.php';

// Operacion para listar a los empleados 
if(isset($_POST['operacion'])){
    $empleado = new Empleado();

    switch($_POST['operacion']){
        case 'search':{
        
                // instanciar la clase
                $respuesta = $empleado->search(["ndocumento" => $_POST['ndocumento']]);
                sleep(3);
                echo json_encode($respuesta);
         break;
        }
        
        case 'add':{
          
                $datosrecibidos = [
                    "idsede"      => $_POST["idsede"],
                    "apellidos"   => $_POST["apellidos"],
                    "nombres"     => $_POST["nombres"],
                    "ndocumento"  => $_POST["ndocumento"],
                    "fechanac"    => $_POST["fechanac"],
                    "telefono"    => $_POST["telefono"]
                ];
                $idobtenido= $empleado->add($datosrecibidos);
                echo json_encode($idobtenido);
        
          break;   
        }        
        
       }

}



?>
