<?php

class SiniestroModel{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=peritajes;charset=utf8', 'root', '');
     }

    public function getSiniestros($idAseguradora = false,$order = false, $priority = false,  $page = false, $quantity = false){
        
        $sql = 'SELECT * FROM siniestro';
        
        if($idAseguradora){
            $sql .= ' WHERE `ID_Aseguradora` = ?';
        }
        
        if($order) {
            switch($order) {
                case 'fecha':
                $sql .= ' ORDER BY Fecha';
                    break;
                case 'tipoSiniestro':
                    $sql .= ' ORDER BY Tipo_Siniestro';
                    break;
                case 'asegurado':
                    $sql .= ' ORDER BY Asegurado';
                    break;
                case 'idAseguradora':
                    $sql .= ' ORDER BY ID_Aseguradora';
                    break;
                default:
                 $sql .= ' ORDER BY ID_Siniestro';
                  break;
            }  
        }

        if($priority){
            if ($priority === ' DESC' ) {
                $sql .= ' DESC';  
            } else {
                $sql .= ' ASC';  
            }     
        }

        if($quantity && $page){
            if($quantity > 0 && $page > 0){
                $page = ($page - 1) * $quantity;
                $sql.= " LIMIT $page,$quantity";
            }
        }

        $query = $this->db->prepare($sql);
       
        if($idAseguradora){
            $query ->execute([$idAseguradora]);
        }else{
            $query ->execute();
        }

        $siniestros = $query -> fetchAll(PDO::FETCH_OBJ);
        return $siniestros;
    }

    
    public function getSiniestroById($id){
        $query = $this->db->prepare('SELECT * FROM siniestro WHERE ID_Siniestro=?');
        $query->execute([$id]);
        $siniestroById = $query->fetch(PDO::FETCH_OBJ);
        return $siniestroById;
    }

    public function getAseguradoraById($idAseguradora){
        
        $query = $this->db->prepare('SELECT * FROM aseguradora WHERE ID_Aseguradora = ?');
        $query->execute([$idAseguradora]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function siniestroaAdd($fecha, $tipoSiniestro, $asegurado, $idAseguradora){
        $query = $this -> db->prepare('INSERT INTO siniestro (Fecha,Tipo_Siniestro, Asegurado, ID_Aseguradora) VALUES(?,?,?,?)');
        $query -> execute([$fecha, $tipoSiniestro, $asegurado, $idAseguradora]);
        $id = $this->db->lastInsertId();    
        return $id;
    }

    public function deleteSiniestro($id){
        $query = $this -> db->prepare('DELETE FROM siniestro WHERE ID_Siniestro=?');
        $query->execute([$id]);
    }


    public function modifySiniestro($fecha, $tipoSiniestro, $asegurado, $idAseguradora, $id){
        $query = $this->db->prepare('UPDATE siniestro SET Fecha=?, Tipo_Siniestro=?, Asegurado= ?, ID_Aseguradora=? WHERE ID_Siniestro= ?' );
        $query->execute([$fecha, $tipoSiniestro, $asegurado, $idAseguradora, $id]);
        $siniestroModificado = $query->fetch(PDO::FETCH_OBJ);
        return $siniestroModificado;

    }

}