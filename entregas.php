<?php
include 'config/database.php';
include 'includes/nav.php';
?>
<!-- MAIN CONTENT-->

<style>
    input[type=checkbox] {
        display: none;
    }

    input[type=text] {
        background: transparent;
    }

    input[type=checkbox]+label {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 25px;
        width: 25px;
        display: inline-block;
    }

    input[type=checkbox]+label {
        background-image: url('images/smalltimes.png');
    }

    input[type=checkbox]:checked+label {
        background-image: url('images/smallcheck.png');
    }
</style>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-md-6">
                    <h2 class="title-1">Entregas</h2>
                </div>
                <div class="col-md-6">
                    <?php
                    $id = $_GET['id'];


                    $query = $conexao->query("SELECT * FROM tb_mes_lancamento WHERE idtb_mes_lancamento = $id");
                    $mes = $query->fetch();


                    ?>

                    <h2 class="title-1"><?php echo $mes['data']; ?></h2>




                    <!-- FIMMODAL -->
                </div>
            </div>
            <div id="resultado">

            </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active text-dark" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Famílias</a>
                    <a class="nav-item nav-link text-dark" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Entidades</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?php
                    $query =  $conexao->query("SELECT * FROM tb_lancamento WHERE tb_mes_lancamento_idtb_mes_lancamento = $id ORDER BY dia ASC");

                    $lancamentos = $query->fetchAll();




                    ?>
                    <form name="formfamilia" onsubmit="submitFormFamilia(event)">

                        <table class="table table-striped table-inverse" id="table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Família</th>
                                    <?php
                                    foreach ($lancamentos as $lancamento) { ?>

                                        <th> <?php echo $lancamento['dia']; ?> </th>

                                    <?php  }
                                    ?>
                                    <th>Total</th>


                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <?php
                                $query = $conexao->query("SELECT idtb_familia, nome FROM tb_familia ORDER BY nome ASC");
                                $familias = $query->fetchAll();
                                foreach ($familias as $familia) { ?>
                                    <tr>
                                        <td><?php echo $familia['nome']; ?></td>
                                        <?php
                                            $id_familia = $familia['idtb_familia'];
                                            foreach ($lancamentos as $lancamento) {
                                                $id_lancamento = $lancamento['idtb_lancamento'];
                                                $query =  $conexao->query("SELECT * FROM tb_entrega WHERE tb_familia_idtb_familia = $id_familia AND tb_lancamento_idtb_lancamento = $id_lancamento");
                                                $entrega = $query->fetch();

                                                if ($entrega != null) { ?>

                                                <td>
                                                    <input value='<?php echo $id_lancamento; ?>' type='checkbox' checked name='familia<?php echo $id_familia; ?>[]' id="<?php echo $id_familia . "-" . $id_lancamento; ?>" />
                                                    <label for="<?php echo $id_familia . "-" . $id_lancamento; ?>"></label>
                                                </td>

                                            <?php
                                                    } else {
                                                        ?>

                                                <td>
                                                    <input value='<?php echo $id_lancamento; ?>' type='checkbox' name='familia<?php echo $id_familia; ?>[]' id="<?php echo $id_familia . "-" . $id_lancamento; ?>" />
                                                    <label for="<?php echo $id_familia . "-" . $id_lancamento; ?>"></label>
                                                </td>

                                            <?php

                                                    }
                                                    ?>



                                        <?php  }
                                            ?>


                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <br>

                        <button type="submit" class="btn btn-primary" style="float:right">Salvar</button>
                    </form>

                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <form name="formentidade" onsubmit="submitFormEntidade(event)">

                        <table class="table table-striped table-inverse" id="table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Entidade</th>
                                    <?php
                                    foreach ($lancamentos as $lancamento) { ?>

                                        <th> <?php echo $lancamento['dia']; ?> </th>

                                    <?php  }
                                    ?>
                                    <th>Total</th>


                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <?php
                                $query = $conexao->query("SELECT idtb_entidade, nome_entidade FROM tb_entidade ORDER BY nome_entidade ASC");
                                $entidades = $query->fetchAll();
                                foreach ($entidades as $entidade) { ?>
                                    <tr>
                                        <td><?php echo $entidade['nome_entidade']; ?></td>
                                        <?php
                                            $id_entidade = $entidade['idtb_entidade'];
                                            foreach ($lancamentos as $lancamento) {
                                                $id_lancamento = $lancamento['idtb_lancamento'];
                                                $query =  $conexao->query("SELECT * FROM tb_entrega WHERE tb_entidade_idtb_entidade = $id_entidade AND tb_lancamento_idtb_lancamento = $id_lancamento");
                                                $entrega = $query->fetch();

                                                if ($entrega != null) { ?>

                                                <td>
                                                    <input size="5" value='<?php echo $entrega['quantidade_entidade']; ?>' type='text' name='entidade<?php echo $id_entidade; ?>[<?php echo $id_lancamento; ?>]' id="<?php echo $id_entidade . "-" . $id_lancamento; ?>" />
                                                </td>

                                            <?php
                                                    } else {
                                                        ?>

                                                <td>
                                                    <input size="5" type='text' name='entidade<?php echo $id_entidade; ?>[<?php echo $id_lancamento; ?>]' id="<?php echo $id_entidade . "-" . $id_lancamento; ?>" />
                                                </td>

                                            <?php

                                                    }
                                                    ?>


                                        <?php  }
                                            ?>


                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <br>

                        <button type="submit" class="btn btn-primary" style="float:right">Salvar</button>
                    </form>

                </div>
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
    function getTotalEntidade(column = 1) {
        let result = 0;

        let columns = $("#products-table tr td:nth-child(" + column + ")");
        columns.each(i => {
            result += parseInt($(columns[i]).html());
        });

        return result;
    }

    console.log(getTotalEntidade(2));
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

</script>
<script>
    function abrirUrl(url) {
        let win = window.open(url, '_blank');
        win.focus();
    }

    function submitFormFamilia(e) {
        e.preventDefault();

        console.log("Saving");

        let data = new FormData(document.forms.namedItem("formfamilia"));
        console.log("Storing");
        $.ajax({
                async: true,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                url: "api/entrega.php?op=familia&mes=<?php echo $_GET['id']; ?>",
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
                $("#resultado").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Sucesso! </strong> Entrega realizada com êxito </div>');






            })
            .fail(function(textStatus, msg) {
                $("#resultado").html(msg);

            });
    }

    function submitFormEntidade(e) {
        e.preventDefault();

        console.log("Saving");

        let data = new FormData(document.forms.namedItem("formentidade"));
        console.log("Storing");
        $.ajax({
                async: true,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                url: "api/entrega.php?op=entidade&mes=<?php echo $_GET['id']; ?>",
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
                $("#resultado").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Sucesso! </strong> Entrega realizada com êxito </div>');






            })
            .fail(function(textStatus, msg) {
                $("#resultado").html(msg);

            });
    }
</script>
</body>

</html>
<!-- end document-->