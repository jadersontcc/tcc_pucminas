<div class="container py-5">
    <h1 class="text-center">Alunos</h1>
    <table id="tableAlunos" class="table table-striped table-hover table-responsive-md">
        <caption>Lista de alunos</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">RG</th>
                <th scope="col">Próximo pagamento</th>
                <th scope="col">Endereço</th>
                <th scope="col">Pagamentos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clientes as $cliente){ ?>
            <tr>
                <th scope="row"><?=$cliente["id"]?></th>
                <td><?=$cliente["nome"]?></td>
                <td><?=$cliente["cpf"]?></td>
                <td><?=$cliente["rg"]?></td>
                <td>
                    <?=date('d/m/Y', strtotime($cliente["data"]))?>
                </td>
                <td><?=$cliente["endereco"]?>, <?=$cliente["cidade"]?>-<?=$cliente["uf"]?>, <?=$cliente["cep"]?></td>
                <td><a href="/academia/pagamento/cliente/<?=$cliente["id"]?>">Abrir</a></td>
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
                    <h5 class="modal-title" id="modalEditLabel">Editar Aluno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCliente" method="POST" action="/academia/cliente/alterar" novalidate>
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
                                <input type="number" class="form-control" id="rg" name="rg" placeholder="RG" readonly required>
                                <div class="valid-feedback">
                                    Parece bom!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="###.###.###-##" readonly
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Fechar</button>
                    <button type="submit" class="btn btn-success" form="formCliente">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        <?php 
            $buttons = isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "G" ? '"pdf"': '{
                "text": \'<i class="fa fa-edit mr-2"/>Editar\',
                "className": \'btn btn-info btn-sm disabled\',
                "action": function () {
                    var data = table.rows({
                        selected: true
                    }).data()[0];

                    selectedId = data[0];

                    $("#nome").val(data[1]);
                    $("#cpf").val(data[2]);
                    $("#rg").val(data[3]);

                    var endereco = data[5].split(", ")
                    var logradouro = endereco[0];
                    var cep = endereco[2];

                    var cidadeUf = endereco[1].split("-");
                    cidade = cidadeUf[0];
                    var uf = cidadeUf[1];

                    $("#endereco").val(logradouro);
                    $("#cidade").val(cidade);
                    $("#uf").val(uf);
                    $("#cep").val(cep);

                    $("#modalEdit").modal(\'show\');
                }
            }, 
            {
                text: \'<i class="fa fa-trash mr-2"/>Deletar\',
                className: \'btn btn-danger btn-sm disabled\',
                action: function () {
                    var selected = table.rows({
                        selected: true
                    }).data()[0];
                    var res = confirm("Deseja deletar este cliente?");
                    if (res) {
                        $.ajax({
                            type: "POST",
                            url: "/academia/cliente/deletar/" + selected[0],
                            success: function (data) {
                                console.log(data);
                                window.location.href = "/academia/cliente/";
                            },
                            error: function (data) {
                                console.log(data);
                            }
                        });
                    }
                }
            }'; 
        ?>

        $('#cpf').mask('000.000.000-00', {
            reverse: true
        });
        $('#data').mask('00/00/0000');
        $('#cep').mask('00000-000');

        var selectedId = null;

        $("#formCliente").submit(function (e) {
            e.preventDefault();
            var form = new FormData(this);
            var url = $(this).attr('action');

            form.set("cpf", $("#cpf").cleanVal());
            form.set("cep", $("#cep").cleanVal());
            form.append("id", selectedId);

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        window.location.href = "/academia/cliente"
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
            $(this).addClass("was-validated");
        });

        var options = {
            "dom": "Bfrtip",
            "order": [
                [1, "asc"]
            ],
            "select": true,
            "buttons": [
                <?= $buttons ?>
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
        };

        var table = $('#tableAlunos').DataTable(options);

        table.on('select', function (e, dt, type, indexes) {
                var rowData = table.rows(indexes).data().toArray();
                table.buttons('.btn-danger, .btn-info' ).enable();
            })
            .on('deselect', function (e, dt, type, indexes) {
                table.buttons('.btn-danger, .btn-info').disable();
            });
        $("#cpf").mask("000.000.000-00");
    });
</script>