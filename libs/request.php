<?php
class Request{
    public $body = null; //el cuerpo nos trae y devuelve los datos de la peticion como json generalmente
    public $params = null; //podemos tener parametros para pasarle como id por ejemplo. api/tareas/:id
    public $query = null; // nos sirve para ordenar las tareas, filtrar, ocultar, etc.

    public function __construct(){
        try {

            $this -> body = json_decode(file_get_contents('php://input'));  //file_get_contents (le pasamos un archivo) nos devuelve el body de la request en este caso en formato json

        } catch (Exception $e) {

            $this -> body = null;
        }

        $this -> query = (object) $_GET; //query son los parametros $_get
    }
}