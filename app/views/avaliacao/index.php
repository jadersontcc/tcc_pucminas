<div class="container py-5">
    <h1 class="text-center">Avaliações</h1>
    <table id="tableAvaliacoes" class="table table-striped table-hover table-responsive-md" style="width:100%">
        <caption>Lista de avaliações</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID do Cliente</th>
                <th scope="col">Nome</th>
                <th scope="col">Sexo</th>
                <th scope="col">Data</th>
                <th scope="col">Arquivo</th>
                <th scope="col">Peso</th>
                <th scope="col">Altura</th>
                <th scope="col">Fumante</th>
                <th scope="col">Diabético</th>
                <th scope="col">Cardíaco</th>
                <th scope="col">Tem alguma lesão Ortopédica</th>
                <th scope="col">Medida dos tríceps</th>
                <th scope="col">Medida supra-ilíaca</th>
                <th scope="col">Medida do abdominal</th>
                <th scope="col">Medida da coxa</th>
                <th scope="col">Medida subescapular</th>
                <th scope="col">Percentual de gordura</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($avaliacoes as $avaliacao){ ?>
            <tr>
                <th scope="row"><?=$avaliacao["id"]?></th>
                <td><?=$avaliacao["idCliente"]?></td>
                <td><?=$avaliacao["nome"]?></td>
                <td><?=$avaliacao["sexo"] == "M" ? "Masculino" : "Feminino"?></td>
                <td>
                    <?=date('d/m/Y', strtotime($avaliacao["data"]))?></td>
                <td>
                    <a href="/academia/avaliacao/download/<?=$avaliacao["id"]?>">
                        <?=$avaliacao["nomeArquivo"]?>
                    </a>
                </td>
                <td><?=$avaliacao["peso"]?> kg</td>
                <td><?=$avaliacao["altura"]?> m</td>
                <td><?=$avaliacao["fumante"] == "S" ? "Sim" : "Não"?></td>
                <td><?=$avaliacao["diabetico"] == "S" ? "Sim" : "Não"?></td>
                <td><?=$avaliacao["problemaCardiaco"] == "S" ? "Sim" : "Não"?></td>
                <td><?=$avaliacao["lesaoOrtopedica"] == "S" ? "Sim" : "Não"?></td>
                <td><?=$avaliacao["triceps"]?> mm</td>
                <td><?=$avaliacao["suprailiaca"]?> mm</td>
                <td><?=$avaliacao["abdominal"]?> mm</td>
                <td><?=$avaliacao["coxa"]?> mm</td>
                <td><?=$avaliacao["subescapular"]?> mm</td>
                <td><?=$avaliacao["gordura"]?> %</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        var table = $('#tableAvaliacoes').DataTable({
            dom: 'Bftip',
            "order": [
                [1, "asc"]
            ],
            select: true,
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details for ' + data[2];
                        }
                    }),
                    renderer: function (api, rowIdx, columns) {
                        var filteredColumns = [];
                        if (columns[3].data == "Feminino") {
                            filteredColumns = columns.filter(function (col) {
                                return ![12, 14].includes(col.columnIndex);
                            });
                        } else if (columns[3].data == "Masculino") {
                            filteredColumns = columns.filter(function (col) {
                                return ![15, 16].includes(col.columnIndex);
                            });
                        }
                        data = $.map(filteredColumns, function (col, i) {
                            return '<tr data-dt-row="' + col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex + '">' +
                                '<td>' + col.title + ':' + '</td> ' +
                                '<td>' + col.data + '</td>' +
                                '</tr>';
                        }).join('');

                        return data ?
                            $('<table class="table"/>').append(data) :
                            false;
                    }
                }
            },
            buttons: [{
                text: '<i class="fa fa-trash mr-2"/>Deletar',
                className: 'btn btn-danger btn-sm disabled',
                action: function () {
                    var selected = table.rows({
                        selected: true
                    }).data()[0];
                    var res = confirm("Deseja deletar esta avaliação?");
                    if (res) {
                        $.ajax({
                            type: "POST",
                            url: "/academia/avaliacao/deletar/" + selected[0],
                            success: function (data) {
                                console.log(data);
                                window.location.href = "/academia/avaliacao/";
                            },
                            error: function (data) {
                                console.log(data);
                            }
                        });
                    }
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
            },
        });
        table.on('select', function (e, dt, type, indexes) {
                var rowData = table.rows(indexes).data().toArray();
                table.buttons(0, null).enable();
            })
            .on('deselect', function (e, dt, type, indexes) {
                table.buttons(0, null).disable();
            });
        $(".cpf").mask("000.000.000-00");
    });
</script>