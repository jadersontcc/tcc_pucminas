<div class="container py-5">
    <h1 class="text-center">Aula</h1>
    <table id="tableAulas" class="table table-striped table-hover table-responsive-md w-100">
        <caption>Lista de aulas</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Sala</th>
                <th scope="col">Início</th>
                <th scope="col">Fim</th>
                <th scope="col">Dias</th>
                <th scope="col">Instrutor</th>
                <th scope="col">IdInstrutor</th>
                <th scope="col">Dias(Num)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($aulas as $aula){ ?>
            <tr>
                <th scope="row"><?=$aula["id"]?></th>
                <td><?=$aula["nome"]?></td>
                <td><?=$aula["sala"]?></td>
                <td><?=$aula["horaInicio"]?></td>
                <td><?=$aula["horaFim"]?></td>
                <td><?=$aula["diasExtenso"]?></td>
                <td><?=$aula["nomeInstrutor"]?></td>
                <td><?=$aula["idInstrutor"]?></td>
                <td><?=$aula["dias"]?></td>
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
                    <h5 class="modal-title" id="modalEditLabel">Editar Aula</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAula" method="POST" action="/academia/aula/alterar" novalidate>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome"
                                    required>
                                <div class="valid-feedback">
                                    Parece bom!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nome">Sala</label>
                                <input type="text" class="form-control" id="sala" name="sala" placeholder="Sala"
                                    required>
                                <div class="valid-feedback">
                                    Parece bom!
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6 mb-3">
                                <label for="horaInicio">Horário de Início</label>
                                <input type="text" class="form-control hora" id="horaInicio" name="horaInicio"
                                    placeholder="HH:MM" required>
                                <div class="valid-feedback">
                                    Parece bom!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="horaFim">Horário de Término</label>
                                <input type="text" class="form-control hora" id="horaFim" name="horaFim"
                                    placeholder="HH:MM" value="" required>
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
                                    <input class="form-check-input" type="checkbox" name="dias[]" id="domingo"
                                        value="0">
                                    <label class="form-check-label" for="domingo">Domingo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dias[]" id="segunda"
                                        value="1">
                                    <label class="form-check-label" for="segunda">Segunda-feira</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dias[]" id="terca" value="2">
                                    <label class="form-check-label" for="terca">Terça-feira</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dias[]" id="quarta" value="3">
                                    <label class="form-check-label" for="quarta">Quarta-feira</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dias[]" id="quinta" value="4">
                                    <label class="form-check-label" for="quinta">Quinta-feira</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dias[]" id="sexta" value="5">
                                    <label class="form-check-label" for="sexta">Sexta-feira</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dias[]" id="sabado" value="6">
                                    <label class="form-check-label" for="sabado">Sábado</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Fechar</button>
                    <button type="submit" class="btn btn-success" form="formAula">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $(".hora").mask("00:00");

        var selectedId = null;

        $("#formAula").submit(function (e) {
            e.preventDefault();
            var form = new FormData(this);
            var url = $(this).attr('action');

            form.append("id", selectedId);

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        window.location.href = "/academia/aula"
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
            $(this).addClass("was-validated");
        });

        var table = $('#tableAulas').DataTable({
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

                        $('#formAula')[0].reset();

                        selectedId = data[0];

                        var dias = data[8].split("");

                        var camposDias = {
                            "0": "#domingo",
                            "1": "#segunda",
                            "2": "#terca",
                            "3": "#quarta",
                            "4": "#quinta",
                            "5": "#sexta",
                            "6": "#sabado",
                        }

                        for (i in dias) {
                            $(camposDias[dias[i]]).prop("checked", true);
                        }

                        $("#nome").val(data[1]);
                        $("#sala").val(data[2]);
                        $("#horaInicio").val(data[3].substring(0, 5));
                        $("#horaFim").val(data[4].substring(0, 5));

                        $("#idInstrutor").val(data[7]);

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
                            "Deseja deletar esta aula? Esta operação não pode ser desfeita!"
                        );
                        if (res) {
                            $.ajax({
                                type: "POST",
                                url: "/academia/aula/deletar/" + selected[0],
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
            "columnDefs": [{
                "targets": [-1, -2],
                "searchable": false,
                "visible": false
            }],
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
    });
</script>