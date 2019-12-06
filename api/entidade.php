<?php
    include '../config/database.php';


    if(isset($_GET['op']) && $_GET['op'] == 'store'){
        //getting the data;
        
        $nome = $_POST['nome'];
        $ponto = $_POST['ponto'];
        $cnpj = $_POST['cnpj'];
        $telefone = $_POST['telefone'];
        $email_entidade = $_POST['email_entidade'];
        $responsavel = $_POST['responsavel'];
        $cpf = $_POST['cpf'];
        $email_responsavel = $_POST['email_responsavel'];
        $contato_responsavel = $_POST['contato_responsavel'];
        $outra_categoria = $_POST['outra_categoria'];
        $bairro = $_POST['bairro'];
        $numero = $_POST['numero'];
        $rua = $_POST['rua'];
        $numero_atendidos = $_POST['numero_atendidos'];


        $documento_nome = null;


        if(is_uploaded_file($_FILES['documento']['tmp_name'])){
            $documento_nome = bin2hex(random_bytes(30));
            $src_upload = "uploads/documentos/".$documento_nome.".pdf";
            $documento_nome = "api/".$src_upload;
            if(move_uploaded_file($_FILES['documento']['tmp_name'],$src_upload)){
                echo "OK";
            }
        }

        
    


        $conexao->query("INSERT INTO tb_entidade VALUES(0,$ponto,'$nome','$cnpj','$responsavel','$cpf','$contato_responsavel','$email_responsavel','$rua','$bairro','$numero','$telefone','$email_entidade','$outra_categoria','$numero_atendidos','$documento_nome')");
        print_r($_FILES);
        print_r($_POST);

    }

    if(isset($_GET['op']) && $_GET['op'] == 'index'){
    
        $query = $conexao->query("SELECT tb_entidade.*, tb_localidade.nome as ponto FROM tb_entidade INNER JOIN tb_localidade ON tb_localidade.idtb_localidade = tb_localidade_idtb_localidade");
        $fetch = $query->fetchAll();
        header("Content-Type: application/json");
        echo json_encode($fetch);
    
    }
