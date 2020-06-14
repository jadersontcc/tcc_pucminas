<?php

/*
 * Every class deriving from Controller must implement Index() method
 * Index() method is the index page of the controller
 * Routing is based on controller class and it's methods
 * It is structured as: http(s)://address/class/method/[optional parameters divided by a '/']
 * Every page of the controller can accept optional parameters from the uri
 */
class ClienteController extends Controller {

    /*
     * http://localhost/cliente
     */
    function Index () {
        $title = "Clientes";
        $this->model('Cliente');

        $clientes = $this->Cliente->getAll();

        $this->view('template/header', ['title' => $title]);
        $this->view('cliente/index', compact("clientes"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/cliente/inadiplente
     */
    function inadiplente () {
        $title = "Alunos Inadiplentes";
        $this->model('Cliente');

        $clientes = $this->Cliente->getInadiplentes();

        $this->view('template/header', ['title' => $title]);
        $this->view('cliente/inadiplentes', compact("clientes"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/cliente/marcarPresenca
     */
    function marcarPresenca () {
        // Loads /models/example.php
        $this->model('Cliente');
        [   
            "id" => $id,
            "idAula" => $idAula
        ] = $_POST;

        $cliente = $this->Cliente->getById(compact("id"));
        
        if (!$cliente) Errors::send(404, "Aluno não encontrado");  
        $this->model('Presenca');

        $idCliente = $id;
        $data = date("Y-m-d");
        $presenca = compact("idCliente", "idAula", "data");

        $idPresenca = $this->Presenca->checkIfAlreadyPresent($presenca); 
        if($idPresenca) Errors::send(409, "Presença já foi registrada");
        
        $idPresenca = $this->Presenca->create($presenca);
        if(!$idPresenca) Errors::send(500, "Erro no servidor");

        $res = ["id" => $idPresenca];

        $this->model('Avaliacao');
        $avaliacao = $this->Avaliacao->getLastByIdCliente(compact("idCliente"));
        $datediff = abs(strtotime($avaliacao["data"]) - strtotime(date('Y-m-d')));
        if (($datediff / (60 * 60 * 24 * 30)) >= 6) {
            $res["message"] = "Deve ser feita uma nova avaliação física.";
        } else {
            $res["message"] = false;
        }
        
        header('Content-type: application/json');
        echo json_encode($res);

    }

    /*
     * http://localhost/cliente/formcadastro
     */
    function formCadastro () {
        $title = "Novo Aluno";

        $this->view('template/header', ['title' => $title]);
        $this->view('cliente/form');
        $this->view('template/footer');

    }

    /*
     * http://localhost/cliente/inserir
     */
    function inserir () {

        $this->model('Cliente');
        $this->model('Pagamento');
        [
            "nome" => $nome,
            "rg" => $rg,
            "cpf" => $cpf,
            "endereco" => $endereco,
            "cidade" => $cidade,
            "uf" => $uf,
            "cep" => $cep,
            "tipo" => $tipo,
            "data" => $data,
        ] = $_POST;


        $cliente = compact("nome", "rg", "cpf", "endereco", "cidade", "uf", "cep");

        $idCliente = $this->Cliente->create($cliente);
        if (!$idCliente) Errors::send(401);
        $idCliente = intval($idCliente);
        
        $pago = isset($_POST["pago"]);
        $data = str_replace('/', '-', $data);
        $pagamento = compact("tipo", "data", "pago", "idCliente");

        $idPagamento = $this->Pagamento->create($pagamento);
        if (!$idPagamento) Errors::send(500);

        if($pago) {
            $tempoAcrescido = $pagamento["tipo"] == "M" ? ' + 1 month' : ' + 1 year';
            $data= $data.$tempoAcrescido;
            $data = date('Y-m-d', strtotime($pagamento["data"].$tempoAcrescido));
            $pago = false;
            $pagamento = compact("tipo", "data", "pago", "idCliente");
            $idPagamento = $this->Pagamento->create($pagamento);
            if (!$idPagamento) Errors::send(500);
        }

        header('Content-type: application/json');
        echo json_encode(["status"=>true]);
    }

    /*
     * http://localhost/cliente/alterar
     */
    function alterar () {

        $this->model('Cliente');
        [   
            "id" => $id,
            "nome" => $nome,
            "rg" => $rg,
            "cpf" => $cpf,
            "endereco" => $endereco,
            "cidade" => $cidade,
            "uf" => $uf,
            "cep" => $cep
        ] = $_POST;


        $cliente = compact("id", "nome", "rg", "cpf", "endereco", "cidade", "uf", "cep");

        $res = $this->Cliente->update($cliente);

        header('Content-type: application/json');
        echo json_encode(["status"=>$res]);
    }

    /*
     * http://localhost/cliente/deletar/:id
     */
    function deletar ($id = false) {

        if (!$id) Errors::send(500);
        
        $this->model('Cliente');

        $cliente = compact("id");

        $res = $this->Cliente->delete($cliente);
        if (!$res) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>$cliente]);
    }

}

?>