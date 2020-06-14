<div class="container my-5">
    <h1 class="header my-5">Novo Aluno</h1>
    <form id="formCliente" method="POST" action="/academia/cliente/inserir" novalidate>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="nome">Nome completo</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo" value=""
                    required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="rg">RG</label>
                <input type="number" class="form-control" id="rg" name="rg" placeholder="RG" value="" required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="###.###.###-##" value=""
                    required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Seu endereço" value=""
                required>
            <div class="valid-feedback">
                Parece bom!
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" required>
                <div class="invalid-feedback">
                    Por favor, informe um cidade válida.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="uf">Estado</label>
                <input type="text" class="form-control" id="uf" name="uf" placeholder="Estado" required maxlength="2">
                <div class="invalid-feedback">
                    Por favor, informe um estado válido.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" required>
                <div class="invalid-feedback">
                    Por favor, informe um CEP válido.
                </div>
            </div>
        </div>
        <h3 class="my-3">Pagamento</h3>
        <div class="form-row">
            <div class="col-12 mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="mensal" value="M" checked>
                    <label class="form-check-label" for="mensal">Mensal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="anual" value="A">
                    <label class="form-check-label" for="anual">Anual</label>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="data">Data do pagamento</label>
                <input type="text" class="form-control" id="data" name="data" placeholder="DD/MM/YYYY" required>
                <div class="invalid-feedback">
                    Por favor, informe uma data válida.
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="pago" name="pago">
                    <label class="form-check-label" for="pago">
                        Pago
                    </label>
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
        $('#data').mask('00/00/0000');
        $('#cep').mask('00000-000');
        $("#formCliente").submit(function (e) {
            e.preventDefault();
            var form = new FormData(this);
            var url = $(this).attr('action');

            form.set("cpf", $("#cpf").cleanVal());
            form.set("cep", $("#cep").cleanVal());

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                        window.location.href = "/academia/cliente"
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