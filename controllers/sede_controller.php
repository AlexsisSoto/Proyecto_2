<?php
 require_once '../models/sede.php';

 if(isset($_GET['operacion'])){
  $sede = new Sede();
  if($_GET['operacion']=='listar'){
    $resultado=$sede->getAll();
    echo json_encode( $resultado);
  }
 }

