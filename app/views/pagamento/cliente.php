<div class="container py-5">
    <h1 class="text-center">Pagamentos: <?=$nomeCliente?></h1>
    <section class="my-5">
        <h2>Férias</h2>
        <?php if(count($periodosFerias) == 0):?>
        <p>Nenhum período de férias registrado.</p>
        <?php endif; ?>
        <?php if(count($pagamentos) > 0 && $pagamentos[0]["tipo"] == "A"):?>
        <ul class="mt-4">
            <?php foreach($periodosFerias as $periodoFerias){ ?>
            <li class="mb-2">
                <span>
                    <?=date('d/m/Y', strtotime($periodoFerias["dataInicio"]))?> até
                    <?=date('d/m/Y', strtotime($periodoFerias["dataFim"]))?>
                </span>
                <button class="btn btn-danger ml-3 remover" data-id="<?=$periodoFerias["id"]?>">Remover</button>
            </li>
            <?php } ?>
        </ul>
        <?php if(count($periodosFerias) < 3):?>
        <form id="formFerias" method="POST" action="/academia/periodoferias/inserir">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="data">Início</label>
                    <input type="text" class="form-control" id="dataInicio" name="dataInicio" placeholder="DD/MM/YYYY"
                        required>
                    <div class="invalid-feedback">
                        Por favor, informe uma data válida.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="data">Fim</label>
                    <input type="text" class="form-control" id="dataFim" name="dataFim" placeholder="DD/MM/YYYY"
                        required>
                    <div class="invalid-feedback">
                        Por favor, informe uma data válida.
                    </div>
                </div>
            </div>
            <div id="alertFerias" class="alert alert-danger collapse" role="alert">
                <strong>Erro!</strong>
                <span>Texto</span>
            </div>
            <button class="btn btn-secondary mt-3" type="submit">Registrar</button>
        </form>
        <?php endif; ?>
        <?php endif;?>
    </section>
    <table id="tablePagamentos" class="table table-striped table-hover table-responsive-md">
        <caption>Lista de pagamentos</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Data</th>
                <th scope="col">Pago</th>
                <th scope="col">Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pagamentos as $pagamento){ ?>
            <tr>
                <th scope="row"><?=$pagamento["id"]?></th>
                <td><?=date('d/m/Y', strtotime($pagamento["data"]))?></td>
                <td><?=$pagamento["pago"] ? "Sim" : "Inadimplente" ?></td>
                <td><?=$pagamento["tipo"] == "M" ? "Mensal" : "Anual" ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="modalInsertLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInsertLabel">Novo Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNovoPagamento" method="POST" action="/academia/pagamento/inserir" novalidate>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="data">Data do pagamento</label>
                                <input type="text" class="form-control" id="data" name="data" placeholder="DD/MM/YYYY"
                                    required>
                                <div class="invalid-feedback">
                                    Por favor, informe uma data válida.
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="newpago" name="newpago">
                                    <label class="form-check-label" for="newpago">
                                        Pago
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Fechar</button>
                    <button type="submit" class="btn btn-success" form="formNovoPagamento">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Editar Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarPagamento" method="POST" action="/academia/pagamento/alterar" novalidate>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <p>Tipo: <span id="tipo"></span></p>
                                <p>Data: <span id="data"></span></p>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Fechar</button>
                    <button type="submit" class="btn btn-success" form="formEditarPagamento">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#dataInicio').mask('00/00/0000');
        $('#dataFim').mask('00/00/0000');

        $('#data').mask('00/00/0000');

        var remover = function (id) {
            $.ajax({
                type: "GET",
                url: "/academia/periodoferias/remover/" + id,
                data: null,
                success: function (data) {
                    document.location.reload(false);
                },
                error: function (data) {
                    $('#alertFerias span').text(data.responseJSON.message);
                    $("#alertFerias").show();
                }
            });
        }

        $(".remover").each(function (index) {
            $(this).click(function () {
                remover($(this).attr("data-id"));
            })
        });

        var selectedId = null;

        $("#formNovoPagamento").submit(function (e) {
            e.preventDefault();
            var form = new FormData(this);
            var url = $(this).attr('action');

            form.append("idCliente", window.location.pathname.split("/").pop());

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        location.reload()
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
            $(this).addClass("was-validated");
        });

        $("#formEditarPagamento").submit(function (e) {
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
                        location.reload()
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
                [0, "asc"]
            ],
            "select": true,
            "buttons": [{
                "text": '<i class="fa fa-plus mr-2"/>Inserir',
                "className": 'btn btn-success btn-sm',
                "action": function () {
                    $('#formNovoPagamento')[0].reset();
                    $("#modalInsert").modal('show');
                }
            }, {
                "text": '<i class="fa fa-edit mr-2"/>Editar',
                "className": 'btn btn-info btn-sm disabled',
                "action": function () {
                    var data = table.rows({
                        selected: true
                    }).data()[0];

                    selectedId = data[0];
                    console.log(data)

                    $("#tipo").text(data[3]);
                    $("#data").text(data[1]);

                    if (data[2] == "Sim") {
                        $("#pago").prop("checked", true);
                    } else {
                        $("#pago").prop("checked", false);
                    }

                    $("#modalEdit").modal('show');
                }
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
            }
        };

        var table = $('#tablePagamentos').DataTable(options);

        $("#formFerias").submit(function (e) {
            e.preventDefault();
            var idCliente = location.href.substring(location.href.lastIndexOf('/') + 1);

            var form = new FormData(this);
            var url = $(this).attr('action');

            form.append('idCliente', idCliente);

            if (this.checkValidity()) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        document.location.reload(false);
                    },
                    error: function (data) {
                        $('#alertFerias span').text(data.responseJSON.message);
                        $("#alertFerias").show();
                    }
                });
            }
            $(this).addClass("was-validated");
        });

        table.on('select', function (e, dt, type, indexes) {
                var rowData = table.rows(indexes).data().toArray();
                table.buttons('.btn-info').enable();
            })
            .on('deselect', function (e, dt, type, indexes) {
                table.buttons('.btn-info').disable();
            });
    });
</script>