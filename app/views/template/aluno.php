<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Academia de Ginástica</title>

    <!--Incluindo o CSS do bootstrap-->
    <link rel="stylesheet" href="/academia/app/public/css/bootstrap.css">
    <!--Incluindo o JS do bootstrap-->
    <script src="/academia/app/public/js/jquery.js"></script>
    <script src="/academia/app/public/js/bootstrap.js"></script>

    <link rel="stylesheet" type="text/css" href="/academia/public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/academia/public/css/bootstrap.min.css.map">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/academia/public/css/app.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="/academia/public/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/pdfmake.min.js.map"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/vfs_fonts.js"></script>

</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container mr-auto">
            <a class="navbar-brand mr-auto" href="/academia/login">
                <img height="40px" alt="brand" src="/academia/public/img/academialogo.png">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenu">
                <spam class="navbar-toggler-icon"></spam>
            </button>

            <!--MENU-->
            <div class="collapse navbar-collapse" id="navbarmenu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/academia/login">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#quemsomos">Quem Somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#planos">Planos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/academia/presenca/marcarPresenca">Biometria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/academia/presenca/consulta">Consultar Presença</a>
                    </li>
                </ul>

            </div>
    </nav>

    <!--CAROUSEL-->
    <div class="container">
        <div id="carouselSite" class="carousel slide" data-ride="carousel">
            <!--Identifica qual item do carousel está-->
            <ol class="carousel-indicators">
                <li data-target="#carouselSite" data-slide-to="0" class="active"></li>
                <li data-target="#carouselSite" data-slide-to="1"></li>
                <li data-target="#carouselSite" data-slide-to="2"></li>
            </ol>
            <!--ITENS-->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid d-block" src="/academia/public/img/cimg1.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>SEU OBJETIVO, NOSSO COMPROMISSO!</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid d-block" src="/academia/public/img/cimg2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>SEU OBJETIVO, NOSSO COMPROMISSO!</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid d-block" src="/academia/public/img/cimg3.jpg" alt="Third slide">
                    <div class="carousel-caption text-secondary d-none d-md-block">
                        <h3>SEU OBJETIVO, NOSSO COMPROMISSO!</h3>
                    </div>
                </div>
            </div>

            <!--Button Carousel - prev-->
            <a class="carousel-control-prev" href="#carouselSite" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!--Button Carousel - next-->
            <a class="carousel-control-next" href="#carouselSite" role="button" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!--Div Quem Somos-->
    <div class="container" id="quemsomos">
        <div class="row">
            <div class="col-12 text-center my-5">
                <h1>Quem somos?</h1><br>
                <p>Somos uma academia tradicional localizada na cidade de Manaus com mais de 20 anos no
                    mercado, sempre trabalhando para criar relacionamentos mais próximos com nossos alunos
                    e fazer da nossa academia uma extensão da sua casa. Trabalhar pela saúde e pela melhoria
                    da qualidade de vida das pessoas é a nossa essência. Aqui você pode realizar diversos tipos
                    de atividades e manter-se completamente em forma, trabalhando tanto seu corpo quanto sua mente.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 text-left reveal my-5">
                <h3>Nossa Missão</h3><br>
                <p>Oferecer excelência em atendimento e prestação<br>
                    de serviços na orientação de atividades físicas<br>
                    para proporcionar qualidade de vida e bem estar<br>
                    aos nossos clientes, com profissionalismo, bom<br>
                    humor e ambiente acolhedor.
                </p>
            </div>

            <div class="col-md-4 text-letf reveal my-5">
                <h3> Nossa Visão</h3><br>
                <p>Ser referência na região, em excelência<br>
                    de atendimento e qualidade dos serviços<br>
                    prestados, conquistar o entusiasmo<br>
                    de nossos clientes através da melhoria<br>
                    contínua, alcançada pelo trabalho em equipe<br>
                    e pela capacidade de inovar do time,<br>
                    gerando frutos com novas filiais.
                </p>
            </div>

            <div class="col-md-4 text-left reveal my-5">
                <h3> Nossos Valores</h3><br>
                <p> -> Excelência no atendimento ao cliente acima de tudo;<br>
                    -> Trabalho duro, ética, respeito, comprometimento e integridade;<br>
                    -> Compromisso com a inovação e entusiasmo;<br>
                    -> Nunca se acomodar, fazer parte de algo especial.
                </p>
            </div>
        </div>
    </div>

    <!--Div Planos-->
    <div class="container py-5" id="planos">
        <div class="row px-md-5 mx-auto">
            <div class="col-lg-12">
                <h3 class="text-center my-3">Temos o plano ideal para você!</h1><br>
            </div>
        </div>
        <div class="row px-md-5 mx-auto">
            <div class="col-lg-6">
                <div class="card px-2 py-2 mx-4 my-4 text-white bg-secondary">
                    <img class="card-img-top" src="/academia/public/img/plano1.jpg">
                    <div class="card-body">
                        <h4 class="card-title text-center">Plano Mensal</h4>
                        <p class="card-text text-center">
                            Com o plano mensal, você pagará todos os
                            meses uma taxa da mensalidade em um dia
                            definido por você!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card px-2  py-2 mx-4 my-4 text-white bg-secondary">
                    <img class="card-img-top" src="/academia/public/img/plano2.jpg">
                    <div class="card-body">
                        <h4 class="card-title text-center">Plano Anual</h4>
                        <p class="card-text text-center">
                            Com o plano anual, você pagará apenas
                            uma vez ao ano uma taxa referente ao seu plano,
                            tendo direito a 30 dias de férias!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer py-4 mt-auto bg-danger text-center">
        <div class="container">
            <span class="text-dark">Academia de Ginástica 2020 &copy</span>
        </div>
    </footer>
</body>

</html>