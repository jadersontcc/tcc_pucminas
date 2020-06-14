<?php

/*
 * Every class deriving from Controller must implement Index() method
 * Index() method is the index page of the controller
 * Routing is based on controller class and it's methods
 * It is structured as: http(s)://address/class/method/[optional parameters divided by a '/']
 * Every page of the controller can accept optional parameters from the uri
 */
class PagamentoController extends Controller {

    /*
     * http://localhost/pagamento
     */
    function Index () {
        $title = "Pagamentos";
        $this->model('Pagamento');

        $pagamentos = $this->Pagamento->getAll();

        $this->view('template/header', ['title' => $title]);
        $this->view('pagamento/index', compact("pagamentos"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/pagamento/cliente
     */
    function cliente ($idCliente) {
        $title = "Pagamentos";

        $this->model('PeriodoFerias');
        $periodosFerias = $this->PeriodoFerias->getByIdCliente(compact("idCliente"));

        $this->model('Pagamento');
        $pagamentos = $this->Pagamento->getByIdCliente(compact("idCliente"));

        $this->model('Cliente');

        $id = $idCliente;
        $cliente = $this->Cliente->getById(compact("id"));
        $nomeCliente = $cliente["nome"];

        $this->view('template/header', ['title' => $title]);
        $this->view('pagamento/cliente', compact("pagamentos", "periodosFerias", "nomeCliente"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/cliente/inserir
     */
    function inserir () {

        $this->model('Pagamento');
        [
            "idCliente" => $idCliente,
            "data" => $data,
        ] = $_POST;

        $idCliente = intval($idCliente);
        
        $pagamentos = $this->Pagamento->getAll();
        $tipo = $pagamentos[0]["tipo"];
        
        $pago = isset($_POST["newpago"]);
        $data = str_replace('/', '-', $data);
        $pagamento = compact("tipo", "data", "pago", "idCliente");

        $idPagamento = $this->Pagamento->create($pagamento);
        if (!$idPagamento) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>true]);
    }

    /*
     * http://localhost/pagamento/alterar
     */
    function alterar () {

        $this->model('Pagamento');
        [   
            "id" => $id,
            "pago" => $pago
        ] = $_POST;


        $pagamento = compact("id", "pago");

        $res = $this->Pagamento->update($pagamento);

        header('Content-type: application/json');
        echo json_encode(["status"=>$res]);
    }

}

?>