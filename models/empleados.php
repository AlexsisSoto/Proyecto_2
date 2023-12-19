<?php
    require_once '../models/conexion.php';

  class Empleado extends conexion{

    private $pdo;

    public function __construct()
    {
     $this->pdo=parent::getConexion();
    }
        public function search($data =[])
        {
        
          try
          {
              $consulta=$this->pdo->prepare("CALL spu_empleados_listar(?)");
              $consulta->execute(
                array($data['ndocumento'])
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
         
         
        }
      
    public function add($data=[]){
       try{
            $consulta=$this->pdo->prepare("CALL spu_empleados_registrar(?,?,?,?,?,?)");
            $consulta->execute(
              array(
                $data['idsede'],
                $data['apellidos'],
                $data['nombres'],
                $data['ndocumento'],
                $data['fechanac'],
                $data['telefono']
                
              )
            );
           
            return $consulta->fetch(PDO::FETCH_ASSOC);
        
       }catch(Exception $e){
        die($e->getMessage());
       }
    }
    
}

  