<?php
include 'includes/nav.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-md-6">
                    <h2 class="title-1">Famílias</h2>
                </div>
                <div class="col-md-6">
                    <!-- Button trigger modal -->
                    <button style="float:right" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAdd">
                        Nova Família
                    </button>




                    <!-- FIMMODAL -->
                </div>
            </div>
            <table class="table table-striped table-inverse" id="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Nome Titular</th>
                        <th>Ponto de Recepção</th>
                        <th>CPF Titular</th>
                        <th>RG Titular</th>
                        <th>Contato</th>
                        <th>Mais Infância?</th>
                        <th>Anexos</th>
                        <th>Ações</th>


                    </tr>
                </thead>
                <tbody id="table-body"></tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova Família</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="formfamilia" id="form-familia" onsubmit="submitForm(event)" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input required="" type="text" class="form-control" name="nome" id="nome" placeholder="nome do titular">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ponto">Ponto de Distribuição</label>
                                <select name="ponto" required="" class="form-control" name="ponto" id="ponto">
                                    <option value="">selecione...</option>

                                    <?php
                                    include 'config/database.php';
                                    $query = $conexao->query("SELECT * FROM tb_ponto");
                                    $fetch = $query->fetchAll();
                                    foreach ($fetch as $ponto) { ?>
                                        <option value="<?php echo $ponto['idtb_ponto']; ?>"><?php echo $ponto['nome']; ?></option>

                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="cpf do titular">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_nascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" placeholder="Data de Nascimento do titular">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rg">RG</label>
                                <input type="text" class="form-control" name="rg" id="rg" placeholder="rg do titular">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="orgao_expedidor">Orgão Expedidor</label>
                                <input type="text" class="form-control" name="orgao_expedidor" id="orgao_expedidor" placeholder="orgao expedidor">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="nis">NIS</label>
                                <input type="text" class="form-control" name="nis" id="nis" placeholder="nis do titular">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="contato">Contato</label>
                                <input type="text" class="form-control" name="contato" id="contato" placeholder="contato do titular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome_pai">Nome do Pai</label>
                                <input type="text" class="form-control" name="nome_pai" id="nome_pai" placeholder="nome do pai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome_mae">Nome da Mãe</label>
                                <input type="text" class="form-control" name="nome_mae" id="nome_mae" placeholder="nome do mãe">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="rua">Rua</label>
                                <input type="text" class="form-control" name="rua" id="rua" aria-describedby="" placeholder="rua">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="bairro">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="numero">Número</label>
                                <input type="number" class="form-control" name="numero" id="numero" aria-describedby="helpId" placeholder="nº">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado_civil">Estado Civil</label>
                                <select class="form-control" name="estado_civil" id="estado_civil">
                                    <option value="">selecione...</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Solteiro">Solteiro</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mais_infancia">Participa do Mais Infância?</label>
                                <select class="form-control" name="mais_infancia" id="mais_infancia">
                                    <option value="">selecione...</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Documentação Geral</label>

                            <div class="custom-file">
                                <input accept="application/pdf" id="docIpt" onchange="updateDoc()" type="file" name="documento" class="custom-file-input" id="validatedCustomFile">
                                <label id="docLbl" class="custom-file-label" for="validatedCustomFile">Selecione</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Declaração</label>

                            <div class="custom-file">
                                <input accept="application/pdf" id="decIpt" type="file" onchange="updateDec()" name="declaracao" class="custom-file-input" id="validatedCustomFile">
                                <label id="decLbl" class="custom-file-label" for="validatedCustomFile">Selecione</label>
                            </div>
                        </div>
                    </div>



                    <div id="resultado">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>


                <button class="btn btn-primary">Cadastrar Família</button>
                </form>
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
<script>
    function updateDec() {
        $("#decLbl").html($("#decIpt").val());
    }

    function updateDoc() {
        $("#docLbl").html($("#docIpt").val());


    }
</script>

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
        $.getJSON('api/familia.php?op=index', function(data) {
            console.log(data);
            $.each(data, function(index, value) {
                renderRow(value);
            })
        })
    }

    function renderRow(row) {
        $("#table-body").append(
            '<tr><td>' + row[0] + '</td><td>' + row['nome'] + '</td><td>' + row['ponto'] + '</td><td>' + row['cpf'] + '</td><td>' + row['rg'] + '</td><td>' + row['contato'] + '</td><td>' + (row['mais_infancia'] == 1 ? 'Sim' : 'Não') + '</td><td><button class="btn btn-primary text-white btn-block" onclick=abrirUrl("' + row["src_doc"] + '") role="button">Documentos</button> <button class="btn btn-primary btn-block text-white " onclick=abrirUrl("' + row["src_declaracao"] + '") role="button">Declaração</button></td><td><a name="alterar" id="alterar" class="btn btn-warning btn-block text-white" href="alterarfamilia.php" role="button">Alterar</a></td></tr>');
    }
</script>
<script>
    function abrirUrl(url) {
        let win = window.open(url, '_blank');
        win.focus();
    }

    function submitForm(e) {
        e.preventDefault();

        let data = new FormData(document.forms.namedItem("formfamilia"));
        console.log("Storing");
        $.ajax({
                async: true,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                url: "api/familia.php?op=store",
                type: 'post',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        myXhr.upload.addEventListener('progress', function(evt) {}, false);
                    }
                    return myXhr;
                },

                beforeSend: function() {
                    $("#resultado").html('<div class="alert alert-primary alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Aguarde!</strong> Solicitação em Andamento. </div>');
                }
            })
            .done(function(msg) {
                console.log(msg);
                $("#resultado").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Sucesso! </strong> Família cadastrada com êxito </div>');
                updateTable();

                $("#modalAdd").modal('hide');
                $("#resultado").html("");
                document.formfamilia.reset();





            })
            .fail(function(textStatus, msg) {
                $("#resultado").html(msg);

            });
    }
</script>
</body>

</html>
<!-- end document-->