<?php

class JSONView{
     // esta funcion reenderiza nuestro respuesta http que es un objeto json
    public function response($body, $status = 200){
        header("Content-Type: application/json"); //agregamos un header, con la informacion que le vamos a pasar un json
        $statusText = $this -> _requestStatus($status); // el guion bajo es para diferenciar que esta función es privada
        header("HTTP/1.1 $status $statusText"); // version y codigo de estado
        echo json_enconde($body);
    }

    private function _requestStatus($code){

        $status = array (
            200 = "OK - Petición Exitosa.",
            201 => "Created - Recurso creado con éxito.",
            204 => "No Content - La solicitud fue exitosa pero no hay contenido para enviar.",
            400 => "Bad Request - Solicitud Incorrecta.",
            404 => "Not Found - El recurso solicitado no se encontró.",
            500 => "Internal Server Error - Error en el servidor."
        )
        return (isset($status[$code])) ? $status[$code] : $status[500];
        //si el codigo esta seteado, devuelve el codigo que llega por parametro, sino exite nos da el codigo 500 por default ( podemos poner cualquier otro codigo por defecto, pero generalmente se pone el codigo 500)

    }



}