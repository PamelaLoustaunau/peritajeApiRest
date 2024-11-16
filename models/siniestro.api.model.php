<?php

class SiniestroModel{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=peritajes;charset=utf8', 'root', '');
     }

    

    public function getSiniestros(){
        $query = $this->db->prepare('SELECT * FROM siniestro');
        $query->execute();
        $siniestros = $query -> fetchAll(PDO::FETCH_OBJ);
        return $siniestros;
    }
    public function getSiniestroById($id){
        $query = $this->db->prepare('SELECT * FROM siniestro WHERE ID_Siniestro=?');
        $query->execute($id);
        $siniestroById = $query->fetch(PDO::FETCH_OBJ);
        return $siniestrosById;
    }

    public function getsiniestroAseguradoraId(){
        $query = $this->db->prepare('SELECT * FROM aseguradora');
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);

    }

    public function siniestroaAdd($date, $typeSiniestro, $asegurado, $aseguradoraId){
        $query = $this -> db->prepare('INSERT INTO siniestro (Fecha,Tipo_Siniestro, Asegurado, ID_Aseguradora) VALUES(?,?,?,?)');
        $query -> execute([$date, $typeSiniestro, $asegurado, $aseguradoraId]);
        $id = $this->db->lastInsertId();    
        return $id;
    }
    public function deleteSiniestro($id){
        $query = $this -> db->prepare('DELETE FROM siniestro WHERE ID_Siniestro=?');
        $query->execute([$id]);
    }

    public function modifySiniestro($id){
        $query = $this->db->prepare('SELECT * FROM siniestro WHERE ID_Siniestro=?');
        $query->execute([$id]);   
        $siniestro = $query->fetch(PDO::FETCH_OBJ);    
        return $siniestro;

    }

    public function siniestroModify($date, $typeSiniestro, $asegurado,  $id){
        $query = $this->db->prepare('UPDATE siniestro SET Fecha=?, Tipo_Siniestro=?, Asegurado= ? WHERE ID_Siniestro= ?' );

        $query->execute([$date, $typeSiniestro, $asegurado, $id]);


    }




}