<?php

/*
 * Every class deriving from Controller must implement Index() method
 * Index() method is the index page of the controller
 * Routing is based on controller class and it's methods
 * It is structured as: http(s)://address/class/method/[optional parameters divided by a '/']
 * Every page of the controller can accept optional parameters from the uri
 */
class PresencaController extends Controller {

    /*
     * http://localhost/presenca
     */
    function Index () {
        $title = "Presenças";
        $this->model('Presenca');

        $presencas = $this->Presenca->getAll();

        $this->view('template/header', ['title' => $title]);
        $this->view('presenca/index', compact("presencas"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/presenca/marcarPresenca
     */
    function marcarPresenca () {
        $title = "Aulas";

        $this->model('Aula');

        $aulas = $this->Aula->getByDataAtual();

        $this->view('template/header', ['title' => $title]);
        $this->view('presenca/marcarPresenca', compact("aulas"));
        $this->view('template/footer');
    }
    
    /*
     * http://localhost/presenca/consulta
     */
    function consulta () {
        $title = "Consultar Presença";

        $this->view('template/header', ['title' => $title]);
        $this->view('presenca/consulta');
        $this->view('template/footer');
    }

    /*
     * http://localhost/presenca/historico
     */
    function historico () {
        
        [
            "id" => $id
        ] = $_POST;

        $title = "Presenças";
        $this->model('Presenca');

        $presencas = $this->Presenca->getByIdCliente(compact("id"));

        if (!is_array($presencas)) Errors::send(500);

        foreach ($presencas as &$presenca) {
            $presenca["data"] = date('d/m/Y', strtotime($presenca["data"]));
        }

        unset($presenca);

        header('Content-type: application/json');
        echo json_encode($presencas);

    }

    /*
     * http://localhost/presenca/inserir
     */
    function inserir () {

        $this->model('Presenca');
        
        [
            "idCliente" => $idCliente,
            "idAula" => $idAula
        ] = $_POST;

        $presenca = compact("idCliente", "idAula");

        $idPresenca = $this->Presenca->create($presenca);
        if (!$idPresenca) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>true]);
    }

}

?>