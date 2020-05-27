<?php
    if (isset($array_Pelicula)) {
        
   
        foreach ($array_Pelicula as $pelis) {
    ?>
    <article class="modal fade " id="<?php echo $pelis->id; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span data-dismiss="modal" class="close">X</span>
                </div>               
                <div class="modal-body modal_peliculas">
                    <div class="card">
                        <div class="mb-3 mt-2 mr-2 d-flex justify-content-end">
                            <div class="contenedor_nota ">
                                <img class="card-img-top" src="../img/<?php
                                    switch($pelis->Valoracion) {
                                    case ($pelis->Valoracion>6): 
                                        echo "verde.png";
                                        break;
                                    case ($pelis->Valoracion>3&&$pelis->Valoracion<=6): 
                                        echo "amarillo.png";
                                        break;
                                    default:
                                        echo "rojo.png";
                                        break;  
                                    }
                                ?>" id="nota">
                                <h3 class="n_nota justify-content-end"><?php echo $pelis->Valoracion; ?></h3>
                            </div>       
                        </div>             

                        <img class="card-img-top" src="https://m.media-amazon.com/images/<?php echo $pelis->Cartel; ?>" id="imgTarjeta">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $pelis->Titulo; ?></h3>
                            <h5 class="card-subtitle">Año: <?php echo $pelis->Año; ?> </h5>
                            <h5 class="card-subtitle">Duración: <?php echo $pelis->Duracion; ?></h5>
                            <h5 class="card-subtitle">Calificaion: <?php echo $pelis->Calificacion; ?></h5>
                            <h5 class="card-subtitle">Genero: <?php echo $pelis->Genero; ?></h5>
                            <h5 class="card-subtitle">Pais: <?php echo $pelis->Pais; ?></h5>
                            <h5 class="card-subtitle">Estreno: <?php echo $pelis->Estreno; ?></h5>
                            <h5 class="card-subtitle">Sinopsis:</h5>
                            <p class="card-text"><?php echo $pelis->Sinopsis; ?></p>                            
                        </div>
                        <div class="card-footer">
                            <iframe id="video" src=<?php echo $pelis->Trailer; ?> frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">                          
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                
            </div>
        </div>
    </article>
    <?php
     }
        }
    ?>