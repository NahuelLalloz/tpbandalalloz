<?php

class StreamingView{
    public function showStreaming($servicios) {
        $count = count($servicios);

        require 'app/templates/streaming.phtml';
    }
    function showError($msg){
        echo "<h1>Error</h1>";
         echo "<h2>$msg</h2>";
     }
     function ShowHomeLocation(){
        header("Location: ".BASE_URL."home");
    }
    function ShowErrorAsociado (){
        require 'app/templates/errorAsociado.phtml';
     }
     function ShowErrorDuplicado (){
        require 'app/templates/errorServicio.phtml';
       }
       public function StreamingView($servicios){
        $count = count($servicios);
        require 'app/templates/streamingDetalles.phtml';
        
      
    
       
    }

}