<?php
require_once './models/siniestro.api.model.php';
require_once './views/json.view.php';

class SiniestroApiController{
    private $model;
    private $view;

    public function __construct($res){

        $this->model = new SiniestroModel();
        $this->view = new JSONView();
    }

    public function getListSiniestros($req, $res){
        $siniestros = $this->model-> getSiniestros();
        if(empty($siniestros)){
            return $this->view->response('No existe ningun siniestro agregue al menos uno para poder listarlo.', 204);
        }
        return $this->view->response($siniestros,200);

    }

    public function getSiniestrosId($req, $res){
        $id = $req->params->id;

        $siniestroById = $this->model->getSiniestroById($id);

        if(empty($siniestroById)){
            return $this->view->response('El Siniestro con el id =' $id 'no exite', 204) 
        }
        return $this->view->response($siniestroById, 200);
    }

}