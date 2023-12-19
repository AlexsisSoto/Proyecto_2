<!doctype html>
<html lang="es">
  <head>
    <title>Buscador de Vehiculos</title>
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
    
    <div class="container">
      <div class="card mb-4 mt-3">
        <div class="card-header">
          <span>Vehiculos</span>
        </div>

      <form action="" method="POST" id="formdebusqueda" autocomplete="off">
        
        <div class="mt-3">
          <div class="input-group">
             <input type="text" maxlength="7" name="marca" id="placa" class="form-control" placeholder="Buscar placa">
              <button type="button" class="btn btn-primary" name="buscar" id="search">Search</button>
          </div>
          <div>
            <small id="status">No hay busquedas activas</small>
          </div>
        </div>  
        <div class="mt-3">
           <label for="">Marca:</label>
           <input type="text" name="marca" id="marca" class="form-control">
        </div>
        <div class="mb-3">
           <label for="">Modelo:</label>
           <input type="text" name="modelo" id="modelo" class="form-control">
        </div>
        <div class="mb-3">
           <label for="">Color:</label>
           <input type="text" name="color" id="color" class="form-control">
        </div>
        <div class="mb-3">
           <label for="">Tipo Combustible:</label>
           <input type="text" name="tipocombustible" id="tipocombustible" class="form-control">
        </div>
        <div class="mb-3">
           <label for="">Peso:</label>
           <input type="text" name="peso" id="peso"  class="form-control">
        </div>
        <div class="mb-3">
           <label for="">Año::</label>
           <input type="text" name="afabricacion" id="afabricacion" class="form-control">
        </div>
      </form>
      </div>
    </div>
  <script>
    document.addEventListener("DOMContentLoaded",()=>{
      function $(id) {return document.querySelector(id)}

        function buscarplaca(){
           const placa =$("#placa").value
           
           if(placa!=""){
            const parameters = new FormData()
            
            parameters.append("operacion","search")
            parameters.append("placa",placa)
            $("#status").innerHTML= "Buscando por favor espere..."
            fetch(`../controllers/vehiculo.controller.php`,{
              method: "POST",
              body:   parameters,
              
            })
              .then(respuesta => respuesta.json())
              .then(datos=>{
                
                if(!datos){
                  $("#status").innerHTML="No se encontro el archivo"
                 $("#formdebusqueda").reset()
                 $("#placa").focus()
                }else{
                  $("#status").innerHTML="Vehiculo encontrado"
                $("#marca").value=datos.marca
                $("#modelo").value=datos.modelo
                $("#color").value=datos.color
                $("#tipocombustible").value=datos.tipocombustible
                $("#peso").value=datos.peso
                $("#afabricacion").value=datos.afabricacion
                }
              })
              .catch(e=> {
                console.error(e)
              })
           }
        }
        

        $("#placa").addEventListener("keypress",(event)=>{
          if(event.keyCode ==13){
            buscarplaca()
          }
        })


        $("#search").addEventListener("click", buscarplaca)
    })
  </script>
  </body>
</html>
