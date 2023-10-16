<?php
include_once "app/models/streamingmodels.php";
include_once "app/views/streamingview.php";
include_once "app/models/pelimodels.php";

class StreamingController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new StreamingModel();
        $this->view = new StreamingView();
    }

    public function showStreaming() {
        $servicios = $this->model->getStreaming();
        $this->view->showStreaming($servicios);
    }

    function deleteServicio($id_servicio_streaming) {
        try {
            $result = $this->model->deleteServicioById($id_servicio_streaming);
            if ($result !== false) {
                header("Location: " . BASE_URL . "home");
            }
        } catch (PDOException $e) {
            header("refresh:10;url=" . BASE_URL . "home");
            $this->view->ShowErrorAsociado("Error");
        }
    }

    function addServicio() {
   
        $id_servicio_streaming = $_POST['id_servicio_streaming'];
        $nombre = $_POST['nombre'];

        try {
            if (empty($id_servicio_streaming) || empty($nombre)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
            $result = $this->model->insertServicio($id_servicio_streaming, $nombre);
            if ($result !== false) {
                header("Location: " . BASE_URL . "home");
            }
        } catch (PDOException $e) {
            header("refresh:10;url=" . BASE_URL . "home");
            $this->view->ShowErrorDuplicado("Error");
        }
    }

    function updateServicio() {
        if (!empty($_POST['nombre'])) {
            $id_servicio_streaming = $_POST['id_servicio_streaming'];
            $nombre = $_POST['nombre'];
            $this->model->updateServicioFromId($id_servicio_streaming, $nombre);
            $this->view->ShowHomeLocation();
        }
    }

    public function showStreamDetalle($id_servicio_streaming) {
        $servicio = $this->model->getStreamingiById($id_servicio_streaming);
        $this->view->StreamingView($servicio);
    }
}
  
    
        
    
       
        
        
        
        
        
        
        
        
        

