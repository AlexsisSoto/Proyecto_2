<?php
// acceso al archivo
require 'conexion.php';
// heredar los archivos y metodos
class Vehiculo extends Conexion{
  // este objeto alamacenara la conexion y se facilicitara a todos los metodos
  private $pdo;
  public function __construct()
  {
   $this->pdo=parent::getConexion(); 
  }
  
  public function add($data=[]){

    try{
      $consulta=$this->pdo->prepare("CALL spu_vehiculos_registrar(?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $data['idmarca'],
          $data['modelo'],
          $data['color'],
          $data['tipocombustible'],
          $data['peso'],
          $data['afabricacion'],
          $data['placa']
        )
      );
      // actualizacion, ahora retornamos el "idvehiculo
      return $consulta->fetch(PDO::FETCH_ASSOC);

    }catch(Exception $e){
      die($e->getMessage());
    }
   }



  public function search($data =[])
  {
   
    try
    {
        $consulta=$this->pdo->prepare("CALL spu_vehiculos_listar(?)");
        $consulta->execute(
          array($data['placa'])
        );
        // devolver el registro terminado
        // fetch      : retorno la primera concidencia(1)
        // fetchall   : retorna todas las concidencias
        // fetch_assoc: define el resultado como un objeto
        //  
        return $consulta->fetch(PDO::FETCH_ASSOC);

    }catch(Exception $e){
      die($e->getMessage());
     }
    {

    }
 
  }
  public function getResumenTipoCombustible()
  {
    try
    {
        $consulta=$this->pdo->prepare("CALL spu_resumen_tipocombustible()");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e)
    {
        die($e-> getMessage());
    }

  }

}
/*
$vehichulo = new Vehiculo();
$registro=$vehichulo->search(["placa"=>"ABC-111"]);
var_dump($registro);
*/

