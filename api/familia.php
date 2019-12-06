<?php
    include '../config/database.php';


    if(isset($_GET['op']) && $_GET['op'] == 'store'){
        //getting the data;
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $ponto = $_POST['ponto'];
        $data_nascimento = $_POST['data_nascimento'];
        $rg = $_POST['rg'];
        $orgao_expedidor = $_POST['orgao_expedidor'];
        $nis = $_POST['nis'];
        $contato = $_POST['contato'];
        $nome_pai = $_POST['nome_pai'];
        $nome_mae = $_POST['rg'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $numero = $_POST['numero'];
        $estado_civil = $_POST['estado_civil'];
        $mais_infancia = $_POST['mais_infancia'];
        if($mais_infancia == ""){
            $mais_infancia = null;
        }
        $documento_nome = null;
        $declaracao_nome = null;


        if(is_uploaded_file($_FILES['documento']['tmp_name'])){
            $documento_nome = bin2hex(random_bytes(30));
            $src_upload = "uploads/documentos/".$documento_nome.".pdf";
            $documento_nome = "api/".$src_upload;
            if(move_uploaded_file($_FILES['documento']['tmp_name'],$src_upload)){
                echo "OK";
            }
        }

        if(is_uploaded_file($_FILES['declaracao']['tmp_name'])){
            $declaracao_nome = bin2hex(random_bytes(30));
            $src_upload = "uploads/declaracoes/".$declaracao_nome.".pdf";
            $declaracao_nome = "api/".$src_upload;

            if(move_uploaded_file($_FILES['declaracao']['tmp_name'],$src_upload)){
                echo "OK";
            }


        }
    
        print_r($_POST);
        if($conexao->query("INSERT INTO tb_familia VALUES(0,$ponto,'$nome','$cpf','$data_nascimento','$rg','$orgao_expedidor','$nis','$nome_pai','$nome_mae','$contato','$rua','$bairro','$numero','$mais_infancia','$estado_civil','$documento_nome','$declaracao_nome')")){
            echo "Sucesso";
        }else{
            echo "Erro";
        }
        
         

    }

    if(isset($_GET['op']) && $_GET['op'] == 'index'){
        $query = $conexao->query("SELECT tb_familia.*, tb_ponto.nome as ponto FROM tb_familia INNER JOIN tb_ponto ON tb_ponto.idtb_ponto = tb_ponto_idtb_ponto");
        $fetch = $query->fetchAll();
        header("Content-Type: application/json");
        echo json_encode($fetch);
    }
