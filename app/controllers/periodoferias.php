<?php

/*
 * Every class deriving from Controller must implement Index() method
 * Index() method is the index page of the controller
 * Routing is based on controller class and it's methods
 * It is structured as: http(s)://address/class/method/[optional parameters divided by a '/']
 * Every page of the controller can accept optional parameters from the uri
 */
class PeriodoFeriasController extends Controller {

    /*
     * http://localhost/periodoFerias
     */
    function Index () {
        $title = "Períodos de Férias";
        $this->model('PeriodoFerias');

        $periodosFerias = $this->PeriodoFerias->getAll();

        $this->view('template/header', ['title' => $title]);
        $this->view('periodoFerias/index', compact("periodosFerias"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/periodoFerias/inserir
     */
    function inserir () {

        $this->model('PeriodoFerias');
        $this->model('Pagamento');
        
        [
            "dataInicio" => $dataInicio,
            "dataFim" => $dataFim,
            "idCliente" => $idCliente
        ] = $_POST;

        $dataInicio = str_replace('/', '-', $dataInicio);
        $dataFim = str_replace('/', '-', $dataFim);

        $hoje = date("Y-m-d");
        
        if ((strtotime($dataInicio) < strtotime($hoje) or strtotime($dataFim) < strtotime($hoje))) { 
            Errors::send(500, "Data de início e fim devem ser posteriores à data atual.");
        }
        
        if (strtotime($dataInicio) > strtotime($dataFim)) { 
            Errors::send(500, "Data de início deve ser inferior à data final.");
        }

        $datediff = strtotime($dataFim) - strtotime($dataInicio);
        $dias = round($datediff / (60 * 60 * 24));

        $periodoFerias = compact("idCliente", "dataInicio", "dataFim", "dias");
        
        $periodosFerias =  $this->PeriodoFerias->getByIdCliente($periodoFerias);

        $isConsecutivo = false;
        foreach($periodosFerias as $periodo) {
            $datediff = min(
                abs(strtotime($periodo["dataFim"]) - strtotime($dataInicio)),
                abs(strtotime($periodo["dataInicio"]) - strtotime($dataFim))
            );
            $secToDay = round($datediff / (60 * 60 * 24));
            $isConsecutivo = $secToDay <= 1;
            if ($isConsecutivo) Errors::send(500, "Os períodos de férias não podem ser consecutivos");
        }
        
        $somatorioDias = $this->PeriodoFerias->getDaysSumByIdCliente($periodoFerias)["dias"] + $dias;

        if ($somatorioDias > 30) {
            Errors::send(500, "A soma total dos dias de férias deve ser menor ou igual a 30 dias");
        }

        if ($this->PeriodoFerias->checkIfDateRangeOverlaps($periodoFerias)["count"] > 0) {
            Errors::send(500, "O intervalo escolhido sobrepõe 1 ou mais períodos de férias já definidos");
        }

        $idPeriodoFerias = $this->PeriodoFerias->create($periodoFerias);
        if (!$idPeriodoFerias) Errors::send(500);

        $proximoPagamento = $this->Pagamento->getLastByIdCliente(compact("idCliente"));
        $proximosPagamentos = $this->Pagamento->getAfterByDate($proximoPagamento);
        foreach ($proximosPagamentos as &$pagamento) {
            $pagamento["data"] = date("Y-m-d", strtotime($pagamento["data"]. " + $dias days"));
            $res = $this->Pagamento->update($pagamento);
            if (!$res) Errors::send(500, "Erro no servidor. Tente novamente mais tarde.");
        }

        header('Content-type: application/json');
        echo json_encode(["status"=>$idPeriodoFerias]);
    }

    /*
     * http://localhost/periodoFerias/remover/:id
     */
    function remover ($id) {

        $this->model('PeriodoFerias');
        $this->model('Pagamento');

        $periodoFerias = $this->PeriodoFerias->getById(compact("id"));
        $idCliente = $periodoFerias["idCliente"];
        $dias = $periodoFerias["dias"];

        $proximoPagamento = $this->Pagamento->getLastByIdCliente(compact("idCliente"));
        $proximosPagamentos = $this->Pagamento->getAfterByDate($proximoPagamento);
        foreach ($proximosPagamentos as &$pagamento) {
            $pagamento["data"] = date("Y-m-d", strtotime($pagamento["data"]. " - $dias days"));
            $res = $this->Pagamento->update($pagamento);
            if (!$res) Errors::send(500, "Erro no servidor. Tente novamente mais tarde.");
        }

        $res = $this->PeriodoFerias->delete($periodoFerias);
        if (!$res) Errors::send(500, "Erro no servidor. Tente novamente mais tarde.");

        header('Content-type: application/json');
        echo json_encode(["status"=>$res]);
    }
}

?>