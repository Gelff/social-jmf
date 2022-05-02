    <?php
        ob_start();
        session_start();
        include("../content/code/conexao.php");
        if(!isset($_SESSION['email'])&&(!isset($_SESSION['senha']))){
            header("Location: ../");
        }

        $token = $_SESSION['email'];
        $login = "SELECT * FROM contas WHERE email=:token";
        try{
           $get = $conect->prepare($login);
           $get->bindParam(':token',$token,PDO::PARAM_STR);
           $get->execute();
           if($get->rowCount()>0){
               $ac = $get->fetch(PDO::FETCH_OBJ);
               $id = $ac->id;
               $nome = $ac->nome;
           } 
        } catch(PDOException $e){
        }

        $acID = $_GET['conta'];
        $acSelect = "SELECT * FROM contas WHERE id=:acID";
        try{
            $acr = $conect->prepare($acSelect);
            $acr->bindParam(':acID',$acID, PDO::PARAM_INT);
            $acr->execute();
            if($acr->rowCount()>0){
                $acc = $acr->fetch(PDO::FETCH_OBJ);
                $acnome = $acc->nome;
                $acsobrenome = $acc->sobrenome;
                $acemail = $acc->email;
                $acstatus = $acc->status;
                $acverificado = $acc->verificado;

                $pSelect = "SELECT * FROM perfil WHERE id=:pID";
                $pCon = $conect->prepare($pSelect);
                $pCon->bindParam(':pID', $acID, PDO::PARAM_INT);
                $pCon->execute();
                if($pCon->rowCount()>0){
                    $pO = $pCon->fetch(PDO::FETCH_OBJ);
                    $pApelido = $pO->apelido;
                    $pCapa = $pO->capa;
                    $pBio = $pO->biografia;
                    $pTurma = $pO->turma;
                    $pFoto = $pO->foto;
                }
            }
        }catch(PDOException $i){}
        if(empty($acnome)){
            header("Refresh:0, $id");
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../content/style.css">
</head>
<body style="background-color: var(--profile2);">
    <section class="main">    
        <section class="content c2" style="flex-wrap:nowrap !important;">
            <?php include("../content/pages/caminhos.html"); ?>
            <section class="profile">
                <div class="pic">
                    <div class="custom">
                        <div class="cape" style="background-image: url(<?php echo $pCapa; ?>">
                            <div id="icon" class="icon" style="background-image: url(/content/img/alunos/<?php echo $pFoto; ?>">
                                <div class="statuse sta<?php echo $acstatus ?>">

                                </div>
                            </div>
                        </div>
                        <div class="btns">
                            <?php if($acID==$id) { ?>
                            <button><b>Editar perfil</b></button>
                            <?php }else{ ?>
                                <button><b>Adicionar amigo</b></button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="infos">
                        <a><h4><?php echo "$acnome $acsobrenome <button class='verificado verificado$acverificado'><b style='margin-left:18px;'>Verificado</b></button>"; ?></h4></a>
                        <br>
                        <?php if($acID==$id) { ?>
                        <form method="post" class="biografia"><input name="alterbio" type="text" value="<?php echo $pBio; ?>" maxlength="100"></form>
                        <?php }else{ ?>
                            <a style="font-size:15px;margin-top:1px;margin-left:36px;"><?php echo $pBio; ?></a>
                        <?php } ?>
                        <br>
                        <br>
                        <?php 
                            if(isset($_POST['alterbio'])){
                                $alterbio = $_POST["alterbio"];
                                $selectbio = "UPDATE perfil SET biografia=:altb WHERE id=$id;";
                                try{
                                    $resultadobio = $conect->prepare($selectbio);
                                    $resultadobio->bindParam(':altb',$alterbio,PDO::PARAM_STR);
                                    $resultadobio->execute();
                                    header("Refresh:0");
                                }catch(PDOException $e) {
                                }
                            }
                            ?>
                    </div>
                    <div class="publicacoes">
                        <?php if($acID==$id) { ?>
                        <form method="post" class="publik">
                            <input type="text" placeholder="No que você está pensando?" name="textin" maxlength="700">
                            <input type="submit" value=">" name="publik">
                        </form>
                        <?php } ?>
                        <?php
                            
                            if(isset($_POST['publik'])){
                                $textin = $_POST["textin"];
                                if(str_contains("$textin", ' ')){
                                    $select = "INSERT INTO publicacoes(texto,idConta,idPerfil) VALUES(:textin,:idc,:idpe)";
                                    try{
                                        $resultado = $conect->prepare($select);
                                        $resultado->bindParam(':textin',$textin,PDO::PARAM_STR);
                                        $resultado->bindParam(':idc',$id,PDO::PARAM_STR);
                                        $resultado->bindParam(':idpe',$acID,PDO::PARAM_STR);
                                        $resultado->execute();
                                        header("Refresh:0");
                                    } catch (PDOException $e) {
                                    }
                                }else{
                                    echo "<b style='color:red; margin-right:90px;'>Você não pode publicar apenas 1 palavra!</b>";
                                    header("Refresh:2,./$acID");
                                }
                            }
                            
                            $select = "SELECT * FROM publicacoes WHERE idPerfil=$acID ORDER BY id DESC";
                            try{
                                $resultado = $conect->prepare($select);
                                $resultado->execute();
                                if($resultado->rowCount()>0){
                                    while($show = $resultado->FETCH(PDO::FETCH_OBJ)){
                                        $acIDPub = $show->id;
                                        $idContala = $show->idConta;
                                        ?>
                        <div class="pub">
                            <form method="post">
                                <div class="minicon" style="background-image: url(/content/img/alunos/<?php echo $pFoto; ?>"></div>
                                <?php if($acID==$id) { ?>
                                <button name="excluir" class="excluir" value="<?php echo $acIDPub; ?>"></button>
                                <?php } ?>
                                <button class="compartilhar"></button>
                                <button class="responder"></button>
                            </form>
                            <div>
                                <a><b><?php echo $acnome." ".$acsobrenome; ?></b> - <?php echo $show->data ?></a>
                                <a><?php echo $show->texto ?></a>
                            </div>
                        </div>
                        <?php }}}catch(PDOException $e){ echo '<strong>ERRO DE PDO= </strong>'.$e->getMessage();} ?>
                        <?php
                            if(isset($_POST['excluir'])){
                                $exc = $_POST['excluir'];
                                $deletar = "DELETE FROM publicacoes WHERE id=$exc AND idConta=$acID";
                                $deletare = $conect->prepare($deletar);
                                $deletare->execute();
                                header("Refresh:0");
                            }
                            ?>
                    </div>
                </div>
                
            </section>
        </section>
    </section>
    <form method="post" style="position:absolute; right:20px; top:10px; box-shadow:none;"><button name="exit">Sair</button></form>
    <?php
        if(isset($_POST['exit'])){
            $updateStatus = "UPDATE contas SET status=0 WHERE id=:idU";
            try{
                $rU = $conect->prepare($updateStatus);
                $rU->bindParam(':idU',$acID,PDO::PARAM_STR);
                $rU->execute();
                session_destroy();
                header("Refresh:0");
            }catch(PDOException $e){}
        }
        ?>
    <div id="picchange">
    </div>
    <?php if($acID==$id) { ?>
    <script>
        picchange = document.getElementById("picchange")
        icon = document.getElementById("icon")
        icon.addEventListener("click",()=>{
            picchange.innerHTML = 
            '<div style="display:flex; justify-content:center; align-items:center;position:absolute;width:100%;height:100%;background-color:rgba(0,0,0,0.5)">'+
                '<div>'+
                    '<form action="" method="post" enctype="multipart/form-data" style="text-align:center;">'+
                        '<b>Alterar foto do Perfil</b><br>'+
                        '<input type="file" name="foto">'+
                        '<input type="submit" value="Salvar" name="alterfoto">'+
                        '<input type="submit" value="Cancelar" id="cancelfoto" style="background-color:brown;color:white;">'+
                    '</form>'+
                '</div>'+
            '</div>'
        })
    </script>
    <?php } ?>
    <?php 
        if(isset($_POST['alterfoto'])){
            
            $formatP = ["png","jpg","jpeg","JPG","gif"];
            $extensao = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
            
            if(in_array($extensao, $formatP)){
                $pasta = "../content/img/alunos/";
                $temporario = $_FILES['foto']['tmp_name'];
                $novoNome = md5($id.$nome.$token).".jpg";
                $mudarfoto = "UPDATE perfil SET foto=:foto WHERE id=$id";
                try{
                    $resultfoto = $conect->prepare($mudarfoto);
                    $resultfoto->bindParam(':foto',$novoNome,PDO::PARAM_STR);
                    $resultfoto->execute();
                    $upar = move_uploaded_file($temporario, $pasta.$novoNome);
                }catch(PDOException $e){}
                header("Refresh:0");
            }
        }
    ?>
</body>
</html>