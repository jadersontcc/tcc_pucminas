<div class="container col-8 py-5">
    <h1 class="header">Login</h1>
    <form id="formLogin" method="POST" action="/academia/login/log_in">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp"
                placeholder="Digite seu login">
            <small id="loginHelp" class="form-text text-muted">Nunca compartilharemos seu login!</small>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
        </div>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="recepcionista" value="R">
                <label class="form-check-label" for="recepcionista">Recepcionista</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="gerente" value="G">
                <label class="form-check-label" for="gerente">Gerente</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="fisioterapeuta" value="F">
                <label class="form-check-label" for="fisioterapeuta">Fisioterapeuta</label>
            </div>
        </div>
        <div id="alertLogin" class="alert alert-danger collapse" role="alert">
            <strong>Erro!</strong> Usuário não existente.
        </div>
        <button type="submit" class="btn btn-secondary">Entrar</button>
    </form>
</div>

<script>
    $(document).ready(function () {

        $("#formLogin").submit(function (e) {

            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function (data) {
                    console.log(data);
                    window.location.href = "/academia";
                },
                error: function (data) {
                    $("#alertLogin").show();
                }
            });
        });
    });
</script>