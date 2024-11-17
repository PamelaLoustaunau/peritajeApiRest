<?php
require_once './api/models/siniestro.api.model.php';
require_once './api/views/json.view.php';

class SiniestroApiController{
    private $model;
    private $view;

    public function __construct(){

        $this->model = new SiniestroModel();
        $this->view = new JSONView();
    }

    public function getListSiniestros($req,$res){
        $idAseguradora = false;
        $order = false;
        $priority = false;
        $page = false;
        $quantity = false;

        if(isset($req->query->idAseguradora)){
            $idAseguradora = $req->query->idAseguradora;
        }


        if(isset($req->query->order)){
            $order = $req->query->order;
        }

        if(isset($req->query->priority)){
             $priority = $req->query->priority;
        }

        
        if(isset($req->query->page)){
            if(is_numeric($req->query->page)){
                $page = (int)$req->query->page;
            }
        }

        if(isset($req->query->quantity)){
            if(is_numeric($req->query->quantity)){
                $quantity = (int) $req->query->quantity;
            }
        }

 
        $siniestros = $this->model-> getSiniestros($idAseguradora,$order, $priority, $page, $quantity);

        if(empty($siniestros)){
            return $this->view->response("No existe ningun mas siniestros para poder listarlo.", 404);
        }

        return $this->view->response($siniestros,200);

    }

    public function getSiniestroId($req, $res){
        $id= $req->params->id;

        $siniestroById = $this->model->getSiniestroById($id);

        if(!$siniestroById){
            return $this->view->response("El Siniestro con el id = $id no exite", 404);
        }

        return $this->view->response($siniestroById, 200);
    }

    public function deleteSiniestro($req, $res){
        $id= $req->params->id;
        $siniestroDelete = $this->model->getSiniestroById($id);

        if(!$siniestroDelete){
            return $this->view->response("El Siniestro con el id = $id no exite, no se puede borrar", 404);
        }
        
        $this->model->deleteSiniestro($id);
        return $this->view->response("El Siniestro con el id = $id se elimino con exito", 200);
    }

    public function addSiniestro($req, $res){
        
        if(empty($req->body->Fecha) || empty($req->body->Tipo_Siniestro) || empty($req->body->Asegurado) || empty( $req->body->ID_Aseguradora)){
            return $this->view->response("Faltan completar datos", 400);
        }

        $fecha = $req->body->Fecha;
        $tipoSiniestro = $req->body->Tipo_Siniestro;
        $asegurado = $req->body->Asegurado;
        $idAseguradora = $req->body->ID_Aseguradora;

        $aseguradora = $this->model->getAseguradoraById($idAseguradora);

        if(!$aseguradora){
            return $this->view->response("La Aseguradora con el id = $idAseguradora, no existe", 404);

        }

        $id = $this->model->siniestroaAdd($fecha, $tipoSiniestro, $asegurado, $idAseguradora);

        if(!$id){

            return $this->view->response("El Siniestro con el id = $id se agrego con exito", 201);

        }
        $siniestroNew = $this->model->getSiniestroById($id);
        return $this->view->response($siniestroNew, 201);
    }

    public function modifySiniestro($req, $res){

        $id = $req->params->id;
        $siniestroByModify = $this->model->getSiniestroById($id);

        

        if(!$siniestroByModify){
            return $this->view->response("El siniestro con el id = $id, no existe", 400);
        }


        if(empty($req->body->Fecha) || empty($req->body->Tipo_Siniestro) || empty($req->body->Asegurado) || empty($req->body->ID_Aseguradora)){

            return $this->view->response("Faltan completar datos", 400);
        }

        $fecha = $req->body->Fecha;
        $tipoSiniestro = $req->body->Tipo_Siniestro;
        $asegurado = $req->body->Asegurado;
        $idAseguradora = $req->body->ID_Aseguradora;
                
        $aseguradora = $this->model->getAseguradoraById($idAseguradora);

        if(!$aseguradora){
            return $this->view->response("La Aseguradora con el id = $idAseguradora, no existe", 404);

        }


        $this->model->modifySiniestro($fecha, $tipoSiniestro, $asegurado, $idAseguradora, $id);

        $siniestroModify = $this->model->getSiniestroById($id);

        if(!$siniestroModify){
            return $this->view->response("El siniestro con el id = $id, no pudo ser modificado, vuelva a intentarlo", 400);
        }

        return $this->view->response($siniestroModify, 200);

    }

}