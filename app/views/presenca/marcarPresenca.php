<div class="container mt-5">
    <h1 class="header text-center">Marcar Presença</h1>
    <form id="formPresenca" method="POST" action="/academia/cliente/marcarPresenca" novalidate>
        <div class="form-row col-12 py-5">
            <div class="col-md-6 form-row">
                <div class="col-6">
                    <label for="idAula">Aulas</label>
                    <select class="form-control" name="idAula" id="idAula">
                        <?php if(count($aulas) == 0): ?>
                        <option selected="true" disabled>Nenhuma aula encontrada</option>
                        <?php endif;?>
                        <?php foreach($aulas as $aula) {?>
                        <option value="<?=$aula['id']?>"><?=$aula['nome']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12 mt-5 mb-3">
                    <strong>Entre com a sua matrícula caso não seja possível fornecer a digital.</strong>
                </div>
                <div class="col-6 mb-3">
                    <label for="matricula">Matrícula</label>
                    <input type="text" class="form-control" id="matricula" name="id" placeholder="Matrícula" value=""
                        required>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-secondary mt-3" type="submit">Confirmar</button>
                </div>
                <div class="col-12 mb-3">
                    <div id="alertPresenca" class="alert alert-danger collapse" role="alert">
                        <strong>Erro!</strong> <span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center py-5">
                <img class="align-self-start" src="/academia/public/img/fingerprint-icon.jpg">
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Resultado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <i class="far fa-check-circle fa-10x text-success"></i>
                        <h3 class="mt-3">Presença registrada com sucesso!</h3>
                        <div id="alertAvaliacao" class="alert alert-warning collapse" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> <span></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#matricula').mask('0#');
        $("#formPresenca").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function (data) {
                        $('#modalSuccess').modal('show');
                        if (data.message) {
                            $('#alertAvaliacao span').text(data.message);
                            $("#alertAvaliacao").show();
                        }
                    },
                    error: function (res) {
                        $('#alertPresenca span').text(res.responseJSON.message);
                        $("#alertPresenca").show();
                    }
                });
            }
            $(this).addClass("was-validated");
        });
    });
</script>