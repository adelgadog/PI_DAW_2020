$(document).ready(function() {      

    //////////////////////////////////////////////////////////////////////////

    // Este es un SCRIPT dedicado exclusivamente a la pagina de venta de entradas.

    //////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////

    // Funcion para impedir que los enlaces del menu para comprar una entrada
    // responda. Forzando a usar los botones inferiores.

    //////////////////////////////////////////////////////////////////////////

    $(".enlaces_tab").click(function (e) {
        e.preventDefault();
    });

    //////////////////////////////////////////////////////////////////////////

    // Funciones Ajax para obtener la informacion de la BBDD de peliculas y
    // proyecciones.

    //////////////////////////////////////////////////////////////////////////

    $.ajax({
        type: "post",
        url: "../scripts/funciones.php",
        data: {funcion:"funcion2"},
        error(xhr,status,error){console.log("nope");
        },
        success: function (data) {     
            let pelis = JSON.parse(data);  
            $.ajax({
                type: "post",
                url: "../scripts/funciones.php",
                data: {funcion:"funcion3"},
                error(xhr,status,error){console.log("nope");
                },
                success: function (data) {
                    let proyecciones = JSON.parse(data);  
                    muestra(pelis, proyecciones);
                }});     
        }});   

    //////////////////////////////////////////////////////////////////////////

    // Esta funcion se llama desde el success del Ajax para poder recibir 
    // los arrays de datos y es desde la que se creara la mayor parte del 
    // DOM para la compra de entradas. 

    //////////////////////////////////////////////////////////////////////////

    function muestra(pelis, proyec){          
        var peliculas =pelis;       
        var proyecciones =proyec;
        muestra_Proyeccion();

    //////////////////////////////////////////////////////////////////////////

    //  En esta función se despliega el DOM de la pestaña donde se muestran
    // las peliculas en exposición para la venta de entradas.

    //////////////////////////////////////////////////////////////////////////

        function muestra_Proyeccion(){

            peliculas.forEach(peli => {
                let elementoLista = $("<option>");
                elementoLista.attr("value", peli.id);
                elementoLista.attr("class", "opcionPelicula");
                elementoLista.text(peli.Titulo);
                $("#lista_Peliculas").attr("size", peliculas.length);
                $("#lista_Peliculas").append(elementoLista);
            });
        }  
        
        //////////////////////////////////////////////////////////////////////////

        // Funcion onClick que recive que pelicula se selecciona de la lista creada
        // en la funcion anterior. Esto dispara la creacion y posterior escucha de 
        // todas los demas elementos del resto de pestañas.

        //////////////////////////////////////////////////////////////////////////

        $(".opcionPelicula").click(function(){ // Ininio Funcion Click Pelicula
            $("#reseña").html('');
            $("#lista_sesiones").html('');
            $("#lista_horarios").html('');
            let pelicula = peliculas.find(peli => peli.id==$("#lista_Peliculas").val());
            let contenedorImagen = $("<div>");        
            contenedorImagen.attr("class", "text-left col-md-offset-2 col-md-5 justify-content-start");
            let imagen = $("<img>");   
            imagen.attr("class", "cartelSelec offset-md-1 col-md-10");
            imagen.attr("src", pelicula.Cartel);
            contenedorImagen.append(imagen);
            let datos =  $("<div>"); 
            datos.attr("class", "card md-offset-1 col-md-5 mt-3 mt-md-0");
            let cabecera =  $("<div>");
            cabecera.attr("class", "card-header");
            let titulo = $("<span>");
            titulo.text(pelicula.Titulo);
            cabecera.append(titulo);
            datos.append(cabecera);
            let cuerpo =  $("<div>");
            cuerpo.attr("class", "card-body");
            let texto = $("<p>");
            texto.attr("class", "card-text");
            texto.text(pelicula.Duracion);
            cuerpo.append(texto);
            datos.append(cuerpo);
    
            $("#reseña").append(contenedorImagen);
            $("#reseña").append(datos);
            
            $("#lista_sesiones").html('');        
            let listaProyec = proyecciones.filter(proy => proy.idPelicula==$("#lista_Peliculas").val());
            let actual_Fecha = Date.now();
            let arrayFecha=new Array();
            listaProyec.forEach(peli => {   // Inicio For
                let fecha_peli= new Date(peli.Fecha);
                if(fecha_peli>actual_Fecha && !arrayFecha.includes(peli.Fecha)){
                    arrayFecha.push(peli.Fecha);
                    let elementoLista = $("<option>");
                    elementoLista.attr("value", peli.Fecha);
                    elementoLista.attr("class", "opcionSesion");
                    elementoLista.attr("id", "opcionSesion");
                    elementoLista.text(peli.Fecha);
                    $("#lista_sesiones").append(elementoLista);
                } 
            });     // Fin For
            if (arrayFecha.length>5) {
                $("#lista_sesiones").attr("size", arrayFecha.length);          
                
            } else {
                $("#lista_sesiones").attr("size", 5);
            }            

            $(".opcionSesion").click(function(){
                $("#lista_horarios").html('');
                let listaProyecF = proyecciones.filter(proy => proy.idPelicula==$("#lista_Peliculas").val() && proy.Fecha==$("#lista_sesiones").val());
                listaProyecF.forEach(peliF => {
                    let elementoListaH = $("<option>");
                    elementoListaH.attr("value", peliF.id);
                    elementoListaH.attr("class", "opcionFecha");
                    elementoListaH.attr("id", "opcionFecha");
                    elementoListaH.text(peliF.Hora.slice(0,-3));
                    $("#lista_horarios").append(elementoListaH);
                });  // Fin For
                $("#lista_horarios").attr("value", null); 
                if (listaProyecF.length > 5) {
                    $("#lista_horarios").attr("size", listaProyecF.length);          
                    
                } else {
                    $("#lista_horarios").attr("size", 5);  
                } 
                $(".opcionSesion").attr('autofocus', true);
                //////////////////////////////////////////////////////////////////////////

                // Escucha al elemento select con la lista de sesiones disponibles.
                // Posteriormente crea el DOM de la pestaña de Butacas.

                //////////////////////////////////////////////////////////////////////////

                $("#lista_horarios").click(function(){   // Ininio Funcion Click Horario
                    $("#disponibles").html('');  
                    $("#reservadas").html('');  

                    let Proyec = proyecciones.find(proy => proy.id==$("#lista_horarios").val());

                    let datos =  $("<div>"); 
                    datos.attr("class", "card ");
                    let cabecera =  $("<div>");
                    cabecera.attr("class", "card-header text-center");
                    let titulo = $("<h3>");
                    titulo.text("Asientos");
                    cabecera.append(titulo);
                    datos.append(cabecera);
                    let cuerpo =  $("<div>");
                    cuerpo.attr("class", "card-body");
                    let textoAsiento = $("<h5>");
                    textoAsiento.attr("class", "card-subtitle");
                    textoAsiento.text("Asientos Totales:");
                    cuerpo.append(textoAsiento);
                    let texto1 = $("<p>");
                    texto1.attr("class", "card-text");
                    texto1.text(Proyec.Butacas);
                    cuerpo.append(texto1);
                    let texto2 = $("<h5>");
                    texto2.attr("class", "card-subtitle");
                    texto2.text("Asientos Disponibles:");
                    cuerpo.append(texto2);
                    let texto3 = $("<p>");
                    texto3.attr("class", "card-text num_disponibles");
                    texto3.text(Proyec.Disponibles);
                    cuerpo.append(texto3);
                    datos.append(cuerpo);
                    $("#disponibles").append(datos);

                    let datosform =  $("<div>"); 
                    datosform.attr("class", "card ");
                    let cabecera2 =  $("<div>");
                    cabecera2.attr("class", "card-header  text-center");
                    let tituloForm = $("<h3>");
                    tituloForm.text("Reserva");
                    cabecera2.append(tituloForm);
                    datosform.append(cabecera2);
                    let cuerpoForm =  $("<div>");
                    cuerpoForm.attr("class", "card-body");
                    let textoForm = $("<h5>");
                    textoForm.attr("class", "card-subtitle  text-center");
                    textoForm.text("¿Cuantos asientos desea reservar?");
                    cuerpoForm.append(textoForm);
                    let texto1Form = $("<input>");
                    texto1Form.attr("type", "number");
                    texto1Form.attr("name", "cantidad");
                    texto1Form.attr("id", "cantidad");
                    texto1Form.attr("min", "1");
                    texto1Form.attr("max", Proyec.Disponibles);
                    texto1Form.attr("class", "card-text mt-2 ml-1 form-control");
                    cuerpoForm.append(texto1Form); 
                    datosform.append(cuerpoForm);
                    $("#reservadas").append(datosform);   
                    
                    
                    $("#cantidad").blur(function(){
                        if ($("#cantidad").val()>0) {
                            
                            $("#datosFinal").html('')
                            
                            let pelicula = peliculas.find(peli => peli.id==$("#lista_Peliculas").val());
                            let Proyec = proyecciones.find(proy => proy.id==$("#lista_horarios").val());
                            let imagen = $(".cartelSelec");
                            let contenedorImagen = $("<div>");        
                            contenedorImagen.attr("class", "text-left offset-1 col-md-4 justify-content-start");
                            contenedorImagen.append(imagen);
                            let datosFinal =  $("<div>"); 
                            datosFinal.attr("class", "card offset-1 mt-5 mt-md-0 cardFinal col-md-4");
                            let cabecera =  $("<div>");
                            cabecera.attr("class", "card-header");
                            let titulo = $("<h5>");
                            titulo.text(pelicula.Titulo);
                            cabecera.append(titulo);
                            datosFinal.append(cabecera);

                            let cuerpoFinal =  $("<div>");
                            cuerpoFinal.attr("class", "card-body");
                            let lista = $("<ul>");
                            let listado = $("<li>");
                            listado.attr("class", "card-text");
                            listado.text("Fecha: "+Proyec.Fecha);
                            lista.append(listado);
                            let listado1 = $("<li>");
                            listado1.attr("class", "card-text");
                            listado1.text("Hora: "+Proyec.Hora);
                            lista.append(listado1);
                            let listado5 = $("<li>");
                            listado5.attr("class", "card-text");
                            listado5.text("Tarifa: "+Proyec.Definicion_Tarifa);
                            lista.append(listado5);
                            let listado2 = $("<li>");
                            listado2.attr("class", "card-text");
                            listado2.text("Precio: "+Proyec.Precio);
                            lista.append(listado2);
                            let listado3 = $("<li>");
                            listado3.attr("class", "card-text");
                            listado3.text("Cantidad: "+$("#cantidad").val());
                            lista.append(listado3);
                            let listado4 = $("<li>");
                            listado4.attr("class", "card-text");
                            let total = $("#cantidad").val()*Proyec.Precio
                            listado4.text("Total: "+total.toFixed(2));
                            lista.append(listado4);
                            cuerpoFinal.append(lista);
                            datosFinal.append(cuerpoFinal);

                            $("#datosFinal").append(contenedorImagen);
                            $("#datosFinal").append(datosFinal);



                            $(".confirmar").click(function(){ // Boton Finalizar Panel Confirmación 
                                let usuario = getCookie("usuario_cine");
                                let Proyec =   JSON.stringify(proyecciones.find(proy => proy.id==$("#lista_horarios").val()));
                                let pelicula = peliculas.find(peli => peli.id==$("#lista_Peliculas").val());
                                let titulo= pelicula.Titulo;
                               $.ajax({
                                    type: "post",
                                    url: "../scripts/funciones.php",
                                    data: {id:usuario,peli:titulo,butacas:$("#cantidad").val(),proyeccion:Proyec,funcion:"funcion5"},
                                    error(xhr,status,error){console.log("nope");
                                    },
                                    success: function (data) {
                                       window.location.href="../contenido/usuario.php";
                                    }
                                });   
                            });  


                        } else {
                            $("#cantidad").toggleClass("border border-danger");
                        }
                    });

                });   // Fin Funcion Click Horario

            }); // Fin Funcion Click Sesion

        });  // Fin Funcion Click Pelicula

        //////////////////////////////////////////////////////////////////////////

        //              FIN DE LA FUNCIÓN MUESTRA

        //////////////////////////////////////////////////////////////////////////

    }

    //////////////////////////////////////////////////////////////////////////

    // Bloque de control de los botones de dirección de las pestañas de la 
    // pagina de venta de entradas. Previamente se inutilizo el menu superior
    // por lo que se fuerza al uso de estos botones para la navegacion en
    // esta pagina.
    // En todos los botones se comprueba si se ha seleccionado un elemento
    // del formulario. Si no es asi no permite el avance.
    
    //////////////////////////////////////////////////////////////////////////
    
    $(".sesionSig").click(function(){ // Boton Siguiente Panel Sesión
        if (getCookie("usuario_cine")==-1) { // A partir de esta pestaña se necesita estar registrado para acceder
            $('#login').modal('show');
        }else{      
            if ($("#lista_sesiones").val()!=null && $("#disponibles").find("div").length > 0) { 
                $(".link_asiento").toggleClass("active show");
                $(".link_sesion").toggleClass("active show");
                $("#asientos").toggleClass("active show");
                $("#sesion").toggleClass("active show");
                $("#lista_Peliculas").removeClass("border border-danger");
            }else if ($("#disponibles").find("div").length == 0){
                $("#lista_horarios").toggleClass("border border-danger"); 
            } else {               
                $("#lista_sesiones").toggleClass("border border-danger");    
            }
        }   
    });

    $(".peliculaSig").click(function(){ // Boton Siguiente Panel Películas
        if ($("#lista_Peliculas").val()!=null) {            
            $(".link_pelicula").toggleClass("active show");
            $(".link_sesion").toggleClass("active show");
            $("#pelis").toggleClass("active show");
            $("#sesion").toggleClass("active show"); 
            $("#lista_Peliculas").removeClass("border border-danger"); 
        } else {               
            $("#lista_Peliculas").toggleClass("border border-danger");    
        }
    });   

    $(".asientosSig").click(function(){ // Boton Siguiente Panel Butacas  
        if ($("#cantidad").val()!=null && $("#cantidad").val()<=parseInt($(".num_disponibles").text()) && $("#cantidad").val()>=1) {
            $(".link_asiento").toggleClass("active show");
            $(".link_check").toggleClass("active show");
            $("#asientos").toggleClass("active show");
            $("#pagos").toggleClass("active show"); 
            $("#cantidad").removeClass("border border-danger"); 
        }else{            
            $("#cantidad").toggleClass("border border-danger");   
        }        
    });  



     $(".sesionAtras").click(function(){ // Boton Atras Panel Butacas 
        $(".link_pelicula").toggleClass("active show");
        $(".link_sesion").toggleClass("active show");
        $("#pelis").toggleClass("active show");
        $("#sesion").toggleClass("active show");
    });

    $(".asientosAtras").click(function(){ // Boton Atras Panel Butacas 
        $(".link_asiento").toggleClass("active show");
        $(".link_sesion").toggleClass("active show");
        $("#asientos").toggleClass("active show");
        $("#sesion").toggleClass("active show");
    });  

     $(".confirmAtras").click(function(){ // Boton Atras Panel Confirmación 
        $(".link_asiento").toggleClass("active show");
        $(".link_check").toggleClass("active show");
        $("#asientos").toggleClass("active show");
        $("#pagos").toggleClass("active show");
    });  

    //////////////////////////////////////////////////////////////////////////
    //
    //  Funcion para obtener una Cookie almacenada en disco.
    //
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
 
    //       Fin SCRIPT

    //////////////////////////////////////////////////////////////////////////

});