<div class="container my-5">
    <h1 class="header my-5">Nova Aula</h1>
    <form id="formAula" method="POST" action="/academia/aula/inserir" novalidate>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="" required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="nome">Sala</label>
                <input type="text" class="form-control" id="sala" name="sala" placeholder="Sala" value="" required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6 mb-3">
                <label for="horaInicio">Horário de Início</label>
                <input type="text" class="form-control hora" id="horaInicio" name="horaInicio" placeholder="HH:MM"
                    value="" required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="horaFim">Horário de Término</label>
                <input type="text" class="form-control hora" id="horaFim" name="horaFim" placeholder="HH:MM" value=""
                    required>
                <div class="valid-feedback">
                    Parece bom!
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6 mb-3">
                <label for="idInstrutor">Instrutor</label>
                <select class="form-control" name="idInstrutor" id="idInstrutor">
                    <?php foreach($instrutores as $instrutor) {?>
                    <option value="<?=$instrutor['id']?>"><?=$instrutor['nome']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-row text-center">
            <div class="col-12 mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="dias[]" id="domingo" value="0">
                    <label class="form-check-label" for="domingo">Domingo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="dias[]" id="segunda" value="1" checked>
                    <label class="form-check-label" for="segunda">Segunda-feira</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="dias[]" id="terca" value="2" checked>
                    <label class="form-check-label" for="terca">Terça-feira</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="dias[]" id="quarta" value="3" checked>
                    <label class="form-check-label" for="quarta">Quarta-feira</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="dias[]" id="quinta" value="4" checked>
                    <label class="form-check-label" for="quinta">Quinta-feira</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="dias[]" id="sexta" value="5" checked>
                    <label class="form-check-label" for="sexta">Sexta-feira</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="dias[]" id="sabado" value="6">
                    <label class="form-check-label" for="sabado">Sábado</label>
                </div>
            </div>
        </div>
        <button class="btn btn-secondary mt-3" type="submit">Cadastrar</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        $(".hora").mask("00:00");
        $("#formAula").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function (data) {
                        console.log(data);
                        window.location.href = "/academia/aula";
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