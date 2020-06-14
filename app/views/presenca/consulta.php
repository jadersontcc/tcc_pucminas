<div class="container mt-5">
    <h1 class="header text-center">Consultar Presença</h1>
    <form id="formPresenca" method="POST" action="/academia/presenca/historico" novalidate>
        <div class="form-row col-12">
            <div class="col-md-6 form-row">
                <div class="col-12 mt-5 mb-3">
                    <strong>Entre com a sua matrícula caso não seja possível fornecer a digital.</strong>
                </div>
                <div class="col-6 mb-3">
                    <label for="matricula">Matrícula</label>
                    <input type="text" class="form-control" id="matricula" name="id" placeholder="Matrícula" value=""
                        required>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-secondary mt-3" type="submit">Entrar</button>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Histórico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="example" class="display" width="100%">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Aula</th>
                                <th>Instrutor</th>
                            </tr>
                        </thead>
                    </table>
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

        var table = $('#example').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ linhas por página",
                "zeroRecords": "Nenhum registro encontrado - Sentimos muito",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(Filtrando de um total de _MAX_ registros)",
                "search": "Pesquisar",
                "paginate": {
                    "first": "Primeira",
                    "last": "Última",
                    "next": "Próxima",
                    "previous": "Anterior"
                },
            },
            "columns": [{
                    "data": "data"
                },
                {
                    "data": "nomeAula"
                },
                {
                    "data": "nomeInstrutor"
                }
            ]
        });

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
                        table.clear();
                        table.rows.add(data).draw();
                        $('#modalSuccess').modal('show');
                    },
                    error: function (res) {
                        $('#alertPresenca span').text(res.responseJSON.message);
                        $("#alertPresenca").show();
                    }
                });
            }
            $(this).addClass("was-validated");
        });

        $('#myModal').on('hidden.bs.modal', function (e) {
            table.clear();
        });
    });
</script>