<div class="container my-5">
    <h1 class="header my-5">Novo Instrutor</h1>
    <form id="formInstrutor" method="POST" action="/academia/instrutor/inserir" novalidate>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="nome">Nome completo</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo" value=""
                    required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="rg">RG</label>
                <input type="number" class="form-control" id="rg" name="rg" placeholder="RG" value="" required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="###.###.###-##" value=""
                    required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipoAtividade" id="musculacao" value="M" checked>
                    <label class="form-check-label" for="musculacao">Musculação</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipoAtividade" id="grupo" value="G">
                    <label class="form-check-label" for="grupo">Aulas em grupo</label>
                </div>
            </div>
        </div>
        <button class="btn btn-secondary mt-3" type="submit">Cadastrar</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#cpf').mask('000.000.000-00', {
            reverse: true
        });
        $("#formInstrutor").submit(function (e) {
            e.preventDefault();
            var form = new FormData(this);
            var url = $(this).attr('action');

            form.set("cpf", $("#cpf").cleanVal());

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                        window.location.href = "/academia/instrutor"
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
            $(this).addClass("was-validated");
        });
    });
</script>