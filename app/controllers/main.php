<?php

class Main extends Controller {

    /*
     * http://localhost/
     */
    function Index () {
        
        if (isset($_SESSION['login']) && isset($_SESSION['tipo'])) {
            $tipo = $_SESSION['tipo'];
            $rota = [
                'R' => 'recepcionista',
                'G' => 'gerente',
                'F' => 'fisioterapeuta',
            ];
            $rota = $rota[$tipo];
            header("Location: /academia/$rota");
            
        } else {
            header('Location: /academia/login');
        }
        
    }

    /*
     * http://localhost/anothermainpage
     */
    function anotherMainPage () {
        echo 'Works!';
    }

}

?>