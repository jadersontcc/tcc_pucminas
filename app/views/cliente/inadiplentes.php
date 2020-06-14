<div class="container py-5">
    <h1 class="text-center">Alunos Inadimplentes</h1>
    <table id="tableAlunos" class="table table-striped table-hover table-responsive-md">
        <caption>Lista de alunos inadimplentes</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">RG</th>
                <th scope="col">Próximo pagamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente) { ?>
                <tr>
                    <th scope="row"><?=$cliente["id"]?></th>
                    <td><?=$cliente["nome"]?></td>
                    <td class="cpf"><?=$cliente["cpf"]?></td>
                    <td><?=$cliente["rg"]?></td>
                    <td>
                        <?=date('d/m/Y', strtotime($cliente["data"]))?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
$(document).ready(function() {
    <?php
        $buttons = isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="G" ? [ "pdf" ] : [];
    ?>

    var options = {
        "dom": "Bfrtip",
        "order": [[ 1, "asc" ]],
        "language": {
            "lengthMenu": "Mostrar _MENU_ linhas por página",
            "zeroRecords": "Nenhum registro encontrado - Sentimos muito",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(Filtrando de um total de _MAX_ registros)",
            "search": "Pesquisar",
            "paginate": {
                "first":      "Primeira",
                "last":       "Última",
                "next":       "Próxima",
                "previous":   "Anterior"
            },
        },
        "buttons": <?= json_encode($buttons) ?>
    };
    $('#tableAlunos').DataTable(options);
    $(".cpf").mask("000.000.000-00");
} );
</script>