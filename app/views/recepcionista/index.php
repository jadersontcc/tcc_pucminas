<div class="container py-5" id="opcoes">
  <h1 class="header mb-5">Olá, <?=$_SESSION['login']?>!</h1>
  <div class="row px-md-5 mx-auto">
    <div class="col-lg-4">
      <div class="card px-2 py-2 mx-4 my-4 text-white bg-secondary">
        <img class="card-img-top" src="/academia/public/img/aluno.jpg">
        <div class="card-body">
          <h5 class="card-title text-center">Gerenciar Alunos</h5>
          <ul class="list-group">
          <li class="list-group-item bg-secondary border-secondary">
            <a href="/academia/cliente/formcadastro" class="col-12 btn btn-outline-light">Novo Aluno</a>
          </li>
          <li class="list-group-item bg-secondary border-secondary">
            <a href="/academia/cliente/" class="col-12 btn btn-outline-light">Listar Aluno</a>
          </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card px-2  py-2 mx-4 my-4 text-white bg-secondary">
        <img class="card-img-top" src="/academia/public/img/instrutor.jpg">
        <div class="card-body">
          <h5 class="card-title text-center">Gerenciar Instrutores</h5>
          <ul class="list-group">
          <li class="list-group-item bg-secondary border-secondary">
            <a href="/academia/instrutor/formcadastro" class="col-12 btn btn-outline-light">Novo Instrutor</a>
          </li>
          <li class="list-group-item bg-secondary border-secondary">
            <a href="/academia/instrutor/" class="col-12 btn btn-outline-light">Listar Instrutores</a>
          </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card px-2  py-2 mx-4 my-4 text-white bg-secondary">
        <img class="card-img-top" src="/academia/public/img/aula.jpg">
        <div class="card-body">
          <h5 class="card-title text-center">Gerenciar Aulas</h5>
          <ul class="list-group">
          <li class="list-group-item bg-secondary border-secondary">
            <a href="/academia/aula/formcadastro" class="col-12 btn btn-outline-light">Nova Aula</a>
          </li>
          <li class="list-group-item bg-secondary border-secondary">
            <a href="/academia/aula/" class="col-12 btn btn-outline-light">Listar Aulas</a>
          </li>
          </ul>
        </div>
      </div>
    </div>
</div>