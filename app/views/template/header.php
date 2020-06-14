<!DOCTYPE html>
<html lang="pt-br" class="h-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?=$title?></title>
  <link rel="stylesheet" type="text/css" href="/academia/public/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/academia/public/css/bootstrap.min.css.map">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="/academia/public/css/fontawesome.all.min.css">
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
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/pdfmake.min.js.map"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/vfs_fonts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
</head>

<body class="d-flex flex-column h-100">
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
      <div class="container">
        <a class="navbar-brand mr-auto" href="/academia/" >
          <img height="40px" alt="Brand" src="/academia/public/img/academialogo.png">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
          <spam class="navbar-toggler-icon"></spam>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="/academia/">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/academia/aluno/aluno">Espaço do Aluno</a>
            </li>
          </ul>
          <?php if (isset($_SESSION["login"])): ?>
          <a class="btn btn-outline-light my-2 my-sm-0" href="/academia/login/logout" role="button">Sair</a>
          <?php endif; ?>
        </div>
    </nav>
  </header>
  <main class="flex-shrink-0" role="main">