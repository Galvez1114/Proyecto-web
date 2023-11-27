function prueba(){
    //Obtiene valor introducido en el Captcha
    var code=document.getElementById("id_codigo_captcha").value;

    //Verifica si el valor del Captcha es vacio
    if(code==""){
        alert("Introduzca el codigo CAPTCHA");
    }else{
        //Obtiene los datos del formulario
        var mi_form=document.getElementById("captch_form");

        //Valida el formulario
        if (mi_form.checkValidity()){
            //Obtiene los datos del formulario
            var datos_form=new FormData(mi_form);
          
            // Crea el objeto XMLHttpRequest
            if (window.XMLHttpRequest) {
                // Codigo para  IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } 
            else { 
                    // Codigo para IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            // Funcion que obtiene el resultado del archivo php
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {   //4= Completado 200=Exitoso
                    // Modificar la pagina indicando donde
                    x = this.responseText;
                    alert(x);
                }
            }
                
            // Abre la conexion
            xmlhttp.open("POST", "registro_cliente.php", true);
               
            // Envia los datos del frmulario
            xmlhttp.send(datos_form);
        }
    }
}

function sesion(){
    if (window.XMLHttpRequest) {
        // Codigo para  IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } 
    else { 
            // Codigo para IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }        
    // Abre la conexion
    xmlhttp.open("POST", "inicio.php", true);

}