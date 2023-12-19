<?php

// apellidos
/*$apellidos=" Soto";
$nombres="Alexis leonel";
define("DNI","63030049");

echo $apellidos."".$nombres."".DNI;
*/
// ARREGLO

// Arreglo 1
/*$amigo= array("Karina","Melissa","Vania","Emily","Sheyla");
// funcion imprime: tipo,longitud, dato(DEBUG)
// var_dump($amigos)
foreach($amigo as $A){
    echo $A;
}
*/
// Arreglo (2) Multi-dimensional 
/*$software=[
  ["Eset","Avast","Avira"],
  ["Warzone","GOW","FreeFire"],
  ["VisualCode","NetBeans"]
];



foreach ($software as $soft){
  foreach ($soft as $so){
          echo $so ."<br>";
  }
}

// Arreglo 3 Asociativo (sin indice)
$catalogo = [

  "SO"         => "Windows",
  "antivirus"  => "Panda",
  "utiliario"  => "Winrar",
  "videojuego" => "MarioBrows"

];

echo $catalogo["utiliario"];
*/
// Arreglo 4->mutidimensional + asociativo

$desarrrollador=[
  "datospersonales" =>[
    "apellidos"=> "Soto",
    "nombres " =>"ALEXSIS",
    "edad"    =>"18",
    "telefonos"=>["123456789","987654321"]
  ],
  "formacion"       =>[
    "inicial"       =>["Beata Melchorita"],
    "Primaria"      =>["Tupac Amaru","Beata Melchorita"],
    "Secundaria"    =>["9 de Diciembre"]
  ],
  "hablidades"      =>[
    "DB"   =>["MYSQL","MSSQL","MOngoDB"],
    "Framework"     =>["Lavarel","CodeIgniter"]
  ]
];
echo "<pre>";
var_dump($desarrrollador);
echo "</pre>";
echo json_encode($desarrrollador);
?>