

<!doctype html>
<html lang="en">
  <head>
    <title>
      
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
   
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <style>
      span{
        color: white;
        font-size: 26px;
      }
    </style>
   <div class="container">
      <div class="card mt-4">
      <div class="card-header text-center bg-primary">
       <span >Datos de Empleados</span>
      </div>
      <div class="card-body">
          <div class="mb-4 text-center">
            <a href="buscar-empleado.php" class="btn btn-primary ">Buscar Empleado</a>
            <a href="registrar-empleado.php" class="btn btn-success">Registrar Empleado</a>
            <a href="cuadro-estadistico.html" class="btn btn-warning">Cuadro estadistico</a>
          </div>
          <hr>
            <table class="table table-striped">
              <thead>
               
                
                  <th scope="col" class="text-center">N.- Documento</th>
                  <th scope="col"class="text-center">Apellidos</th>
                  <th scope="col"class="text-center">Nombres</th>
                  <th scope="col"class="text-center">Sede</th>
                  <th scope="col"class="text-center">Fecha Nacimiento</th>
                  <th scope="col"class="text-center">Telefono</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 require_once '../models/mostrar-tabla.php';
                ?>
              </tbody>
            </table>
      </div>
    </div>
    </div>  
  </body>
</html>
