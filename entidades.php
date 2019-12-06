<?php
include 'includes/nav.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-md-6">
                    <h2 class="title-1">Entidades</h2>
                </div>
                <div class="col-md-6">
                    <!-- Button trigger modal -->
                    <button style="float:right" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAdd">
                        Nova Entidade
                    </button>




                    <!-- FIMMODAL -->
                </div>
            </div>
            <table class="table table-striped table-inverse" id="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Nome </th>
                        <th>Nº Atendidos</th>
                        <th>CNPJ</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Responsável</th>
                        <th>CPF</th>
                        <th>Celular</th>
                        <th>Email</th>
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
                <h5 class="modal-title">Nova Entidade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="formentidade" id="form-entidade" onsubmit="submitForm(event)" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="nome da entidade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ponto">Distrito</label>
                                <select name="ponto" class="form-control" name="ponto" id="ponto">
                                    <option value="">selecione...</option>

                                    <?php
                                    include 'config/database.php';
                                    $query = $conexao->query("SELECT * FROM tb_localidade");
                                    $fetch = $query->fetchAll();
                                    foreach ($fetch as $ponto) { ?>
                                        <option value="<?php echo $ponto['idtb_localidade']; ?>"><?php echo $ponto['nome']; ?></option>

                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="cnpj da entidade">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone da Entidade">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email_entidade">Email</label>
                        <input type="email" class="form-control" name="email_entidade" id="email_entidade" aria-describedby="" placeholder="email da entidade">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsavel">Responsável</label>
                                <input type="text" class="form-control" name="responsavel" id="responsavel" placeholder="responsável pela entidade">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="cpf do responsável">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email_responsavel" id="email" placeholder="email do responsavel">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="contato_responsavel">Contato</label>
                                <input type="text" class="form-control" name="contato_responsavel" id="contato_responsavel" placeholder="contato do titular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group ml-4">
                            <span>Categoria</span><br>
                            <?php
                            $query =  $conexao->query("SELECT * FROM tb_categoria");
                            $fetch = $query->fetchAll();

                            foreach ($fetch as $categoria) { ?>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="categoria[]" id="" value="<?php echo $categoria[0]; ?>"> <?php echo $categoria[1]; ?>
                                    </label>
                                </div>


                            <?php
                            }

                            ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="rua">Outra Categoria</label>
                                <input type="text" class="form-control" name="outra_categoria" id="rua" aria-describedby="" placeholder="outra categoria">
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
                                <label for="numero">Rua</label>
                                <input type="text" class="form-control" name="rua" id="rua" aria-describedby="helpId" placeholder="rua">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero">Numero de Atendidos</label>
                                <input type="number" class="form-control" name="numero_atendidos" id="numero_atendidos" aria-describedby="helpId" placeholder="atendidos">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Documentação Geral</label>

                            <div class="custom-file">
                                <input accept="application/pdf" id="docIpt" onchange="updateDoc()" type="file" name="documento" class="custom-file-input" id="validatedCustomFile">
                                <label id="docLbl" class="custom-file-label" for="validatedCustomFile">Selecione</label>
                            </div>
                        </div>
                        
                    </div>



                    <div id="resultado">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>


                <button class="btn btn-primary">Cadastrar Entidade</button>
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
        $.getJSON('api/entidade.php?op=index', function(data) {
            console.log(data);
            $.each(data, function(index, value) {
                renderRow(value);
            })
        })
    }

    function renderRow(row) {
        $("#table-body").append(
            '<tr><td>' + row[0] + '</td><td>' + row['nome_entidade'] + '</td><td>' + row['pessoas'] + '</td><td>' + row['cnpj'] + '</td><td>' + row['contato_entidade'] + '</td><td>' + row['email_entidade'] + '</td><td>' + row['nome_responsavel'] + '</td><td>' + row['cpf'] + '</td><td>' + row['contato_responsavel'] + '</td><td>' + row['email_responsavel'] + '</td><td><button class="btn btn-primary text-white btn-block" onclick=abrirUrl("' + row["src_doc"] + '") role="button">Documentos</button></td><td><a name="alterar" id="alterar" class="btn btn-warning btn-block text-white" href="alterarfamilia.php" role="button">Alterar</a></td></tr>');
    }
</script>
<script>
    function abrirUrl(url) {
        let win = window.open(url, '_blank');
        win.focus();
    }

    function submitForm(e) {
        e.preventDefault();

        let data = new FormData(document.forms.namedItem("formentidade"));
        console.log("Storing");
        $.ajax({
                async: true,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                url: "api/entidade.php?op=store",
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
                document.formentidade.reset();





            })
            .fail(function(textStatus, msg) {
                $("#resultado").html(msg);

            });
    }
</script>
</body>

</html>
<!-- end document-->