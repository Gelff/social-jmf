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
                    <input type="email" name="emailL" placeholder="exemplo@email.com">
                    <input type="password" name="senhaL" placeholder="********">
                    <input type="submit" name="entrar" value="ENTRAR">
                    <a href="" style="margin-top:5px;"><b>Esqueci minha senha</b></a>
                </form>
                <br>
                <input id="call" class="caao" type="submit" name="criar" value="Criar uma Conta" style="margin-top:20px;">
            </div>
            <section id="cads">

            </section>
            <script>
                call = document.getElementById("call")
                cads = document.getElementById("cads");
                call.addEventListener("click",()=>{
                    cads.style="position:absolute;width:100%;height:100%;left:-10px;top:-10px;"
                    cads.innerHTML=
                    '<div style="position:absolute;width:100%;height:100%;background-color:rgba(0,0,0,0.5)">'+
                        '<form action="" method="post" style="height:300px;padding:0px;">'+
                            '<div style="display:flex;align-items: flex-end;flex-direction: row; justify-content: space-between;">'+
                                '<h2><b style="margin-left:200px; color:black;">Cadastro</b></h2>'+
                                '<button name="fechar" style="border-radius:100%;background-color: red;color:white;width:30px;height:30px;border:0px;"><b>X</b></button>'+
                            '</div>'+
                            '<div>'+
                                '<input maxlength="20" pattern="([aA-zZ]+)" type="text" name="nome" placeholder="Nome">'+
                                '<input maxlength="20" pattern="([aA-zZ]+)" type="text" name="sobrenome" placeholder="Sobrenome">'+
                                '<input type="email" name="email" placeholder="exemplo@email.com">'+
                                '<input type="password" name="senha" placeholder="********">'+
                                '<input class="caao" type="submit" name="cadastrar" value="Cadastrar" style="margin-top:20px;">'+
                            '</div>'+
                        '</form>'+
                    '</div>';
                })
            </script>
        </section>
    </section>
</body>
</html>