<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title Page-->
    <title>PAA Leite - SGA</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="assets/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="assets/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="assets/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="assets/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- assets CSS-->
    <link href="assets/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="assets/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="assets/wow/animate.css" rel="stylesheet" media="all">
    <link href="assets/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="assets/slick/slick.css" rel="stylesheet" media="all">
    <link href="assets/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="assets/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form name="form" id="form" onsubmit="logar(event)">
                                <div class="form-group">
                                    <label>Usuário</label>
                                    <input class="au-input au-input--full" type="text" name="login"
                                        placeholder="Usuário...">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input class="au-input au-input--full" type="password" name="senha"
                                        placeholder="Senha...">
                                </div>

                                <button id="botao" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">entrar</button>

                            </form>
                            <div class="register-link" id="status">                            
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        function mostrarErro(erro){
            $("#status").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Erro!</strong> '+erro+'</div>');

        }

        function logar(e){
            e.preventDefault();

            let form = $("#form");

            console.log("Logando...");

            $.ajax({
                type:"POST",
                url: "api/login.php?op=login",
                data: form.serialize(),
                beforeSend:function(){
                    $("#botao").html("aguarde...");
                },
                success: function (data) {
                    if(data == "true"){
                        console.log("Shooww");
                        window.location.assign("index.php");
                    }else{
                        mostrarErro(data);
                        document.form.reset();

                    }
                    $("#botao").html("entrar");

                    console.log(data);
                },
                error: function (data) {
                    console.log('Erro de conexão...');
                },
                
            });
        }
    </script>

</body>

</html>
<!-- end document-->