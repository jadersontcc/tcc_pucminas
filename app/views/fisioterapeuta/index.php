<div class="container py-5" id="opcoes">
  <h1 class="header mb-5">Olá, <?=$_SESSION['login']?>!</h1>
  <div class="row px-md-5 mx-auto">
    <div class="col-lg-6">
      <div class="card px-2 py-2 mx-4 my-4 text-white bg-secondary">
        <img class="card-img-top" src="/academia/public/img/avaliacao.jpg">
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item bg-secondary border-secondary">
              <a href="/academia/avaliacao/formcadastro" class="col-12 btn btn-outline-light">Nova Avaliação Física</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card px-2  py-2 mx-4 my-4 text-white bg-secondary">
        <img class="card-img-top" src="/academia/public/img/avaliacao.jpg">
        <div class="card-body">
          <ul class="list-group">
          <li class="list-group-item bg-secondary border-secondary">
            <a href="/academia/avaliacao/" class="col-12 btn btn-outline-light">Listar Avaliações Físicas</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
</div>