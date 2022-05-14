<?php
    include_once("../content/code/sessao.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigos</title>
    <link rel="stylesheet" href="../perfil/style.css">
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
                        
                        <?php if($acID!=$id) { ?>
                            <input name="alterbio" type="text" maxlength="50" value="<?php echo $pBio; ?>">
                        <?php }else{ ?>
                            <div style="margin-top:4px;margin-left:-14px;font-size:20px;text-align:center;"><?php echo $pBio; ?></div>
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
                            <?php if($acID!=$id) { ?>
                            <input type="submit" value="Salvar Alterações" name="savealtbio">
                            <?php } ?>
                        </div>
                    </form>
                </div>
                <?php include_once("../content/code/amigos.php"); ?>
            </section>
        </section>
    </section>
</body>
</html>