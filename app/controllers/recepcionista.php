<?php

class RecepcionistaController extends Controller {

    /*
     * http://localhost/recepcionista
     */
    function Index () {

        $title = "Recepcionista";

        if (!isset($_SESSION['login'])) {

            header('Location: /login');

        } else {

            $this->view('template/header', ['title' => $title]);
            $this->view('recepcionista/index');
            $this->view('template/footer');
            
        }
        
    }

    /*
     * http://localhost/recepcionista/subpage/[$parameter]
     */
    function subpage ($parameter = '') {

        $title = "Subpage";
        $viewData = array(
            'parameter' => $parameter
        );

        $this->view('template/header', ['title' => $title]);
        $this->view('recepcionista/subpage', $viewData);
        $this->view('template/footer');

    }

}

?>