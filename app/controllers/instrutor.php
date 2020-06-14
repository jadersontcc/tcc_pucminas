<?php

/*
 * Every class deriving from Controller must implement Index() method
 * Index() method is the index page of the controller
 * Routing is based on controller class and it's methods
 * It is structured as: http(s)://address/class/method/[optional parameters divided by a '/']
 * Every page of the controller can accept optional parameters from the uri
 */
class InstrutorController extends Controller {

    /*
     * http://localhost/instrutor
     */
    function Index () {
        $title = "Instrutores";
        $this->model('Instrutor');

        $instrutores = $this->Instrutor->getAll();

        $this->view('template/header', ['title' => $title]);
        $this->view('instrutor/index', compact("instrutores"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/instrutor/formcadastro
     */
    function formCadastro () {
        $title = "Novo Instrutor";

        $this->view('template/header', ['title' => $title]);
        $this->view('instrutor/form');
        $this->view('template/footer');

    }

    /*
     * http://localhost/instrutor/inserir
     */
    function inserir () {

        $this->model('Instrutor');
        
        [
            "nome" => $nome,
            "rg" => $rg,
            "cpf" => $cpf,
            "tipoAtividade" => $tipoAtividade
        ] = $_POST;

        $instrutor = compact("nome", "rg", "cpf", "tipoAtividade");

        $idInstrutor = $this->Instrutor->create($instrutor);
        if (!$idInstrutor) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>true]);
    }

    /*
     * http://localhost/instrutor/alterar
     */
    function alterar () {

        $this->model('Instrutor');
        
        [
            "id" => $id,
            "nome" => $nome,
            "rg" => $rg,
            "cpf" => $cpf,
            "tipoAtividade" => $tipoAtividade
        ] = $_POST;

        $instrutor = compact("id", "nome", "rg", "cpf", "tipoAtividade");

        $idInstrutor = $this->Instrutor->update($instrutor);
        if (!$idInstrutor) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>true]);
    }

    /*
     * http://localhost/instrutor/deletar/:id
     */
    function deletar ($id = false) {

        if (!$id) Errors::send(500);
        
        $this->model('Instrutor');

        $instrutor = compact("id");

        $res = $this->Instrutor->delete($instrutor);
        if (!$res) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>$instrutor]);
    }

}

?>