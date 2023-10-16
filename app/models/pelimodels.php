<?php
require_once 'app/models/config.php';
class PeliModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=pelispa;charset=' . DB_Charset, DB_USER, DB_PASS);
    }

    function getPeliculas() {
        $query = $this->db->prepare('SELECT peliculas.*, peliculas.director, peliculas.servicio_fk, peliculas.tipo, peliculas.genero, servicio_streaming.nombre AS nombre_servicio
        FROM peliculas
        INNER JOIN servicio_streaming ON peliculas.servicio_fk = servicio_streaming.id_servicio_streaming');
      
        

        $query->execute();
        
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ);

        return $peliculas;
    }


public function getPeliByServicioId($servicios) {
    $query = $this->db->prepare('SELECT peliculas.*, servicio_streaming.nombre AS nombre_servicio
    FROM peliculas
    INNER JOIN servicio_streaming ON peliculas.servicio_fk = servicio_streaming.id_servicio_streaming
    WHERE peliculas.id_pelicula = ?');
    $query->execute([$servicios]);
    return $query->fetchAll(PDO::FETCH_OBJ);
    
}


function getPeliById($id_pelicula) {

    $query = $this->db->prepare('SELECT * FROM peliculas WHERE id_pelicula = ?');
    $query->execute([$id_pelicula]);
    $peliculas = $query->fetchAll(PDO::FETCH_OBJ);
    return $peliculas;
  
}

public function insertPeli($id_pelicula, $nombre, $director, $tipo, $genero, $servicio_fk) {
    $query = $this->db->prepare("INSERT INTO peliculas (id_pelicula, nombre, director, tipo, genero, servicio_fk) VALUES (?, ?, ?, ?, ?, ?)");

    $query->execute([$id_pelicula, $nombre, $director, $tipo, $genero, $servicio_fk]);

    return $this->db->lastInsertId();
}



function deletePeliById($id_peliculas) {
    $query =$this-> db->prepare('DELETE FROM peliculas WHERE id_pelicula = ?');
    $query->execute([$id_peliculas]);
}

public function updatePeliFromId($id_pelicula, $nombre, $director, $tipo, $genero, $servicio_fk){
    $query = $this->db->prepare('UPDATE peliculas SET nombre = ?, director = ?, tipo = ?, genero = ?, servicio_fk = ? WHERE id_pelicula = ?');
    $query->execute([$nombre, $director, $tipo, $genero, $servicio_fk, $id_pelicula]);
}


}
