<?php

class App {

    private $config = [];

    public $db;

    function __construct () {

        define("URI", $_SERVER['REQUEST_URI']);
        define("ROOT", $_SERVER['DOCUMENT_ROOT']."/academia");

    }

    function autoload () {

        spl_autoload_register(function ($class) {
            $class = strtolower($class);
            if (file_exists(ROOT . '/core/classes/' . $class . '.php')) {

                require_once ROOT . '/core/classes/' . $class . '.php';

            } else if (file_exists(ROOT . '/core/helpers/' . $class . '.php')) {

                require_once ROOT . '/core/helpers/' . $class . '.php';

            }

        });

    }

    function config () {

        $this->require('/core/config/session.php');
        $this->require('/core/config/database.php');      

        try {

            $this->db = new PDO('mysql:host=' . $this->config['database']['hostname'] . ';dbname=' . $this->config['database']['dbname'],
                                $this->config['database']['username'], 
                                $this->config['database']['password']);

            $this->db->query('SET NAMES utf8');
            $this->db->query('SET CHARACTER_SET utf8_unicode_ci');
            
            // TODO: Remove for production
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            echo 'Erro: ' . $e->getMessage();

        }

    }

    function require ($path) {

        require ROOT . $path;

    }

    function start () {

        session_name($this->config['sessionName']);
        session_start();

        $route = explode('/', URI);

        $route[2] = strtolower($route[2]);

        $allowed = false;
        if (isset($_SESSION['login']) && isset($_SESSION['tipo'])) {
            $tipo = $_SESSION['tipo'];
            $rotas = [
                'R' => 'recepcionista',
                'G' => 'gerente',
                'F' => 'fisioterapeuta',
            ];
            $forbidden = array_filter($rotas, function ($el) use ($tipo, $rotas){
              return $el != $rotas[$tipo];
            });
            $rota = $rotas[$tipo];
            if (file_exists(ROOT . '/app/controllers/' . $route[2] . '.php') 
                && !in_array($route[2], $forbidden)) {
                $allowed = true;
            }
        } else {
            if (isset($route[3]) && 
                (($route[2]."/".$route[3] == "aluno/aluno") ||
                 ($route[2]."/".$route[3] == "cliente/marcarPresenca") ||
                 ($route[2]."/".$route[3] == "presenca/marcarPresenca") ||
                 ($route[2]."/".$route[3] == "presenca/consulta")||
                 ($route[2]."/".$route[3] == "presenca/historico"))
               ) {
                $allowed = true;
            }
            if ($route[2] == "login") {
                $allowed = true;
            }
        }

        if ($allowed) {
            $this->require('/app/controllers/' . $route[2] . '.php');
            $route[2] = $route[2]."Controller";
            $controller = new $route[2]();
        } else {
            $this->require('/app/controllers/main.php');
            $main = new Main();
        }
    }
    
}

?>