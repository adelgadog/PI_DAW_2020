$(document).ready(function () { 

    //////////////////////////////////////////////////////////////////////////
    //
    //  
    //  
    //
    //////////////////////////////////////////////////////////////////////////
    var lista =$(".rango_nota");    
    
    /*document.getElementsByClassName("rango_nota").oninput = function(){
         $("#anuncio").attr('class','oculto');
         $("#modificar").attr('class','modificar');
         document.getElementById("muestra_nota").innerHTML=this.value;
     
     };*/
    lista.each(function(e) {        
        this.oninput = function(){ 
            $("#anuncio_"+this.id).addClass("oculto");
            $("#modificar_"+this.id).removeClass("oculto");
            document.getElementById("muestra_nota_"+this.id).innerHTML=this.value;
            //console.log("Pelicula: "+this.name+"Valor: "+this.value);
        };
    });

    //////////////////////////////////////////////////////////////////////////
    //
    //          FIN DEL ARCHIVO SCRIPTS
    //
    //////////////////////////////////////////////////////////////////////////

});