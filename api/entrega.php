<?php
include '../config/database.php';


if (isset($_GET['op']) && $_GET['op'] == 'familia') {
    $mes = $_GET['mes'];
    //getting the data;

    //DELETANDO TODAS AS ENTREGAS DE FAMILIAS
    $conexao->query("DELETE tb_entrega.* FROM tb_entrega INNER JOIN tb_lancamento ON tb_lancamento.idtb_lancamento = tb_lancamento_idtb_lancamento WHERE tb_familia_idtb_familia IS NOT NULL AND tb_lancamento.tb_mes_lancamento_idtb_mes_lancamento = $mes");


    //PEGANDO O ID DE TODAS FAMILIAS CADASTRADAS
    $query =  $conexao->query("SELECT idtb_familia FROM tb_familia");
    $fetch = $query->fetchAll();

    $ids = [];

    foreach ($fetch as $id) {
        $ids[] = $id[0];
    }

    //COLETAR TODOS OS POSTS COM BASE NOS IDS ATIVOS
    $entregaIndividual = [];
    foreach ($ids as $idAtual) {
        if (isset($_POST["familia$idAtual"])) {
            $entregaIndividual[$idAtual] = $_POST["familia$idAtual"];
        }
    }

    foreach ($entregaIndividual as $idFamilia => $entregaFamilia) {
        foreach ($entregaFamilia as $entregaAtual) {
            $conexao->query("INSERT INTO tb_entrega VALUES(0, $idFamilia,null,null, '$entregaAtual')");
        }
    }

    print_r($_POST);
}

if (isset($_GET['op']) && $_GET['op'] == 'entidade') {
    $mes = $_GET['mes'];
    //getting the data;

    //DELETANDO TODAS AS ENTREGAS DE ENTIDADE
    $conexao->query("DELETE tb_entrega.* FROM tb_entrega INNER JOIN tb_lancamento ON tb_lancamento.idtb_lancamento = tb_lancamento_idtb_lancamento WHERE tb_entidade_idtb_entidade IS NOT NULL AND tb_lancamento.tb_mes_lancamento_idtb_mes_lancamento = $mes");

    //PEGANDO O ID DE TODAS FAMILIAS CADASTRADAS
    $query =  $conexao->query("SELECT idtb_entidade FROM tb_entidade");
    $fetch = $query->fetchAll();

    $ids = [];

    foreach ($fetch as $id) {
        $ids[] = $id[0];
    }

    //COLETAR TODOS OS POSTS COM BASE NOS IDS ATIVOS
    $entregaIndividual = [];
    foreach ($ids as $idAtual) {
        if (isset($_POST["entidade$idAtual"])) {
            foreach($_POST["entidade$idAtual"] as $chave => $valor){
                if($valor != null){
                    $conexao->query("INSERT INTO tb_entrega VALUES(0,null,$idAtual,$valor,$chave)");
                }

            }
        }
    }

    print_r($_POST);
}
