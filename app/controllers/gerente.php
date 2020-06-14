<?php

class GerenteController extends Controller {

    /*
     * http://localhost/gerente
     */
    function Index () {

        $title = "Gerente";

        if (!isset($_SESSION['login'])) {

            header('Location: /login');

        } else {

            $this->view('template/header', ['title' => $title]);
            $this->view('gerente/index');
            $this->view('template/footer');
            
        }
        
    }

    /*
     * http://localhost/gerente/subpage/[$parameter]
     */
    function subpage ($parameter = '') {

        $title = "Subpage";
        $viewData = array(
            'parameter' => $parameter
        );

        $this->view('template/header', ['title' => $title]);
        $this->view('gerente/subpage', $viewData);
        $this->view('template/footer');

    }

}

?>