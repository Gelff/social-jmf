<?php
    $url = $_SERVER['REQUEST_URI'];
    echo $url;
    ob_start();
    session_start();
    if(isset($_SESSION['email'])&&(isset($_SESSION['senha']))){
        header("Location: /perfil");
    }
    include("content/code/conexao.php");
    include("content/code/erro.php");
    include("content/code/login.php");
    include("content/code/cadastro.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Network JMF</title>
    <link rel="stylesheet" href="content/style.css">
</head>
<body style="overflow-x:hidden;overflow-y:visible;">
    <section class="main">
        <section class="content">
            <div>
                <img src="content/img/svg/logoariana.svg" width="300" height="300">
                <p>Olá! A Social Network JMF é uma plataforma digital para o uso escolar dos estudantes de EEEP<br>Como um meio de noticias, conteúdos e lazer!</p>
            </div>
            <div style="background-color: white; border-radius:30px;display:flex;justify-content:center;">
                <form action="" method="post" style="height:190px;">
                    <h2><b style="color:black;">Login</b></h2>
                    <input type="email" name="emailL" placeholder="exemplo@email.com" style="margin-top:20px;">
                    <input type="password" name="senhaL" placeholder="********">
                    <input type="submit" name="entrar" value="ENTRAR" class="botaoentrar" style="width:100%;background-color:black;color:white;">
                    <!--<a href="" style="margin-top:5px;"><b>Esqueci minha senha</b></a>-->
                </form>
                <br>
                <input id="call" class="caao" type="submit" name="criar" value="Criar uma Conta" style="margin-top:20px;cursor:pointer;">
            </div>
            <section id="cads">

            </section>
            <script src="/content/code/cadastro.js"></script>
        </section>
    </section>
</body>
</html>