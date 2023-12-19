<?php
// acceso al archivo
require 'conexion.php';
// heredar los archivos y metodos
class Marcas extends Conexion{
  // este objeto alamacenara la conexion y se facilicitara a todos los metodos
  private $pdo;
  public function __construct()
  {
   $this->pdo=parent::getConexion(); 
  }


  public function getAll()
  {
    try
    {
        $consulta=$this->pdo->prepare("CALL spu_marcas_listar()");
        $consulta->execute();
        
        return $consulta->fetchAll(PDO::FETCH_ASSOC);

    }catch(Exception $e){
      die($e->getMessage());
     }
    {

    }
 
  }

}





