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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    
    <div class="container">
      <div class="card mb-4 mt-3">
        <div class="card-header mg-primary">
          <h5>Registro de Vehiculos</h5>
          <span> Registro de Vehiculos</span>
        </div>

      <form action="" method="POST" id="formvehiculo" >
        
        <div class="mt-3">
          <div class="input-group">
                

          </div>
         
        </div> 
        <div class="mb-3">
          <label for="">Marca:</label>
            <select name="" id="marca" class="form-control" required>
               <option value="">Seleccione...</option>
            </select>
        </div> 
        <div class="mb-3">
           <label for="">Modelo:</label>
           <input type="text" name="modelo" id="modelo" class="form-control"required>
        </div>
        <div class="mb-3">
           <label for="">Color:</label>
           <input type="text" name="color" id="color" class="form-control"required>
        </div>
        <div>
          <label for="">Tipo de Combustible:</label>
          <select name="" id="tipocombustible" class="form-control" required>
            <option value="">Seleccione...</option>
            <option value="GSL">Gasolina</option>
            <option value="DSL">Disiel</option>
            <option value="GNV">Gas Natural</option>
            <option value="GLP">Gas licuado de petroleo</option>
           </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
               <label for="">Peso:</label>
               <input type="number" name="peso" id="peso"  class="form-control text-end"required>
            </div>
            <div class="col-md-4 mb-3">
               <label for="">Año:</label>
               <input type="number" name="afabricacion" id="afabricacion" class="form-control text-end"required>
            </div>
            <div class="col-md-4 mb-3">
               <label for="">Placa:</label>
               <input type="text" name="afabricacion" id="placa" class="form-control text-center" maxlength="7"required>
            </div>
           <div class="mb-3 text-end">
              <button type="submit" class="btn btn-primary" id="guardar">Guardar Datos</button>
              <button type="button" class="btn btn-secondary">Cancelar</button>

            </div>

        </div>
      </form>
      </div>
    </div>
  <script>
    document.addEventListener("DOMContentLoaded",()=>{
      function $(id) {return document.querySelector(id)}
      // funcion auto ejecutada
      (function(){
          fetch(`../controllers/marca.controller.php?operacion=listar`)
            .then(respuesta =>respuesta.json())
            .then(datos =>{
               console.log(datos)
               datos.forEach(element => {
                 const tagoption=document.createElement("option")
                 tagoption.value=element.idmarca
                 tagoption.innerHTML=element.marca
                 $("#marca").appendChild(tagoption)
               });
            })
            .catch(e=>{
              console.error(e)
            })

           
      })();
     $("#formvehiculo").addEventListener("submit",()=>{
      // evitamos el envio por Action
        event.preventDefault(); 
        // Enviare por AJAX(fetch)
        if(confirm("¿Desea registrar el vehiculo?"))  {

          const parametros=new FormData()

          parametros.append("operacion","add")   //Importante
          // a partir de este punto las varaibles que requiere el SPU
          parametros.append("idmarca",$("#marca").value)
          parametros.append("modelo",$("#modelo").value)
          parametros.append("color",$("#color").value)
          parametros.append("tipocombustible",$("#tipocombustible").value)
          parametros.append("peso",$("#peso").value)
          parametros.append("afabricacion",$("#afabricacion").value)
          parametros.append("placa",$("#placa").value)

           fetch(`../controllers/vehiculo.controller.php`,{
            method: "POST",
            body: parametros
           })
            .then(respuesta => respuesta.json())
            .then(datos=>{
              
                if(datos.idvehiculo>0){
                       $("#formvehiculo").reset()
                       alert(`Vehiculo registrado con el ID:${datos.idvehiculo}`)
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
