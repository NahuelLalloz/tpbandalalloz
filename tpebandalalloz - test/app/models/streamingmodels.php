<?php

require_once 'app/models/config.php';
class StreamingModel{
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=pelispa;charset=' . DB_Charset, DB_USER, DB_PASS);
    }

    public function getStreaming() {
        $query = $this->db->prepare('SELECT * FROM servicio_streaming');
        $query->execute();
        $servicios = $query->fetchAll(PDO::FETCH_OBJ);
        return $servicios;
    }
    function deleteServicioById($id_servicio) {
        $query =$this-> db->prepare('DELETE FROM servicio_streaming WHERE id_servicio_streaming = ?');
        $query->execute([$id_servicio]);
    }
    public function insertServicio($id_servicio_streaming, $nombre) {
        $query = $this->db->prepare("INSERT INTO servicio_streaming (id_servicio_streaming, nombre) VALUES (?, ?)");
    
        $query->execute([$id_servicio_streaming, $nombre]);
    
        return $this->db->lastInsertId();
    }
    public function updateServicioFromId($id_servicio_streaming, $nombre){
        $query = $this->db->prepare('UPDATE servicio_streaming SET nombre = ? WHERE id_servicio_streaming = ?');
        $query->execute([$nombre, $id_servicio_streaming]);
    }

    public function getStreamingiById($id_servicio_streaming) {
        $query = $this->db->prepare('SELECT servicio_streaming.*
            FROM servicio_streaming
            WHERE servicio_streaming.id_servicio_streaming = ?');
    
        $query->execute([$id_servicio_streaming]);
    
        $servicios = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $servicios;
    }
    public function getServicioId($id_servicio_streaming) {
        $query = $this->db->prepare('SELECT * FROM servicio_streaming WHERE id_servicio_streaming =?');
    
        $query->execute([$id_servicio_streaming]);
    
        $servicios = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $servicios;
    }
}  