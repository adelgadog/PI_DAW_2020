<?php
    if(isset($_COOKIE["usuario_cine"])) {
        $Registrado=true;
        $array_User= json_decode($_COOKIE['usuario_cine']);
        if ($array_User->admin=="1") {
            $admin=true;
        } else {
            $admin=false;
        }        
    } 
    if(!isset($array_Pelicula)) {
        require_once '../scripts/funciones.php';
        $array_Pelicula=Get_Novedades();
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon/ico" href="../img/favicon2.ico">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="../scripts/script.js"></script>    
    <title>Cines La Claqueta Rota</title>
</head>
<body>


    <div class="fondo container-fluid " id="fondo">

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
                                <span class="text-white mr-3">Hola, <a href="usuario.php" class="usr_reservas" class="usr_reservas"><?php echo $array_User->nombre;?></a></span>
                           
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
            <div class="col  pt-4 seccion2">
                <div class="row mt-3 mb-1 justify-content-center">
                    <h3 class="text-center mt-5 h3">Multicines</h3><br>
                </div>
                <div class="row mt-4 mb-1 justify-content-center">
                    <h1 class="nombre ">La Claqueta Rota</h1>
                </div>
                <div class="row mt-4 mb-1 justify-content-center">
                    <h4 class="text-center mt-5">Nuestras Novedades</h4>
                </div>
                <div class="cajon_peliculas">
                    <?php
                        foreach ($array_Pelicula as $pelis) {
                    ?>
                    <div class="tarjeta_pelicula">   <!--Inicio tarjeta pelicula -->
                        <div class="card datos" data-toggle="modal" data-target="#<?php echo $pelis->id; ?>">
                            <img class=" btn card-img-top"  src="<?php echo $pelis->Cartel; ?>" id="imgTarjeta">
                            <div class="card-body ">
                                <h3 class="card-title"><?php echo $pelis->Titulo; ?></h3>
                                <h5 class="card-subtitle">Año: <?php echo $pelis->Año; ?> </h5>
                                <h5 class="card-subtitle">Duración: <?php echo $pelis->Duracion; ?></h5>
                                <p class="card-text">Nota Media: <?php echo $pelis->Valoracion; ?></p>
                            </div>
                        </div>  
                    </div>  <!--Fin tarjeta pelicula -->
                    <?php
                    }
                    ?>
                </div>           

            </div>
        </section>

        
        <?php include 'footer.php';?>
        <?php include 'panelPelicula.php';?>
</body>
</html>