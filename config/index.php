<?php
    include_once("../content/code/sessao.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <link rel="stylesheet" href="../perfil/style.css">
    <link rel="icon" type="image/x-icon" href="/content/img/alunos/<?php echo $pFoto; ?>">
</head>
<body>
    <section class="main">    
        <?php include("../content/pages/caminhos.html"); ?>
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
                include_once("../content/code/editarconta.php");
                include_once("../content/code/deletarconta.php");
            ?>
        </section>
    </section>
    <div id="divconta">
    </div>
    <script src="/content/code/excluirconta.js"></script>
</body>
</html>