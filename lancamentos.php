<?php
include 'includes/nav.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-md-6">
                    <h2 class="title-1">Lançamentos</h2>
                </div>
                <div class="col-md-6">
                    <!-- Button trigger modal -->
                    <button style="float:right" type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                        data-target="#modalAdd">
                        Novo Lançamento
                    </button>




                    <!-- FIMMODAL -->
                </div>
            </div>
            <table class="table table-striped table-inverse" id="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>Id</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="table-body">

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novos Lançamentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-lancamento">
                    <div class="form-group">
                        <label for="mes">Selecione o Mês</label>
                        <input required="" type="month" class="form-control" name="mes" id="mes" onchange="updateMonth()"
                            placeholder="mês">
                    </div>
                    <div id="dias"></div>
                    <br><br>

                    <div class="ops" style="float:right">
                        <button id="btn-add" type="button" type="button" class="btn btn-primary disabled"
                            onclick="addDay()">Adicionar</button>
                        

                    </div>
                    <div id="resultado">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="submit()">Criar Lançamento(s)</button>
            </div>
        </div>
    </div>
</div>


<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
</div>

</div>

<!-- Jquery JS-->
<script src="assets/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="assets/bootstrap-4.1/popper.min.js"></script>
<script src="assets/bootstrap-4.1/bootstrap.min.js"></script>
<!-- assets JS       -->
<script src="assets/slick/slick.min.js">
</script>
<script src="assets/wow/wow.min.js"></script>
<script src="assets/animsition/animsition.min.js"></script>
<script src="assets/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="assets/counter-up/jquery.waypoints.min.js"></script>
<script src="assets/counter-up/jquery.counterup.min.js">
</script>
<script src="assets/circle-progress/circle-progress.min.js"></script>
<script src="assets/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="assets/chartjs/Chart.bundle.min.js"></script>
<script src="assets/select2/select2.min.js">
</script>


<!-- Main JS-->
<script src="js/main.js"></script>

<link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css" />

<script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
<script>
    // $(document).ready(function () {

    //     $('#table').DataTable({
    //         language: {
    //             url: 'assets/Portuguese-Brasil.json'
    //         },
    //         // ajax:{
    //         //     url:'api/lancamento.php?op=index',
    //         //     dataSrc:'',
    //         //     }

    //     });


    // });
</script>
<script>
    updateTable();
    function updateTable() {
        console.log("Getting API data");
        $("#table-body").html("");
        $.getJSON('api/lancamento.php?op=index', function (data) {
            $.each(data, function (index, value) {
                renderRow(value);
            })
        })
    }
    function renderRow(row) {
        $("#table-body").append('<tr><td>' + row[0] + '</td><td>' + row[1] + '</td><td><a class="btn btn-warning text-white" href="alterarlancamento.php?id=' + row[0] + '" role="button">Alterar</a>  <a class="btn btn-primary text-white" href="entregas.php?id=' + row[0] + '" role="button">Entregas</a></td></tr>');
    }

    function echoVal() {
        console.log($("#mes").val());
    }
    function addDay() {
        $("#dias").append('<div class="row"><div class="col-md-6"><div class="form-group><label for="dias[]">Dia</label><input required="" type="number"class="form-control" name="dias[]" id="dias"></div></div><div class="col-md-6"><div class="form-group><label for="dias[]">Qtd.</label><input required="" type="number"class="form-control" name="qtds[]" id="qtds"></div></div></div>');

    }

    function updateMonth() {
        echoVal();
        $("#btn-add").removeClass("disabled");
        if ($("#dias").html() == "") {

            addDay();
        }
    }
</script>
<script>
    function submit() {
        $.ajax({
            url: "api/lancamento.php?op=store",
            type: 'post',
            data: $("#form-lancamento").serialize(),
            beforeSend: function () {
                $("#resultado").html('<div class="alert alert-primary alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Aguarde!</strong> Solicitação em Andamento. </div>');
            }
        })
            .done(function (msg) {
                $("#resultado").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Sucesso! </strong> Lançamentos criados com êxito </div>');
                updateTable();

                $("#modalAdd").modal('hide');
                $("#resultado").html("");
                $("#dias").html("");
                $("#mes").val("");

                console.log(msg);



            })
            .fail(function (jqXHR, textStatus, msg) {
                $("#resultado").html(msg);

            });
    }
</script>
</body>

</html>
<!-- end document-->