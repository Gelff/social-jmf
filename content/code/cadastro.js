call = document.getElementById("call")
cads = document.getElementById("cads");
call.addEventListener("click",()=>{
    cads.style="position:absolute;width:100%;height:110%;left:-10px;top:-50px;"
    cads.innerHTML=
    '<div style="position:absolute;width:100%;height:100%;background-color:rgba(0,0,0,0.5)">'+
        '<form action="" method="post" style="width:400px;height:350px;padding:0px;display:flex;flex-direction:column;justify-content:center;align-items:center;">'+
            '<div style="display:flex;align-items: flex-end;flex-direction: row; justify-content: space-between;">'+
                '<h2><b style="margin-left:200px; color:black;">Cadastro</b></h2>'+
                '<button name="fechar" style="border-radius:100%;background-color: red;color:white;width:30px;height:30px;border:0px;margin-right:53px;margin-bottom:30px;"><b>X</b></button>'+
            '</div>'+
            '<div>'+
                '<input minlength="3" maxlength="10" pattern="([aA-zZ]+)" type="text" name="nome" placeholder="Nome">'+
                '<input minlength="3" maxlength="10" pattern="([aA-zZ]+)" type="text" name="sobrenome" placeholder="Sobrenome">'+
                '<input type="email" name="email" placeholder="exemplo@email.com">'+
                '<input minlength="8" type="password" name="senha" placeholder="********">'+
                '<select name="genero" style="width:58%;height:30px;border:0px;margin-bottom:10px;"'+
                    '<option value="a"></option>'+
                    '<option value="m">Feminino</option>'+
                    '<option value="h">Masculino</option>'+
                    '<option value="o">Outros</option>'+
                '</select>'+
                '<input class="caao" type="submit" name="cadastrar" value="Cadastrar" style="margin-top:0px;background-color:orange;color:black;cursor:pointer;margin-bottom:20px;">'+
            '</div>'+
        '</form>'+
    '</div>';
})