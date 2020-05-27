$(document).ready(function () { 

    //////////////////////////////////////////////////////////////////////////
    //
    //  Función de escucha del botón para abrir el modal de Log-In.
    //  Llama a la función Chequear() si todos los campos estan completos.
    //
    ////////////////////////////////////////////////////////////////////////// 

   $(".b_login").click(function(){  
        if ( $("#correo_L").val()=='' || $("#password_L").val()=='') {
            alert("Necesita rellenar todos los campos.");
        } else {           
            Chequear($("#correo_L").val(), $("#password_L").val(), $('#remember').prop('checked'));            
        }
    });
    
    //////////////////////////////////////////////////////////////////////////
    //
    //  Función de escucha del botón para abrir el modal de Registro
    //
    //////////////////////////////////////////////////////////////////////////

    $("#b_registro").click(function(){  
        if ($("#Pass_R").val().length<8) {
            alert("La contraseña debe ser mayor de 8 caracteres.");
        } else if ($("#Pass_R").val()!=$("#Pass_R2").val()){          
            alert("Las contraseñas deben coincidir.");
        } else {
            Chequear_R($("#Usuario_R").val(), $("#Pass_R").val(), $("#Mail_R").val());                   
        }
    });   

    //////////////////////////////////////////////////////////////////////////
    //
    //  
    //  
    //
    //////////////////////////////////////////////////////////////////////////
    
    document.getElementsByClassName("rango_nota").oninput = function(){
        $("#anuncio").attr('class','oculto');
        $("#modificar").attr('class','modificar');
        document.getElementById("muestra_nota").innerHTML=this.value;
    
    };
    
    //////////////////////////////////////////////////////////////////////////
    //
    //  Funcion de Log-In. Uso Ajax para la revisión en PHP sobre la BBDD.
    //  Si el usuario es correcto genera una Cookie para mantener el registro.
    //  Si has elegilo el check Recuerdame, la Cookie se guardara por 1 mes,
    //   en caso contrario 1 hora.
    //
    //////////////////////////////////////////////////////////////////////////

   function Chequear_R(User, Pass, Mail){  
        //alert("vamos");
        $.ajax({
            type: "post",
            url: "../scripts/funciones.php",
            data: {mail:Mail,funcion:"funcion6"},
            error(xhr,status,error){
                console.log("nope_Registro_1");
                alert("fallo");
            },
            success: function (jsonStr) {
                //alert("entra");
                console.log("entra");
                console.log(jsonStr);
                let json = JSON.parse(jsonStr);
                if (jsonStr=="1") {
                    console.log("falso");
                    alert("Ese E-Mail ya esta registrado."); 
                }else{
                    console.log("cierto");
                    Registrar(User, Pass, Mail);   
                }          
            }
        }); 
    }
    //////////////////////////////////////////////////////////////////////////
    //
    //  Funcion de desconexión de usuario. Borra la Cookie guardada regresa a inicio
    //
    //////////////////////////////////////////////////////////////////////////

    $("#salir").click(function(){  
        document.cookie = "usuario_cine=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
        window.location.href="../index.php";
    });
    
    //////////////////////////////////////////////////////////////////////////
    //
    //  Funcion de Log-In. Uso Ajax para la revisión en PHP sobre la BBDD.
    //  Si el usuario es correcto genera una Cookie para mantener el registro.
    //  Si has elegilo el check Recuerdame, la Cookie se guardara por 1 mes,
    //   en caso contrario 1 hora.
    //
    //////////////////////////////////////////////////////////////////////////

    function Chequear(User, Pass, tiempo){
        $.ajax({
            type: "post",
            url: "../scripts/funciones.php",
            data: {mail:User,pass:Pass,funcion:"funcion1"},
            error(xhr,status,error){console.log("nope");
            },
            success: function (jsonStr) {
                let json = JSON.parse(jsonStr);
                //console.log(json);
                if (tiempo) {
                    let d = new Date();
                    d.setTime(d.getTime() + 2592000000);
                    var expira = "; expires="+d.toUTCString();
                } else {
                    let d = new Date();
                    d.setTime(d.getTime() + 3600000);
                    var expira = "; expires="+d.toUTCString();
                }
                if (json!=-1) {
                    document.cookie ="usuario_cine="+JSON.stringify(json)+ expira;                
                }     
                window.location.reload();           
            }
        }); 
    }
    
    //////////////////////////////////////////////////////////////////////////
    //
    //  Función para registrar un nuevo usuario en la BBDD. Se realiza mediante
    //  Ajax.
    //
    //////////////////////////////////////////////////////////////////////////

    function Registrar(User, Pass, Mail){
        $.ajax({
            type: "post",
            url: "../scripts/funciones.php",
            data: {nombre:User,pass:Pass,mail:Mail,funcion:"funcion4"},
            error(xhr,status,error){alert("nope");
            },
            success: function (jsonStr) {
                let d = new Date();
                d.setTime(d.getTime() + 3600000);
                var expira = "; expires="+d.toUTCString();
                let json = JSON.parse(jsonStr);       
                let cookie="usuario_cine="+JSON.stringify(json);
                alert(cookie);
                document.cookie ="usuario_cine="+JSON.stringify(json);
                window.location.reload();
                                
            }
        }); 
    }

    //////////////////////////////////////////////////////////////////////////
    //
    //  Funcion para recibir la lista de todas las peliculas de la BBDD 
    //  mediante Ajax. En la ultima revision decidi no usarla.
    //
    //////////////////////////////////////////////////////////////////////////

    function carga_peliculas(){
        $.ajax({
            type: "post",
            url: "../scripts/funciones.php",
            data: {funcion:"funcion2"},
            error(xhr,status,error){console.log("nope");
            },
            success: function (jsonStr) {
                let json = JSON.parse(jsonStr);
                console.log(json);                    
                document.cookie ="peliculas="+JSON.stringify(json);           
            }
        }); 
    }

    //////////////////////////////////////////////////////////////////////////
    //
    //  Funcion para recibir la lista de todas las proyecciones de la BBDD 
    //  mediante Ajax. En la ultima revision decidi no usarla.
    //
    //////////////////////////////////////////////////////////////////////////
    
    function carga_proyecciones(){
        $.ajax({
            type: "post",
            url: "../scripts/funciones.php",
            data: {funcion:"funcion3"},
            error(xhr,status,error){console.log("nope");
            },
            success: function (jsonStr) {
                let json = JSON.parse(jsonStr);
                //console.log(json);                  
                document.cookie ="proyecciones="+JSON.stringify(json);             
            }
        }); 
    }

    //////////////////////////////////////////////////////////////////////////
    //
    //          FIN DEL ARCHIVO SCRIPTS
    //
    //////////////////////////////////////////////////////////////////////////

});