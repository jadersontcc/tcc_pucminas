<?php

class FisioterapeutaController extends Controller {

    /*
     * http://localhost/fisioterapeuta
     */
    function Index () {

        $title = "Fisioterapeuta";

        if (!isset($_SESSION['login'])) {

            header('Location: /login');

        } else {

            $this->view('template/header', ['title' => $title]);
            $this->view('fisioterapeuta/index');
            $this->view('template/footer');
            
        }
        
    }

}

?>