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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="/content/img/alunos/<?php echo $pFoto; ?>">
</head>
<body>
    <section class="main">    
        <?php include("../content/pages/caminhos.html"); ?>
        <section class="content">
            <section class="infos">
                <div class="cape" id="cape" style="background-image: url(/content/img/capas/<?php echo $pCapa; ?>);"></div>
                <div id="icon" class="icon" style="background-image: url(/content/img/alunos/<?php echo $pFoto; ?>);">
                    <div class="status st<?php echo $acstatus ?>"></div>
                </div>
            </section>
            <section class="profile">
                <div class="namesdiv">
                    <h3 style="margin-left:20px;"><?php echo "$acnome $acsobrenome <button class='verificado$acverificado'></button>"; ?></h3>
                </div>
                <div class="biodiv">
                    <form action="" method="post">
                        
                        <?php if($acID==$id) { ?>
                            <input name="alterbio" type="text" maxlength="50" value="<?php echo $pBio; ?>">
                        <?php }else{ ?>
                            <div style="margin-top:10px;font-size:20px;text-align:center;"><?php echo $pBio; ?></div>
                        <?php } ?>

                        <div class="outras">
                            <b>Turma</b>
                            <select name="turmas" id="turmas">
                                <option value="none" id="none">Nenhuma</option>
                                
                                <option value="inf1" id="inf1">1º Informática</option>
                                <option value="enf1" id="enf1">1º Enfermagem</option>
                                <option value="adm1" id="adm1">1º Administração</option>
                                <option value="con1" id="con1">1º Contabilidade</option>

                                <option value="inf2" id="inf2">2º Informática</option>
                                <option value="enf2" id="enf2">2º Enfermagem</option>
                                <option value="adm2" id="adm2">2º Administração</option>
                                <option value="con2" id="con2">2º Contabilidade</option>

                                <option value="inf3" id="inf3">3º Informática</option>
                                <option value="com3" id="com3">3º Comércio</option>
                                <option value="enf3" id="enf3">3º Enfermagem</option>
                                <option value="sec3" id="sec3">3º Secretaria</option>
                                <option value="adm3" id="adm3">3º Administração</option>
                                <option value="con3" id="con3">3º Contabilidade</option>
                            </select>
                            <script>
                                turma = document.getElementById("<?php echo $pTurma ?>")
                                turma.selected=true
                            </script>
                            <?php if($acID==$id) { ?>
                            <input type="submit" value="Salvar Alterações" name="savealtbio">
                            <?php } ?>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['savealtbio'])){
                            $alterbio = $_POST["alterbio"];
                            $alterturma = $_POST['turmas'];
                            $selectbio = "UPDATE perfil SET biografia=:altb,turma=:alttu WHERE id=$id;";
                            try{
                                $resultadobio = $conect->prepare($selectbio);
                                $resultadobio->bindParam(':altb',$alterbio,PDO::PARAM_STR);
                                $resultadobio->bindParam(':alttu',$alterturma,PDO::PARAM_STR);
                                $resultadobio->execute();
                                header("Refresh:0");
                            }catch(PDOException $e) {
                            }
                        }
                    ?>
                </div>

                <?php if($acID==$id) { ?>
                <form method="post" class="publik" enctype="multipart/form-data">
                    <div style="display:flex;flex-direction:column">
                        <input type="text" placeholder="No que você está pensando?" name="textin" maxlength="500">
                        <input name="fotopub" type="file" style="background-color:transparent;border:0px !important;">
                    </div>
                    <input type="submit" value=">" name="publik" class="publikinput">
                </form>
                <?php } ?>
                <div class="publicacoes">
                    <?php
                        if(isset($_POST['publik'])){

                            $textin = $_POST["textin"];
                            #if(str_contains("$textin", ' ')){
                            if($textin!=""){
                                $select = "INSERT INTO publicacoes(midia,texto,idConta,idPerfil) VALUES(:midia,:textin,:idc,:idpe)";
                                try{
                                    $formatPp = ["png","jpg","jpeg","JPG","gif"];
                                    $extensaop = pathinfo($_FILES['fotopub']['name'],PATHINFO_EXTENSION);
                                    if(in_array($extensaop, $formatPp)){
                                        $pasta = "../content/img/pub/";
                                        $temporario = $_FILES['fotopub']['tmp_name'];
                                        $novoNome = md5($acID.$nome.$token.uniqid()).".jpg";
                                        $uparp = move_uploaded_file($temporario, $pasta.$novoNome);
                                    } if($novoNome==""){$novoNome="nil";}
                                    $resultado = $conect->prepare($select);
                                    $resultado->bindParam(':midia',$novoNome,PDO::PARAM_STR);
                                    $resultado->bindParam(':textin',$textin,PDO::PARAM_STR);
                                    $resultado->bindParam(':idc',$id,PDO::PARAM_STR);
                                    $resultado->bindParam(':idpe',$acID,PDO::PARAM_STR);
                                    $resultado->execute();


                                    header("Refresh:0");
                                }catch(PDOException $e) {
                                }
                            }else{
                                echo "<b style='color:red; width:100%;text-align:center;'>Insira ao menos 1 palavra para publicar!</b>";
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
                        <div class="minicon" style="background-image: url(/content/img/alunos/<?php echo $pFoto; ?>"></div>
                        <div>
                            <div style="display:flex;flex-direction:column;align-items:flex-start;justify-content:center;">
                                <a><b><?php echo $acnome." ".$acsobrenome; ?></b> - <?php echo $show->data; ?></a>
                                <a class="textpub"><?php echo $show->texto; ?></a>
                                <?php if($show->midia!="nil") { ?>
                                    <img style="border-radius:10px;" width="250" src="/content/img/pub/<?php echo $show->midia; ?>">
                                <?php } ?>
                            </div>
                            <form method="post">
                                <div style="display:flex;flex-direction:column;align-items:center;">
                                    <button name="curtir" class="curtir" id="curtir" value="<?php echo $acIDPub; ?>"></button>
                                    <b><?php echo $show->likes ?></b>
                                </div>
                                <button class="responder"></button>
                                <button class="compartilhar"></button>
                                <?php if($acID==$id) { ?>
                                <button name="excluir" class="excluir" value="<?php echo $acIDPub; ?>"></button>
                                <?php } ?>
                            </form>
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
                        if(isset($_POST['curtir'])){
                            $cut = $_POST['curtir'];
                            $inserircurtida = "INSERT INTO curtidas(idPub,idConta) VALUES(:idPub,:idConta)";
                            try{
                                $curtidas = "SELECT * FROM curtidas WHERE idPub=:vidPub AND idConta=:vidConta";
                                $getcurtidas = $conect->prepare($curtidas);
                                $getcurtidas->bindParam(':vidPub',$cut,PDO::PARAM_INT);
                                $getcurtidas->bindParam(':vidConta',$id,PDO::PARAM_INT);
                                $getcurtidas->execute();
                                if($getcurtidas->rowCount()>0){
                                    $removercurtida = "DELETE FROM curtidas WHERE idPub=$cut AND idConta=$id";
                                    $resultcurtir = $conect->prepare($removercurtida);
                                    $resultcurtir->execute();
                                    $curtirr = "UPDATE publicacoes SET likes=likes-1 WHERE id=$cut";
                                    $curtirre = $conect->prepare($curtirr);
                                    $curtirre->execute();
                                }else{
                                    $resultcurtir = $conect->prepare($inserircurtida);
                                    $resultcurtir->bindParam(':idPub',$cut,PDO::PARAM_INT);
                                    $resultcurtir->bindParam(':idConta',$id,PDO::PARAM_INT);
                                    $resultcurtir->execute();
                                    $curtirr = "UPDATE publicacoes SET likes=likes+1 WHERE id=$cut";
                                    $curtirre = $conect->prepare($curtirr);
                                    $curtirre->execute();
                                }
                            }catch(PDOException $e){}
                            header("Refresh:0");
                        }
                        
                    ?>
                </div>
                <div id="picchange">
                </div>
                <?php if($acID==$id) { ?>
                <script>
                    picchange = document.getElementById("picchange")
                    icon = document.getElementById("icon")
                    icon.addEventListener("click",()=>{
                        document.querySelector("body").style="overflow:hidden"
                        picchange.innerHTML = 
                        '<div style="top:0px;display:flex; justify-content:center; align-items:center;position:absolute;width:100%;height:100%;background-color:rgba(0,0,0,0.5)">'+
                            '<div style="background-color:white;padding:10px;border-radius:10px;">'+
                                '<form class="updatepicform" action="" method="post" enctype="multipart/form-data" style="text-align:center;display:flex;flex-direction:column">'+
                                    '<b>Alterar foto do Perfil</b><br>'+
                                    '<input type="file" name="foto">'+
                                    '<input type="submit" value="Salvar" name="alterfoto" style="background-color: green;color:white;">'+
                                    '<input type="submit" value="Cancelar" id="cancelfoto" style="background-color:brown;color:white;">'+
                                '</form>'+
                            '</div>'+
                        '</div>'
                    })
                    cape = document.getElementById("cape")
                    cape.addEventListener("click",()=>{
                        document.querySelector("body").style="overflow:hidden"
                        picchange.innerHTML = 
                        '<div style="top:0px;display:flex; justify-content:center; align-items:center;position:absolute;width:100%;height:100%;background-color:rgba(0,0,0,0.5)">'+
                            '<div style="background-color:white;padding:10px;border-radius:10px;">'+
                                '<form class="updatepicform" action="" method="post" enctype="multipart/form-data" style="text-align:center;display:flex;flex-direction:column">'+
                                    '<b>Alterar a Capa do Perfil</b><br>'+
                                    '<input type="file" name="cape">'+
                                    '<input type="submit" value="Salvar" name="altercape" style="background-color: green;color:white;">'+
                                    '<input type="submit" value="Cancelar" id="cancelcape" style="background-color:brown;color:white;">'+
                                '</form>'+
                            '</div>'+
                        '</div>'
                    })
                </script>
                <?php } ?>
                <?php 
                    $formatP = ["png","jpg","jpeg","JPG"];
                    if(isset($_POST['alterfoto'])){
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
                    if(isset($_POST['altercape'])){
                        $extensao = pathinfo($_FILES['cape']['name'],PATHINFO_EXTENSION);
                        
                        if(in_array($extensao, $formatP)){
                            $pasta = "../content/img/capas/";
                            $temporario = $_FILES['cape']['tmp_name'];
                            $novoNome = md5($id.$nome.$token).".jpg";
                            $mudarcapa = "UPDATE perfil SET capa=:capa WHERE id=$id";
                            try{
                                $resultcapa = $conect->prepare($mudarcapa);
                                $resultcapa->bindParam(':capa',$novoNome,PDO::PARAM_STR);
                                $resultcapa->execute();
                                $uparcapa = move_uploaded_file($temporario, $pasta.$novoNome);
                            }catch(PDOException $e){}
                            header("Refresh:0");
                        }
                    }
                ?>

            </section>
        </section>
    </section>
</body>
</html>
<?php 
    if(empty($acnome)){
        echo "<div style='position:absolute;top:0px;left:0px;width:100%;height:100%;background-color:white;background-image:url(/content/img/loading.gif);background-repeat:no-repeat;background-position:center;background-size:10%;);'></div>";
        header("Refresh:2, $id");
    }
?>