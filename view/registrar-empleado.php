<!doctype html>
<html lang="en">
  <head>
    
    <title>Title</title>
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
        <div class="card-header mg-primary">
          <h5>Registro de Vehiculos</h5>
          <span> Registro de Vehiculos</span>
        </div>

      <form action="" method="POST" id="formempleado" >
        
        <div class="mt-3">
          <div class="input-group">
                

          </div>
         
        </div> 
        <div class="mb-3">
          <label for="">Marca:</label>
            <select name="" id="sede" class="form-control" required>
               <option value="">Seleccione...</option>
            </select>
        </div> 
        <div class="mb-3">
           <label for="">Apellidos:</label>
           <input type="text" name="" id="apellidos" class="form-control"required>
        </div>
        <div class="mb-3">
           <label for="">Nombres:</label>
           <input type="text" name="" id="nombres" class="form-control"required>
        </div>
      

            <div class=" mb-3">
               <label for="">Numero documento:</label>
               <input type="text" name="" id="ndocumento"  class="form-control "required>
            </div>
            <div class=" mb-3">
               <label for="">Fecha de nacimiento:</label>
               <input type="date" name="" id="fechanac" class="form-control "required>
            </div>
            <div class=" mb-3">
               <label for="">Telefono:</label>
               <input type="text" name="" id="telefono" class="form-control " required>
            </div>
           <div class="mb-3 text-end">
              <button type="submit" class="btn btn-primary" id="guardar">Guardar Datos</button>
              <button type="button" class="btn btn-secondary">Cancelar</button>

  

        </div>
      </form>
      </div>
    </div>
    <script>
     document.addEventListener("DOMContentLoaded",()=>{
      function $(id) {return document.querySelector(id)}
      // funcion auto ejecutada
      (function(){
          fetch(`../controllers/sede_controller.php?operacion=listar`)
            .then(respuesta =>respuesta.json())
            .then(datos =>{
               console.log(datos)
               datos.forEach(element => {
                 const tagoption=document.createElement("option")
                 tagoption.value=element.idsede
                 tagoption.innerHTML=element.sede
                 $("#sede").appendChild(tagoption)
               });
            })
            .catch(e=>{
              console.error(e)
            })

           
      })();
     $("#formempleado").addEventListener("submit",()=>{
      // evitamos el envio por Action
        event.preventDefault(); 
        // Enviare por AJAX(fetch)
        if(confirm("¿Desea registrar el Empleado?"))  {

          const parametros=new FormData()

          parametros.append("operacion","add")   //Importante
          // a partir de este punto las varaibles que requiere el SPU
          parametros.append("idsede",    $("#sede").value)
          parametros.append("apellidos", $("#apellidos").value)
          parametros.append("nombres",   $("#nombres").value)
          parametros.append("ndocumento",$("#ndocumento").value)
          parametros.append("fechanac",  $("#fechanac").value)
          parametros.append("telefono",   $("#telefono").value)
          

           fetch(`../controllers/empleados.controller.php`,{
            method: "POST",
            body: parametros
           })
            .then(respuesta => respuesta.json())
            .then(datos=>{
              
                if(datos.idsede>0){
                       $("#formempleado").reset()
                       alert(`Vehiculo registrado con el ID:${datos.idsede}`)
                }
              
              console.log(datos) //"que de vuelva la clave primaria"
              alert("Proceso terminado correctamente")
            })
            .catch(e =>{
              console.error(e)
            })
        }
      })
    })
    </script>
  </body>
</html>
