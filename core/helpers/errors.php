<?php

/*
 * EXAMPLE HELPER CLASS
 */
class Errors {

    private const ERROS = [
        500 => "Erro no servidor",
        401 => "Acesso não autorizado",
        404 => "Não encontrado",
        409 => "Registro já existe"
    ];

    public static function send ($code = 500, $message = '') {
        $message = $message ?: self::ERROS[$code];
        header("HTTP/1.1 $code Error");
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(['message'=>$message, 'code'=>$code]));
    }

    public static function method () {

        echo 'Helper method';
        
    }

}

?>