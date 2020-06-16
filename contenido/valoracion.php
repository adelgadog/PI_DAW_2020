<?php
    if(isset($_COOKIE["usuario_cine"])) {
        $Registrado=true;
        $array_User= json_decode($_COOKIE['usuario_cine']);
        if ($array_User->admin=="1") {
            $admin=true;
        } else {
            $admin=false;
        }        
    }else{        
        header("Location: ../index.php");
    }
    if(!isset($array_reservas)) {
        require_once '../scripts/funciones.php';
        $array_reservas=Get_reservas($array_User->id); 
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon/ico" href="../img/favicon2.ico">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="../scripts/script.js"></script>    
    <script src="../scripts/scriptNota.js"></script>    
    <title>Cine</title>
</head>
<body>


    <div class="container-fluid" id="fondo">

    <header class="row">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top justify-content-center">    
                <div class="navbar-brand d-flex mr-5 w-45 mr-auto">
                    <a href="../index.php"  id="logo">
                        <img src="../img/logoW.png" id="logo_img">
                    </a>
                </div>            

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ml-mg-5 ml-3  w-100 " id="menu">
                    <ul class="navbar-nav menu_1_ul w-100 mr-lg-1 pr-5 justify-content-end mt-2 mt-sm-0">
                        <li class="nav-item ">
                            <a href="tarifas.php" class="nav-link">Tarifas</a>
                        </li>
                        <li class="nav-item">
                            <a href="cartelera.php" class="nav-link">Cartelera</a>
                        </li>

                        <li class="nav-item">
                            <a href="reservas.php" class="nav-link" >Reservar</a>
                        </li>
                        <?php
                        if ($Registrado){
                        ?>
                        <li class="nav-item">
                            <a href="valoracion.php" class="nav-link">Valorar</a>
                        </li> 
                        <?php
                        }
                        if ($admin){
                        ?>
                            <li class="nav-item">
                                <a href="pAdmin.php" class="nav-link">Administrar</a>
                            </li>                   
                        <?php
                        }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav menu_2_ul ml-auto w-100 justify-content-end align-items-end">
                        <?php
                        if (!$Registrado) {
                        ?>
                             <li class="nav-item">
                                    <input class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#login" type="button" value="Log-In">
                                
                                    <input class="btn btn-primary mt-2 mt-sm-0 btn-sm" data-toggle="modal" data-target="#registrar" type="button" value="Registrarse">
                                </li> 
                            <?php
                            }else{                    
                            ?>
                            <li class="nav-item">
                                <span class="text-white mr-3">Hola, <a href="usuario.php" class="usr_reservas"><?php echo $array_User->nombre;?></a></span>
                           
                                <input class="btn btn-warning btn-sm" id="salir" type="button" value="Salir">
                            </li> 
                        <?php  
                        }
                        ?>
                    </ul>
                </div>                
            </nav>
        </header>

        <section class="row justify-content-center seccion">
            <div class="col seccion2 pt-4">
                <h3 class="text-center mt-5">Valora las Peliculas que has visto.</h3>
                <h4 class="text-center mt-5">Solo podra valorar las peliculas cuya proyeccion ya se haya realizado.</h4>
                <div class="cajon_peliculas">
                    <?php
                        if ($array_reservas!=-1) {     
                            
                            foreach ($array_reservas as $reserva) {
                        ?><div class="container"><div class="row justify-content-center">
                        <div class="card mb-5 tarjeta_valora " >
                            <div class="row no-gutters cont_tarjeta_valora">
                                <div class="col-md-4 img_valorar">
                                    <img src="<?php echo $reserva->cartel; ?>" id="imgTarjetaNota" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8 ">
                                    <form action="valora.php" method="post">
                                        <div class="card-body ml-2 nota_cuerpo">
                                            <h5 class="card-title"><?php echo $reserva->titulo; ?></h5>
                                            <h5 class="card-subtitle mb-3">Fecha: <?php echo $reserva->fecha; ?>
                                            <div class="container mt-4 ml-md-3">
                                                <p class="card-text ">Nota Actual: <?php if($reserva->nota!=-1){ echo $reserva->nota;}else{echo "N-A";} ?></p>
                                                <div class="slidecontainer">
                                                    <input type="range" min="1" max="10" step="0.5" id="<?php echo $reserva->pelicula; ?>" 
                                                    name="nota" class="rango_nota custom-range" 
                                                    <?php if($reserva->fecha > date("Y-m-d")){ echo "disabled";} ?>
                                                    value='<?php if($reserva->nota!=-1){ echo $reserva->nota;}else{echo 5;} ?>'>
                                                    <input type="hidden" name="usuario" value="<?php echo $array_User->id; ?>">                                              
                                                    <input type="hidden" name="peli" value="<?php echo $reserva->pelicula; ?>">                                              
                                                    <input type="hidden" name="nueva" value="<?php if($reserva->nota!=-1){ echo 1;}else{echo 0;}?>">                                               
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer pie_valora">
                                            <div class="anuncio_<?php echo $reserva->pelicula; ?>" id="anuncio_<?php echo $reserva->pelicula; ?>"><p class="card-text ">Pon o cambia tu nota.</p></div>
                                            <div class=" modificar_<?php echo $reserva->pelicula; ?> oculto" id="modificar_<?php echo $reserva->pelicula; ?>">
                                                <div class="d-flex justify-content-between">
                                                <div> <span class="card-text">Nueva Nota:</span> <span class="muestra_nota_<?php echo $reserva->pelicula; ?>" id="muestra_nota_<?php echo $reserva->pelicula; ?>"></span></div>
                                                <button type="submit" class="btn-success b_nota" name="poner_nota" id="boton_<?php echo $reserva->pelicula; ?>">Enviar</button></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div></div></div>
                    <?php
                            }
                                           
                    } else {
                        ?>
                    
                        <h3 class="text-center mt-5">Aún no ha realizado ninguna reserva</h3>
                        <?php
                    }
                    ?>
                </div>           

            </div>
        </section>

        <?php include 'footer.php';?>

</body>
</html>