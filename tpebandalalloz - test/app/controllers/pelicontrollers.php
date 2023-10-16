<?php
include_once "app/models/streamingmodels.php";
include_once 'app/models/pelimodels.php';
include_once 'app/views/peliview.php';
class PeliController
{
    private $modelc;
    private $model;
    private $view;


    function __construct()
    {
        $this->modelc = new StreamingModel();
        $this->model = new PeliModel();
        $this->view = new PeliView();
    }
 
    public function showPeli()
    {
    
        $peliculas = $this->model->getPeliculas();
        $servicios= $this->modelc ->getStreaming();
        $this->view->showPeli($peliculas, $servicios);
    }
    public function showPeliDetalle($id_pelicula, $servicios)
{
    
    $peliculas = $this->model->getPeliByServicioId($id_pelicula);


    $servicios = $this->modelc->getServicioId($servicios);

   
    $this->view->PeliView($peliculas, $servicios);
}

    function deletePeli($id_pelicula)
    {
        $this->model->deletePeliById($id_pelicula);
        $this->view->ShowHomeLocation();
    }

    function addPeli()
    {
   
        $id_pelicula = $_POST['id_pelicula'];
        $nombre = $_POST['nombre'];
        $director = $_POST['director'];
        $tipo = $_POST['tipo'];
        $genero = $_POST['genero'];
        $servicio_fk = $_POST['servicio_fk'];


        try {
            if (empty($nombre) || empty($director) || empty($id_pelicula) || empty($servicio_fk) || empty($tipo) || empty($genero)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
            $result = $this->model->insertPeli($id_pelicula, $nombre, $director, $tipo, $genero, $servicio_fk);
            if ($result !== false) {


                header("Location: " . BASE_URL . "home");
            }
        } catch (PDOException $e) {
            header("refresh:10;url=" . BASE_URL . "home");
            $this->view->ShowErrorDuplicado("Redireccion");
        }
    }
    function updatePeli()
    {

        $id_pelicula = $_POST['id_pelicula'];
        $nombre = $_POST['nombre'];
        $director = $_POST['director'];
        $tipo = $_POST['tipo'];
        $genero = $_POST['genero'];
        $servicio_fk = $_POST['servicio_fk'];
        

        try {
            if (empty($nombre) || empty($director) || empty($id_pelicula) || empty($servicio_fk) || empty($tipo) || empty($genero)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }

            $this->model->updatePeliFromId($id_pelicula, $nombre, $director, $tipo, $genero, $servicio_fk);
            $this->view->ShowHomeLocation();
        } catch (PDOException $e) {
            header("refresh:10;url=" . BASE_URL . "home");
           $this->view->ShowErrorDuplicado("Redireccion");
        }
    }
}
