<?php
    include '../config/database.php';
    session_start();

    if(isset($_GET['op']) && $_GET['op']=='login'){
        
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $query = $conexao->query("SELECT idtb_usuario,nome,login FROM tb_usuario WHERE login = '$login' AND senha = '$senha'");

        $fetch = $query->fetch();
        if(!is_array($fetch)){
            echo "Usuário ou Senha incorretos";
        }else{
            $_SESSION['nome'] = $fetch[1];
            $_SESSION['login'] = $fetch[2];
            $_SESSION['id'] = $fetch[0];

            echo "true";
        }
    }

    if(isset($_GET['op']) && $_GET['op'] == "logout"){
        unset($_SESSION['nome']);
        unset($_SESSION['login']);
        unset($_SESSION['id']);

        header("location:../login.php?op=logout");


    }

?>