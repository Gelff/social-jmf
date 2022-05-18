<section class="content" style="display:flex;flex-direction:column;justify-content:center;align-items:center;height:100%;background-color:transparent;">
    <form method="post" class="configform">
        <h4 style="margin-top:-20px;margin-bottom:20px;">Alterar Dados da Conta <br>(email requer novo login)</h4>
        <input minlength="3" maxlength="10" pattern="([aA-zZ]+)" name="nome" type="text" placeholder="Nome" value="<?php echo $acnome; ?>">
        <input minlength="3" maxlength="10" pattern="([aA-zZ]+)" name="sobrenome" type="text" placeholder="Sobrenome" value="<?php echo $acsobrenome; ?>">
        <input name="email" type="email" placeholder="Email" value="<?php echo $acemail; ?>">
        <input minlength="8" name="senha" type="password" placeholder="Senha" value="<?php echo base64_decode($acsenha); ?>">
        <input name="alterarconta" type="submit" value="Confirmar" class="submitconta" style="background-color:green;color:white;border:0px;width:110%;cursor:pointer;">
    </form>
    <div class="excluircontadiv">
        <button class="excluirconta" id="excluirconta">Excluir Conta</button>
    </div>
    <?php
        if($token!=$acemail){header("Location:/content/code/sair.php?d=1");}
        if(isset($_POST['alterarconta'])){
            $nome = ucfirst(strtolower($_POST['nome']));
            $sobrenome = ucfirst(strtolower($_POST['sobrenome']));
            $email = $_POST['email'];
            $senha = base64_encode($_POST['senha']);
            $change = "UPDATE contas SET nome=:nome,sobrenome=:sobrenome,email=:email,senha=:senha WHERE id=$id";
            if(!empty($nome)&&!empty($sobrenome)&&!empty($email)&&!empty($senha)){
                try{
                    #$checkregis = "SELECT * FROM contas WHERE email=:emailCheckR";
                    #$resulterR = $conect->prepare($checkregis);
                    #$resulterR->bindParam(':emailCheckR',$email,PDO::PARAM_STR);
                    #$resulterR->execute();
                    #if($resulterR->rowCount()<1){
                        $m = $conect->prepare($change);
                        $m->bindParam(':nome',$nome,PDO::PARAM_STR);
                        $m->bindParam(':sobrenome',$sobrenome,PDO::PARAM_STR);
                        $m->bindParam(':email',$email,PDO::PARAM_STR);
                        $m->bindParam(':senha',$senha,PDO::PARAM_STR);
                        $m->execute();
                    #}
                }catch(PDOException $e){}
            }
            header("Refresh:0");
        }
        if(isset($_POST['deletarcc'])){
            $confirmarsenha = base64_encode($_POST['confirmarsenha']);
            if($confirmarsenha==$acsenha){
                try{
                    $deletea = "DELETE FROM contas WHERE id=$id";
                    $del = $conect->prepare($deletea);
                    $del->execute();
                    $deletea2 = "DELETE FROM perfil WHERE id=$id";
                    $del2 = $conect->prepare($deletea2);
                    $del2->execute();
                    $deletea3 = "DELETE FROM amigos WHERE pessoa1=$id OR pessoa2=$id";
                    $del3 = $conect->prepare($deletea3);
                    $del3->execute();
                    $deletea4 = "DELETE FROM curtidas WHERE idConta=$id";
                    $del4 = $conect->prepare($deletea4);
                    $del4->execute();
                    $deletea5 = "DELETE FROM publicacoes WHERE idConta=$id";
                    $del5 = $conect->prepare($deletea5);
                    $del5->execute();
                    $deletea6 = "DELETE FROM comentarios WHERE idConta=$id";
                    $del6 = $conect->prepare($deletea6);
                    $del6->execute();
    
                    header("Location: /content/code/sair.php?d=1");
                }catch(PDOException $e){}
            }else{
                echo "<b style='color:red;'>Senha Incorreta!</b>";
            }
            header("Refresh:2");
        }
    ?>
</section>