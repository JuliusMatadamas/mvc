<?php


namespace app\core;


class Response
{
    /**
     * ============================================================================================
     * @param int $code -> número de código a establecer como respuesta del servidor
     * ============================================================================================
     */
    public function setStatusCode(int $code)
    {
        http_response_code ($code);
    }
}