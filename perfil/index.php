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
</head>
<body>
    <section class="main">    
        <?php include("../content/pages/caminhos.html"); ?>
        <section class="content">
            <section class="infos">
                <div class="cape">
                    <div id="icon" class="icon" style="background-image: url(/content/img/alunos/<?php echo $pFoto; ?>">
                        <div class="status st<?php echo $acstatus ?>"></div>
                    </div>
                </div>
            </section>
            <section class="profile">
                <div class="namesdiv">
                    <h3 style="margin-left:20px;"><?php echo "$acnome $acsobrenome <button class='verificado$acverificado'></button>"; ?></h3>
                </div>
                <div class="biodiv">
                    <form action="" method="post">
                        <?php if($acID==$id) { ?>
                            <input name="alterbio" type="text" value="<?php echo $pBio; ?>">
                        <?php }else{ ?>
                            <div style="margin-top:10px;font-size:20px;text-align:center;"><?php echo $pBio; ?></div>
                        <?php } ?>
                    </form>
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
                        <input type="text" placeholder="No que você está pensando?" name="textin" maxlength="26">
                        <input type="submit" value=">" name="publik">
                    </form>
                    <?php }else{ ?>
                        <b>Atualizações de <?php echo $acnome ?></b>
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
                                }catch(PDOException $e) {
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
                        <div class="minicon" style="background-image: url(/content/img/alunos/<?php echo $pFoto; ?>"></div>
                        <div>
                            <div style="display:flex;flex-direction:column;align-items:flex-start;justify-content:center;">
                                <a><b><?php echo $acnome." ".$acsobrenome; ?></b> - <?php echo $show->data; ?></a>
                                <a class="textpub"><?php echo $show->texto; ?></a>
                            </div>
                            <form method="post">
                                <div style="display:flex;flex-direction:column;align-items:center;">
                                    <button name="curtir" class="curtir" id="curtir" value="<?php echo $acIDPub; ?>"></button>
                                    <b>0</b>
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