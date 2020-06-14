<div class="container mt-5">
    <h1 class="header my-5">Nova Avaliação</h1>
    <form id="formAvaliacao" method="POST" action="/academia/avaliacao/inserir" enctype="multipart/form-data"
        novalidate>
        <div class="form-row">
            <div class="col-md-8 mb-3">
                <label for="idCliente">Aluno</label>
                <select class="form-control" name="idCliente" id="idCliente">
                    <?php if (count($clientes) == 0): ?>
                    <option selected="true" disabled>Nenhum aluno encontrado</option>
                    <?php endif;?>
                    <?php foreach ($clientes as $cliente) {?>
                    <option value="<?=$cliente['id']?>"><?=$cliente['nome']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="data">Data em que a avaliação foi realizada</label>
                <input type="text" class="form-control" id="data" name="data" placeholder="DD/MM/YYYY" required>
                <div class="invalid-feedback">
                    Por favor, informe uma data válida.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="idade">Idade</label>
                <input type="number" class="form-control" id="idade" name="idade" min="0" required>
                <div class="invalid-feedback">
                    Por favor, informe uma idade válida.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="idade">Peso</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="peso" name="peso" min="0" step="0.1" required>
                    <div class="input-group-append">
                        <span class="input-group-text">kg</span>
                    </div>
                    <div class="invalid-feedback">
                        Por favor, informe um peso válida.
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="altura">Altura</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="altura" name="altura" min="0" step="0.01" required>
                    <div class="input-group-append">
                        <span class="input-group-text">m</span>
                    </div>
                    <div class="invalid-feedback">
                        Por favor, informe uma altura válida.
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <p>Sexo</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M">
                    <label class="form-check-label" for="masculino">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="feminino" value="F">
                    <label class="form-check-label" for="feminino">Feminino</label>
                </div>
            </div>
            <div class="col-12 my-3">
                <h2>Histórico de saúde</h2>
            </div>
            <div class="col-12 mb-3">
                <p>Fuma?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="fumante" required id="fumaSim" value="S">
                    <label class="form-check-label" for="fumaSim">Sim</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="fumante" id="fumaNao" value="N">
                    <label class="form-check-label" for="fumaNao">Não</label>
                    <div class="invalid-feedback ml-5">Campo Obrigatório!</div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <p>É diabético?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="diabetico" required id="diabeticoSim" value="S">
                    <label class="form-check-label" for="diabeticoSim">Sim</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="diabetico" id="diabeticoNao" value="N">
                    <label class="form-check-label" for="diabeticoNao">Não</label>
                    <div class="invalid-feedback ml-5">Campo Obrigatório!</div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <p>Tem algum problema cardíaco?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="problemaCardiaco" required
                        id="problemaCardiacoSim" value="S">
                    <label class="form-check-label" for="problemaCardiacoSim">Sim</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="problemaCardiaco" id="problemaCardiacoNao"
                        value="N">
                    <label class="form-check-label" for="problemaCardiacoNao">Não</label>
                    <div class="invalid-feedback ml-5">Campo Obrigatório!</div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <p>Tem algum problema ortopédico?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="lesaoOrtopedica" required id="lesaoOrtopedicaSim"
                        value="S">
                    <label class="form-check-label" for="lesaoOrtopedicaSim">Sim</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="lesaoOrtopedica" id="lesaoOrtopedicaNao"
                        value="N">
                    <label class="form-check-label" for="lesaoOrtopedicaNao">Não</label>
                    <div class="invalid-feedback ml-5">Campo Obrigatório!</div>
                </div>
            </div>
            <div class="col-12 d-none" id="dadosHomem">
                <div class="form-row">
                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="triceps">Medidas dos Tríceps</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="triceps" name="triceps" min="0" step="0.1">
                            <div class="input-group-append">
                                <span class="input-group-text">mm</span>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, informe uma medida válida.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="suprailiaca-m">Medida Supra-ilíaca</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="suprailiaca-m" name="suprailiaca-m" min="0"
                                step="0.1">
                            <div class="input-group-append">
                                <span class="input-group-text">mm</span>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, informe uma medida válida.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="abdominal">Medida Abdominal</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="abdominal" name="abdominal" min="0"
                                step="0.1">
                            <div class="input-group-append">
                                <span class="input-group-text">mm</span>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, informe uma medida válida.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none" id="dadosMulher">
                <div class="form-row">
                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="coxa">Medida da Coxa</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="coxa" name="coxa" min="0" step="0.1">
                            <div class="input-group-append">
                                <span class="input-group-text">mm</span>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, informe uma medida válida.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="suprailiaca-f">Medida Supra-ilíaca</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="suprailiaca-f" name="suprailiaca-f" min="0"
                                step="0.1">
                            <div class="input-group-append">
                                <span class="input-group-text">mm</span>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, informe uma medida válida.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <label for="subescapular">Medida Subescapular</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="subescapular" name="subescapular" min="0"
                                step="0.1">
                            <div class="input-group-append">
                                <span class="input-group-text">mm</span>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, informe uma medida válida.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="gordura">Gordura</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="gordura" name="gordura" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
            <p>Subir exame ergométrico</p>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="arquivo" name="arquivo">
                    <label class="custom-file-label" for="arquivo">Selecionar um arquivo...</label>
                    <div class="invalid-feedback">Escolha um arquivo.</div>
                </div>
            </div>
        </div>
        <button class="btn btn-secondary my-5" type="submit">Cadastrar</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
        $('#data').mask('00/00/0000');
        $("input[type=radio][name=sexo]").change(function (e) {
            var sexo = $(this).val();
            switch (sexo) {
                case "M": {
                    $("#dadosHomem").removeClass("d-none");
                    $("#dadosMulher").addClass("d-none");
                    break;
                }
                case "F": {
                    $("#dadosMulher").removeClass("d-none");
                    $("#dadosHomem").addClass("d-none");
                    break;
                }
            }
        });

        $("#triceps, #suprailiaca-m, #abdominal").keyup(function (e) {
            var triceps = parseFloat($("#triceps").val());
            var suprailiacam = parseFloat($("#suprailiaca-m").val());
            var abdominal = parseFloat($("#abdominal").val());

            if (triceps && suprailiacam && abdominal) {
                var densidadeCorporal = 1.1714 - 0.0671 * Math.log10(triceps + suprailiacam +
                    abdominal)
                var percGordura = ((4.95 / densidadeCorporal) - 4.50) * 100
                $("#gordura").val(percGordura.toFixed(2));
            }
        });

        $("#coxa, #suprailiaca-f, #subescapular").keyup(function (e) {
            var coxa = parseFloat($("#coxa").val());
            var suprailiacaf = parseFloat($("#suprailiaca-f").val());
            var subescapular = parseFloat($("#subescapular").val());

            if (coxa && suprailiacaf && subescapular) {
                var densidadeCorporal = 1.1714 - 0.0671 * Math.log10(coxa + suprailiacaf +
                    subescapular)
                var percGordura = ((4.95 / densidadeCorporal) - 4.50) * 100
                $("#gordura").val(percGordura.toFixed(2));
            }
        });

        $("#formAvaliacao").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        window.location.href = "/academia/avaliacao";
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