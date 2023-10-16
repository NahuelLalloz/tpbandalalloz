<?php

class PeliView {
    public function showPeli($peliculas, $servicios) {
        $count = count($peliculas);

        require 'app/templates/inicio.phtml';
    }
    public function PeliView($peliculas, $servicios){
        $count = count($peliculas);
        require 'app/templates/peliDetalles.phtml';
        
      }
      function showError($msg){
        echo "<h1>Error</h1>";
         echo "<h2>$msg</h2>";
     }
     function ShowHomeLocation(){
         header("Location: ".BASE_URL."home");
     }

     function ShowErrorDuplicado (){
      require 'app/templates/error.phtml';
     }
   
}