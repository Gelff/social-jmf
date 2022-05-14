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
    if($ac->status==0){header("Refresh:0,/content/code/sair.php?d=1");}
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
<body style="background-color:var(--theme1)">
    <section class="main">    
        <?php include("../content/pages/caminhos.html"); ?>
        <section class="content">
            <section class="infos">
                <div class="cape" id="cape" style="background-image: url(/content/img/capas/<?php echo $pCapa; ?>);"></div>
                <div id="icon" class="icon" style="background-image: url(/content/img/alunos/<?php echo $pFoto; ?>);">
                    <div class="status st<?php echo $acstatus ?>"></div>
                </div>
            </section>
            <?php if($id!=$acID){ ?>
            <form method="post"><button name="addfriend" class="btnaddamigo">Adicionar</button></form>
            <?php } include_once("../content/code/adicionaramigo.php"); ?>
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
                    <?php include_once("../content/code/alterarbiografia.php"); ?>
                </div>

                <?php if($acID==$id) { ?>
                <form method="post" class="publik" enctype="multipart/form-data">
                    <div style="display:flex;flex-direction:column">
                        <input type="text" placeholder="No que você está pensando?" name="textin" maxlength="500">
                        <input name="fotopub" type="file" style="background-color:transparent;border:0px !important;">
                    </div>
                    <input type="submit" value=">" name="publik" class="publikinput">
                </form>
                <?php } include_once("../content/code/publicacoes.php"); ?>
                <div id="picchange">
                </div>
                <?php if($acID==$id) { ?>
                <script src="../content/code/imagem.js">
                    
                </script>
                <?php } include_once("../content/code/imagem.php"); ?>

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