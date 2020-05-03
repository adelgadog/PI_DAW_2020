$(document).ready(function () { 

    //////////////////////////////////////////////////////////////////////////



    ////////////////////////////////////////////////////////////////////////// 

   $(".b_login").click(function(){  
        if ( $("#correo_L").val()=='' || $("#password_L").val()=='') {
            alert("Responde Bellaco");
        } else {           
            Chequear($("#correo_L").val(), $("#password_L").val(), $('#remember').prop('checked'));            
        }
    });
    
    //////////////////////////////////////////////////////////////////////////



    //////////////////////////////////////////////////////////////////////////

    $("#b_registro").click(function(){  
        if ($("#Pass_R").val().length<8) {
            alert("La contraseña debe ser mayor de 8 caracteres");
        } else {          
            Registrar($("#Usuario_R").val(), $("#Pass_R").val(), $("#Mail_R").val());
        }
    });
    
    //////////////////////////////////////////////////////////////////////////



    //////////////////////////////////////////////////////////////////////////

    $("#salir").click(function(){  
        document.cookie = "usuario_cine=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
        window.location.href="../index.php";
    });
    
    //////////////////////////////////////////////////////////////////////////



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



    //////////////////////////////////////////////////////////////////////////

    function Registrar(User, Pass, Mail){
        $.ajax({
            type: "post",
            url: "../scripts/funciones.php",
            data: {nombre:User,pass:Pass,mail:Mail,funcion:"funcion4"},
            error(xhr,status,error){console.log("nope");
            },
            success: function (jsonStr) {
                let json = JSON.parse(jsonStr);
                console.log(json);
                if (json!=-1) {
                    document.cookie ="usuario_cine="+JSON.stringify(json);
                    window.location.reload(); 
                }                
            }
        }); 
    }

    //////////////////////////////////////////////////////////////////////////


    
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


    
    //////////////////////////////////////////////////////////////////////////

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return -1;
      }

      //////////////////////////////////////////////////////////////////////////
  
  
      
      //////////////////////////////////////////////////////////////////////////



     /* $('.btnNext').click(function(){
          let tabactiva= $('#menuTabs > li').find('.active');
          //alert(tabactiva);
          tabactiva.next('nav-link').addClass('chorra').tab('show');
          //tabactiva.closest("li").find('#tabForm').addClass("active show");
      });
      
        $('.btnPrevious').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
      });/*/


/*
        $('#prevtab').on('click', function() {
            var $tabs = $('#menuTabs li');
            $tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
        });
        $('.btnNext').on('click', function() {
            //alert("hola");
            let $tabs = $('#menuTabs > li > a').filter('.active');
            $tabs.addClass("chorra");
            $tabs.next('li').addClass("chorra");
        });*/

});