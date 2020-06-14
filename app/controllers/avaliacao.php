<?php

/*
 * Every class deriving from Controller must implement Index() method
 * Index() method is the index page of the controller
 * Routing is based on controller class and it's methods
 * It is structured as: http(s)://address/class/method/[optional parameters divided by a '/']
 * Every page of the controller can accept optional parameters from the uri
 */
class AvaliacaoController extends Controller {
    /*
     * http://localhost/avaliacao
     */
    function Index () {
        $title = "Avaliações";
        $this->model('Avaliacao');

        $avaliacoes = $this->Avaliacao->getAll();

        $this->view('template/header', ['title' => $title]);
        $this->view('avaliacao/index', compact("avaliacoes"));
        $this->view('template/footer');
    }

    /*
     * http://localhost/avaliacao/detalhes
     */
    function details () {
        $this->model('Avaliacao');

        $avaliacao = $this->Avaliacao->getById();

        header('Content-type: application/json');
        echo json_encode($avaliacao);
    }


    /*
     * http://localhost/avaliacao/download
     */
    function download ($id) {
        $title = "Nova Avaliação";
        $this->model('Avaliacao');

        $avaliacao = $this->Avaliacao->getById(compact("id"));

        header("Content-length: ".$avaliacao["tamanhoArquivo"]);
        header("Content-type: ".$avaliacao['mime']);
        header("Content-Disposition: attachment; filename=".$avaliacao['nomeArquivo']);
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($avaliacao["caminhoArquivo"]);
    }

    /*
     * http://localhost/avaliacao/formcadastro
     */
    function formCadastro () {
        $title = "Nova Avaliação";
        $this->model('Cliente');

        $clientes = $this->Cliente->getAll();

        $this->view('template/header', ['title' => $title]);

        $this->view('avaliacao/form', compact("clientes"));
        $this->view('template/footer');

    }

    /*
     * http://localhost/avaliacao/inserir
     */
    function inserir () {

        $this->model('Avaliacao');
        
        [
            "idCliente" => $idCliente,
            "data" => $data,
            "idade" => $idade,
            "sexo" => $sexo,
            "peso" => $peso,
            "altura" => $altura,
            "fumante" => $fumante,
            "diabetico" => $diabetico,
            "problemaCardiaco" => $problemaCardiaco,
            "lesaoOrtopedica" => $lesaoOrtopedica,
            "triceps" => $triceps,
            "suprailiaca-m" => $suprailiacam,
            "abdominal" => $abdominal,
            "coxa" => $coxa,
            "suprailiaca-f" => $suprailiacaf,
            "subescapular" => $subescapular,
            "gordura" => $gordura
        ] = $_POST;

        
        $idUsuario = $_SESSION["id"];
        $data = str_replace('/', '-', $data);

        $suprailiaca = $sexo == "F" ? $suprailiacaf : $suprailiacam;
        
        $arquivo = $_FILES["arquivo"] ?? null; 
        $nomeArquivo = basename($arquivo["name"]);
        $mime = $arquivo["type"];
        $tmp_path = $arquivo["tmp_name"];
        $tamanhoArquivo = $arquivo['size'];
        $caminhoArquivo = "/uploads/tmp";

        $avaliacao = compact("idCliente", "idUsuario", "caminhoArquivo", "mime", "nomeArquivo", "tamanhoArquivo", "data",
                             "idade", "sexo", "peso", "altura", "fumante", "diabetico", "problemaCardiaco", "lesaoOrtopedica",
                             "triceps", "suprailiaca", "abdominal", "coxa", "subescapular", "gordura");
        
        $idAvaliacao = $this->Avaliacao->create($avaliacao);
        if (!$idAvaliacao) Errors::send(500);
            
        $avaliacao["id"] = $idAvaliacao;

        $targetDir = "uploads/";
        $extension = pathinfo($nomeArquivo,PATHINFO_EXTENSION);
        $avaliacao["caminhoArquivo"] = $targetDir . $idAvaliacao . "." . $extension;
        
        $allowedExtensions = ["jpg", "jpeg", "png", "gif", "pdf", "doc", "docx"];

        move_uploaded_file($tmp_path, $avaliacao["caminhoArquivo"]);

        $res = $this->Avaliacao->update($avaliacao);
        if (!$res) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>$avaliacao]);
    }

    /*
     * http://localhost/avaliacao/deletar/:id
     */
    function deletar ($id = false) {

        if (!$id) Errors::send(500);
        
        $this->model('Avaliacao');

        $avaliacao = compact("id");

        $res = $this->Avaliacao->delete($avaliacao);
        if (!$res) Errors::send(500);

        header('Content-type: application/json');
        echo json_encode(["status"=>$avaliacao]);
    }

}

?>