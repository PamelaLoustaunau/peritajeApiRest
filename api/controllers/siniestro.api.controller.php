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
            return $this->view->response('No existe ningun siniestro agregue al menos uno para poder listarlo.', 204);
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

}