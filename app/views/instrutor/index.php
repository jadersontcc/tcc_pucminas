<div class="container py-5">
    <h1 class="text-center">Instrutores</h1>
    <table id="tableInstrutores" class="table table-striped table-hover table-responsive-md">
        <caption>Lista de instrutores</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">RG</th>
                <th scope="col">Tipo de atividade</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($instrutores as $instrutor){ ?>
            <tr>
                <th scope="row"><?=$instrutor["id"]?></th>
                <td><?=$instrutor["nome"]?></td>
                <td class="cpf"><?=$instrutor["cpf"]?></td>
                <td><?=$instrutor["rg"]?></td>
                <td><?=$instrutor["tipoAtividade"] == "M" ? 'Musculação' : 'Aulas em grupo'?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Editar Instrutor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formInstrutor" method="POST" action="/academia/instrutor/alterar" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="nome">Nome completo</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    placeholder="Nome Completo" value="" required>
                                <div class="valid-feedback">
                                    Parece bom!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="rg">RG</label>
                                <input type="number" class="form-control" id="rg" name="rg" placeholder="RG" readonly
                                    required>
                                <div class="valid-feedback">
                                    Parece bom!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="###.###.###-##"
                                    readonly required>
                                <div class="valid-feedback">
                                    Parece bom!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipoAtividade" id="musculacao"
                                        value="M" checked>
                                    <label class="form-check-label" for="musculacao">Musculação</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipoAtividade" id="grupo"
                                        value="G">
                                    <label class="form-check-label" for="grupo">Aulas em grupo</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Fechar</button>
                    <button type="submit" class="btn btn-success" form="formInstrutor">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        var selectedId = null;

        $("#formInstrutor").submit(function (e) {
            e.preventDefault();
            var form = new FormData(this);
            var url = $(this).attr('action');

            form.set("cpf", $("#cpf").cleanVal());

            form.append("id", selectedId);

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        window.location.href = "/academia/instrutor"
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
            $(this).addClass("was-validated");
        });

        var table = $('#tableInstrutores').DataTable({
            "dom": "Bfrtip",
            "order": [
                [1, "asc"]
            ],
            "select": true,
            "buttons": [{
                    "text": '<i class="fa fa-edit mr-2"/>Editar',
                    "className": 'btn btn-info btn-sm disabled',
                    "action": function () {
                        var data = table.rows({
                            selected: true
                        }).data()[0];

                        selectedId = data[0];

                        $("#nome").val(data[1]);
                        $("#cpf").val(data[2]);
                        $("#rg").val(data[3]);
                        if (data[4] == "Musculação") {
                            $("#musculacao").prop("checked", true);
                        } else if (data[4] == "Aulas em grupo") {
                            $("#grupo").prop("checked", true);
                        }

                        $("#modalEdit").modal('show');
                    }
                },
                {
                    text: '<i class="fa fa-trash mr-2"/>Deletar',
                    className: 'btn btn-danger btn-sm disabled',
                    action: function () {
                        var selected = table.rows({
                            selected: true
                        }).data()[0];
                        var res = confirm(
                            "Deseja deletar este instrutor? Esta operação não pode ser desfeita!"
                        );
                        if (res) {
                            $.ajax({
                                type: "POST",
                                url: "/academia/instrutor/deletar/" + selected[0],
                                success: function (data) {
                                    location.reload();
                                },
                                error: function (data) {
                                    console.log(data);
                                }
                            });
                        }
                    }
                }
            ],
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
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                }
            },
        });

        table.on('select', function (e, dt, type, indexes) {
                var rowData = table.rows(indexes).data().toArray();
                table.buttons('.btn-danger, .btn-info').enable();
            })
            .on('deselect', function (e, dt, type, indexes) {
                table.buttons('.btn-danger, .btn-info').disable();
            });

        $("#cpf").mask("000.000.000-00");
    });
</script>