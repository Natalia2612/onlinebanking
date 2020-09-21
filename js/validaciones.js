function handleChange()
{
     //document.getElementById("name").value = document.getElementById("dni").value;
     dni=document.getElementById("dni").value;
     pass=document.getElementById("password").value;
     name=document.getElementById("name").value;
     phone=document.getElementById("phone").value;
     activar=document.getElementById("activarButton").value;
     var divCmabiar=document.getElementById('button');
     
    if(dni!="" && pass!="" && name!="" && phone!=""){
            divCmabiar.style.backgroundColor="#123807"; 
            document.getElementById("activarButton").value ="activar"
    }
    else{
        divCmabiar.style.backgroundColor="#c9c9c9";
        document.getElementById("activarButton").value = ""
    }
}
function verificar(){
    dni=document.getElementById("dni").value;
    pass=document.getElementById("password").value;
    var divCmabiar=document.getElementById('button');
    
    if(dni!="" && pass!=""){
        divCmabiar.style.backgroundColor="#123807"; 
    }
    else{
        divCmabiar.style.backgroundColor="#c9c9c9";
    }
}
function activarButton(){
    dni=document.getElementById("dni").value;
    importe=document.getElementById("importe").value;
    
    var divCmabiar=document.getElementById('button');
    
    if(dni!="" && importe!=""){
        divCmabiar.style.backgroundColor="#123807";
    }
    else{
        divCmabiar.style.backgroundColor="#c9c9c9";
    }
}

function mostrar(i){
    document.getElementById(i).style.visibility='visible';
}
function closeModal(i){
    var labelArs=document.getElementById('labelArs');
    var labelUsd=document.getElementById('labelUsd');
    document.getElementById(i).style.visibility='hidden';
    document.getElementById("dni").value="";
    document.getElementById("importe").value="";
    document.getElementById('ars').checked=true;
    labelArs.style.borderColor="#EC0000";
    labelUsd.style.borderColor="#c9c9c9";
    document.getElementById('button').style.backgroundColor="#c9c9c9";
    document.getElementById("message").innerHTML="";
}
function comprobarSeleccionado(){
    var labelArs=document.getElementById('labelArs');
    var labelUsd=document.getElementById('labelUsd');
    if(document.getElementById('ars').checked) {
        labelArs.style.borderColor="#EC0000";
        labelUsd.style.borderColor="#c9c9c9";
        //Male radio button is checked
   }else if(document.getElementById('usd').checked) {
      labelUsd.style.borderColor="#EC0000";
      labelArs.style.borderColor="#c9c9c9";
        //Female radio button is checked
   }
}

function validarForm(form,dniUser,bArg,bUsd){
    dni=document.getElementById("dni").value;
    importe=document.getElementById("importe").value;
    if(dni==""){
        return false;
    }
    if(importe==""){
        return false;
    }
    if(dni==dniUser){
        document.getElementById("message").innerHTML="No podes realizar transferencias a tu propia cuenta..";
        return false;
    }
    if(document.getElementById('ars').checked) {
        if(parseInt(importe)>parseInt(bArg)){
            document.getElementById("message").innerHTML="No posee fondos suficientes para realizar la transacción en arg";
            return false;
        }   
    }
    if(document.getElementById('usd').checked) {
        if(parseInt(importe)>parseInt(bUsd)){
            document.getElementById("message").innerHTML="No posee fondos suficientes para realizar la transacción en usd..";
            return false;
        } 
    }
}