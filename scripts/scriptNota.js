  
    //////////////////////////////////////////////////////////////////////////
    //
    //   ¡¡¡ SCRIPT START !!!
    //
    //////////////////////////////////////////////////////////////////////////

$(document).ready(function () { 

    //////////////////////////////////////////////////////////////////////////
    //
    //  Recupero todos los elementos clase rango_nota, y los almaceno en un array.
    //  Estoselementos son las representaciones de las peliculas sobre las 
    //  que el usuario puede realizar una valoracion.
    //
    //////////////////////////////////////////////////////////////////////////

    var lista =$(".rango_nota");    
    
    //////////////////////////////////////////////////////////////////////////
    //
    //  Recorro el array de elementos ranto_nota y lanzo un evento de escucha
    //  al elemento input para que se este es modificado, la nota que se elija
    //  aparezca en tiempo real en el cajon asignado para tal efecto.
    //
    //////////////////////////////////////////////////////////////////////////

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
    //   ¡¡¡ SCRIPT END !!!
    //
    //////////////////////////////////////////////////////////////////////////

});