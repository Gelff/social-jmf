div = document.getElementById("divconta")
excluir = document.getElementById("excluirconta")
excluir.addEventListener("click",()=>{
    document.querySelector("body").style="overflow:hidden"
    div.innerHTML=
    "<h1 style='color:red;'>CUIDADO!</h1>"+
    "<b style='text-align:center;'>Ao deletar sua conta, não poderá recuperá-la. Deseja continuar?</b>"+
    "<form method='post'><input type='submit' value='Não'><input name='confirmarsenha' type='password' placeholder='Digite sua senha:'><input type='submit' name='deletarcc' value='Confirmar'></form>"
    div.style="width:100%;height:100%;"
})