<?php
    include '../config/database.php';
    if(isset($_GET['op']) && $_GET['op'] == "store"){
        $mes = $_POST['mes'];

        $conexao->query("INSERT INTO tb_mes_lancamento VALUES(0,'$mes')");
        $query = $conexao->query("SELECT * FROM tb_mes_lancamento WHERE data = '$mes'");

        $fetch = $query->fetch();
            

        for($i = 0; $i < count($_POST['dias']); $i++ ){
            $dia = $_POST['dias'][$i];
            $qtd = $_POST['qtds'][$i];

            $conexao->query("INSERT INTO tb_lancamento VALUES(0,$fetch[0],'$dia',$qtd)");
        }
        
        echo "Sucesso";
    }
    if(isset($_GET['op']) && $_GET['op'] == "index"){
        $query = $conexao->query("SELECT * FROM tb_mes_lancamento");
        $fetch = $query->fetchAll();

        header('Content-Type: application/json');
        echo json_encode($fetch);
    }
?>