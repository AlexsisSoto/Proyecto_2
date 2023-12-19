<?php
// Incconpora el archivo externo 1 sola vez
// Si detecta un error, se detiene
  require_once '../models/vehiculo.php';
// recibir paticiones
// Realiza el proceso (modelo)
// Devolver un resultado (JSON)
// tas = tarea
// KEY = VALUE  
// ISSET() : verifica si existe objeto
if(isset($_POST['operacion'])){
  $vehiculo = new Vehiculo();

  if($_POST['operacion']=='search'){

    //  instanciar  la clase
    
    
    $respuesta=$vehiculo->search(["placa"=>$_POST['placa']]);
    sleep(3);
    echo json_encode($respuesta);
    }
  

  //nuevo proceso 
  if ($_POST['operacion']=='add'){
      // almacenar datos de la vista en u arreglo 
       $datosrecibidos=[
         "idmarca"        =>$_POST["idmarca"],
         "modelo"         => $_POST["modelo"],
         "color"          =>$_POST["color"],
         "tipocombustible"=>$_POST["tipocombustible"],
         "peso"           =>$_POST["peso"],
         "afabricacion"   =>$_POST["afabricacion"],
         "placa"          => $_POST["placa"]
       ];
       // enviamos el arreglo como paramentrpo del metood add
       $idobtenido= $vehiculo->add($datosrecibidos);
       echo json_encode($idobtenido);
  }
}
if(isset($_GET['operacion'])){
  $vehiculo= new Vehiculo();
  if($_GET['operacion']=='getResumenTipoCombustible'){
    echo json_encode($vehiculo->getResumenTipoCombustible());
  }
}
