<?php

/*
 * Every class deriving from Controller must implement Index() method
 * Index() method is the index page of the controller
 * Routing is based on controller class and it's methods
 * It is structured as: http(s)://address/class/method/[optional parameters divided by a '/']
 * Every page of the controller can accept optional parameters from the uri
 */
class AulaController extends Controller {

    /*
     * http://localhost/aula
     */
    function Index () {
        $title = "Aulas";
        $this->model('Aula');
        $this->model('Instrutor');

        $aulas = $this->Aula->getAll();
        $instrutores = $this->Instrutor->getAll();

        $aulas = Formatter::diasDaSemanaExtenso($aulas);

        $this->view('template/header', ['title' => $title]);
        $this->view('aula/index', compact("aulas", "instrutores"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/aula/formcadastro
     */
    function formCadastro () {
        $title = "Nova Aula";
        $this->model('Instrutor');

        $instrutores = $this->Instrutor->getAll();

        $this->view('template/header', ['title' => $title]);
        $this->view('aula/form', ["instrutores" => $instrutores]);
        $this->view('template/footer');

    }

    /*
     * http://localhost/aula/inserir
     */
    function inserir () {

        $this->model('Aula');
        [
            "nome" => $nome,
            "horaInicio" => $horaInicio,
            "horaFim" => $horaFim,
            "dias" => $dias,
            "sala" => $sala,
            "idInstrutor" => $idInstrutor
        ] = $_POST;
        
        $dias = join("", $dias);
        $aula = compact("nome", "horaInicio", "horaFim", "dias", "sala", "idInstrutor");

        $idAula = $this->Aula->create($aula);
        if (!$idAula) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode($idAula);
    }

    /*
     * http://localhost/aula/inserir
     */
    function alterar () {

        $this->model('Aula');
        [
            "id" => $id,
            "nome" => $nome,
            "horaInicio" => $horaInicio,
            "horaFim" => $horaFim,
            "dias" => $dias,
            "sala" => $sala,
            "idInstrutor" => $idInstrutor
        ] = $_POST;
        
        $dias = join("", $dias);
        $aula = compact("id", "nome", "horaInicio", "horaFim", "dias", "sala", "idInstrutor");

        $idAula = $this->Aula->update($aula);
        if (!$idAula) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode($idAula);
    }

    /*
     * http://localhost/aula/deletar/:id
     */
    function deletar ($id = false) {

        if (!$id) Errors::send(500);
        
        $this->model('Aula');

        $aula = compact("id");

        $res = $this->Aula->delete($aula);
        if (!$res) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>$aula]);
    }

}

?>