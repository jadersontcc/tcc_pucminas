<?php

class LoginController extends Controller {

    /*
     * http://localhost/login
     */
    function Index () {
        if (!isset($_SESSION['login'])) {

            $title = "Login";

            $this->view('template/header', ['title' => $title]);
            $this->view('template/carousel');
            $this->view('login');
            $this->view('template/footer');


        } else {

            header('Location: /academia');

        }

    }

    /*
     * http://localhost/login/log_in
     */
    function Log_In () {
        // Loads /models/example.php
        $this->model('Usuario');
        ["login" => $login, "senha" => $senha, "tipo" => $tipo] = $_POST;
        $usuario = $this->Usuario->getByLoginAndTipo($login, $tipo);
        
        if ($usuario["senha"] == $senha) { // Example->exampleMethod() from /models/example.php
            $_SESSION['id'] = $usuario["id"];
            $_SESSION['login'] = $login;
            $_SESSION['tipo'] = $tipo;
            
            header('Content-type: application/json');
            echo json_encode($usuario);
        } else {
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'Usuário não existente', 'code' => 404)));
        }

    }

    /*
     * http://localhost/login/logout
     */
    function Logout () {

        $_SESSION = [];
        session_unset();
        header('Location: /academia');

    }

}

?>