<?php 
    ob_start();
    session_start();
    if(isset($_SESSION['email'])&&(isset($_SESSION['senha']))){
        header("Location: /perfil");
    }
    include_once("content/code/conexao.php");
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
                <img src="content/img/svg/logo.svg" width="200" height="200">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit iure error vero, illo commodi, quidem excepturi ad sed reprehenderit ullam ut. Adipisci accusantium aut id laudantium accusamus? Quis, facere rerum?</p>
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
                                '<input type="text" name="nome" placeholder="Nome" pattern="([aA-zZ]+)">'+
                                '<input type="text" name="sobrenome" placeholder="Sobrenome" pattern="([aA-zZ]+)">'+
                                '<input type="email" name="email" placeholder="exemplo@email.com">'+
                                '<input type="password" name="senha" placeholder="********">'+
                                '<input class="caao" type="submit" name="cadastrar" value="Cadastrar" style="margin-top:20px;">'+
                            '</div>'+
                        '</form>'+
                    '</div>';
                })
            </script>
            <?php
                function errorMes($chose){
                    $alarm = ["red","orangered","green"];
                    $pack = ["Preencha Todos os Campo!","Usuário Inválido.","Cadastrado Com Sucesso!"];
                    echo "<div style='position:absolute;top:-10px;width:100%;height:50px;background-color:".$alarm[$chose].";'><b>".$pack[$chose]."</b></div>";
                    header("Refresh:2");
                }
                if(isset($_POST['entrar'])){
                    $emailL = $_POST['emailL'];
                    $senhaL = base64_encode($_POST['senhaL']);
                    $select = "SELECT * FROM contas WHERE email=:emailL2 AND senha=:senhaL2";
                    try{
                        $rL = $conect->prepare($select);
                        $rL->bindParam(':emailL2',$emailL,PDO::PARAM_STR);
                        $rL->bindParam(':senhaL2',$senhaL,PDO::PARAM_STR);
                        $rL->execute();
                        if($rL->rowCount()>0){
                            $emailL = $_POST['emailL'];
                            $senhaL = $_POST['senhaL'];

                            $_SESSION['email'] = $emailL;
                            $_SESSION['senha'] = $senhaL;

                            $updateStatus = "UPDATE contas SET status=1 WHERE email=:emailLe";
                            $rU = $conect->prepare($updateStatus);
                            $rU->bindParam(':emailLe',$emailL,PDO::PARAM_STR);
                            $rU->execute();
                           

                            header('Refresh: 0, /perfil/');
                        }else{
                            errorMes(1);
                        }
                    }catch(PDOException $e){}
                }

                if(isset($_POST['cadastrar'])){
                    $nome = $_POST['nome'];
                    $sobrenome = $_POST['sobrenome'];
                    $email = $_POST['email'];
                    $senha = base64_encode($_POST['senha']);
                    $dara = date(DATE_RFC822);
                    $verificado = 0;
                    $status = 0;
                    if(!empty($nome)&&!empty($sobrenome)&&!empty($email)&&!empty($senha)){
                        errorMes(2);
                        try{
                            $cadastro = "INSERT INTO contas (nome, sobrenome, email, senha, verificado, status, criacao) VALUES (:nome, :sobrenome, :email, :senha, :verificado, :status, :criacao)";
                            $result = $conect->prepare($cadastro);
                            $result->bindParam(':nome',$nome,PDO::PARAM_STR);
                            $result->bindParam(':sobrenome',$sobrenome,PDO::PARAM_STR);
                            $result->bindParam(':email',$email,PDO::PARAM_STR);
                            $result->bindParam(':senha',$senha,PDO::PARAM_STR);
                            $result->bindParam(':verificado',$verificado,PDO::PARAM_STR);
                            $result->bindParam(':status',$status,PDO::PARAM_STR);
                            $result->bindParam(':criacao',$dara,PDO::PARAM_STR);
                            $result->execute();
                            
                            $checklogin = "SELECT * FROM contas WHERE email=:emailCheck";
                            $resulter = $conect->prepare($checklogin);
                            $resulter->bindParam(':emailCheck',$email,PDO::PARAM_STR);
                            $resulter->execute();
                            if($resulter->rowCount()>0){
                                $apelido = "";
                                $capa = "/content/img/capas/capa.png";
                                $biografia = "";
                                $turma = "Turma";
                                $foto = "nil.png";
                                $rc = $resulter->fetch(PDO::FETCH_OBJ);
                                $idCheck = $rc->id;
                                $perfil = "INSERT INTO perfil(id,apelido,capa,biografia,turma,foto) VALUES(:idp,:apelido,:capa,:biografia,:turma,:foto)";
                                $perfilresult = $conect->prepare($perfil);
                                $perfilresult->bindParam(':idp',$idCheck,PDO::PARAM_STR);
                                $perfilresult->bindParam(':apelido',$apelido,PDO::PARAM_STR);
                                $perfilresult->bindParam(':capa',$capa,PDO::PARAM_STR);
                                $perfilresult->bindParam(':biografia',$biografia,PDO::PARAM_STR);
                                $perfilresult->bindParam(':turma',$turma,PDO::PARAM_STR);
                                $perfilresult->bindParam(':foto',$foto,PDO::PARAM_STR);
                                $perfilresult->execute();
                            }

                        }catch(PDOException $e){
                            echo "<strong>ERRO DE CADASTRO PDO = </strong>".$e->getMessage();
                        }
                    }else{
                        errorMes(0);
                    }
                }
            ?>
        </section>
    </section>
</body>
</html>