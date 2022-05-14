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