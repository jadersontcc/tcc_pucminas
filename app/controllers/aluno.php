<?php

class AlunoController extends Controller {

    /*
     * http://localhost/aluno
     */
    
    function Index () {

        $title = "Aluno";

        $this->view('template/aluno', ['title' => $title]);
        
    }

}

?>