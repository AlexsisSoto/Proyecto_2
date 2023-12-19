<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>

  <body>
    <div class="container">
      <div class="card mb-4 mt-3">
        <div class="card-header">
          <span>Empleados</span>
        </div>

        <form action="" method="POST" id="formdebusqueda" autocomplete="off">
          <div class="mt-3">
            <div class="input-group">
               <input type="text" maxlength="" name="" id="ndocumento" class="form-control" placeholder="Ingresa el DNI">
                <button type="button" class="btn btn-primary" name="buscar" id="search">Search</button>
            </div>
         
          </div>  
          <div class="mt-3">
             <label for="apellidos">Apellidos:</label>
             <input type="text" name="apellidos" id="apellidos" class="form-control">
          </div>
          <div class="mb-3">
             <label for="nombres">Nombres:</label>
             <input type="text" name="nombres" id="nombres" class="form-control">
          </div>
          <div class="mb-3">
             <label for="fechanac">Fecha de nacimiento:</label>
             <input type="text" name="fechanac" id="fechanac" class="form-control">
          </div>
      
          <div class="mb-3">
             <label for="telefono">Teléfono:</label>
             <input type="text" name="telefono" id="telefono"  class="form-control">
          </div>
        </form>
      </div>
    </div>

    <script>
     document.addEventListener("DOMContentLoaded",()=>{
      function $(id) {return document.querySelector(id)}

        function buscarempleado(){
           const ndocumentos =$("#ndocumento").value
           
           if(ndocumento!=""){
            const parameters = new FormData()
            
            parameters.append("operacion","search")
            parameters.append("ndocumento",ndocumentos)
            
            
            fetch(`../controllers/empleados.controller.php`,{
              method: "POST",
              body:   parameters
              
            })
              .then(respuesta => respuesta.json())
              .then(datos=>{
                
                if(!datos){
                 
                 $("#formdebusqueda").reset()
                 $("#ndocumento").focus()
                }else{
                 
                $("#apellidos").value=datos.apellidos
                $("#nombres").value=datos.nombres
                $("#fechanac").value=datos.fechanac
                $("#ndocumento").value=datos.ndocumento
                $("#telefono").value=datos.telefono
             
                }
              })
              .catch(e=> {
                console.error(e)
              })
           }
        }
        

        $("#ndocumento").addEventListener("keypress",(event)=>{
          if(event.keyCode ==13){
            buscarempleado()
          }
        })


        $("#search").addEventListener("click", buscarempleado)
    })
    </script>
  </body>
</html>
