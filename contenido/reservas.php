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
        if(!isset($array_peliculas) || !isset($array_proyecciones)) {
            require_once '../scripts/funciones.php';
            $array_Pelicula=Get_Peliculas();
            $array_proyecciones=Get_Proyeccion();
        }    

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon/ico" href="../img/favicon2.ico">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="../scripts/script_Reserva.js"></script>  
    <script src="../scripts/script.js"></script>    
  
    <title>Cine</title>
</head>
<body>

    <div class="container-fluid" id="fondo">

        <header class="row">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top justify-content-center">    
                <div class="navbar-brand d-flex w-45 mr-auto">
                    <a href="../index.php"  id="logo">
                        <img src="../img/logoW.png" id="logo_img">
                    </a>
                </div>            

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse w-100 " id="menu">
                    <ul class="navbar-nav w-100 justify-content-center mt-2 mt-sm-0">
                        <li class="nav-item ">
                            <a href="tarifas.php" class="nav-link">Tarifas</a>
                        </li>
                        <li class="nav-item">
                            <a href="cartelera.php" class="nav-link">Cartelera</a>
                        </li>

                        <li class="nav-item">
                            <a href="reservas.php" class="nav-link active" >Reservar</a>
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
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-end">
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
                                    <span class="text-white mr-3">Hola, <?php echo $array_User->nombre;?> </span>
                               
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
                <div class="row mt-4 mb-1 justify-content-center">
                    <h3 class="text-center mt-5">Reserva de Butacas</h3>
                </div>
                <div class="mr-md-5 ml-md-5 mt-md-5 mt-3">
                    <ul class="nav nav-tabs justify-content-center" id="menuTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link link_pelicula active enlaces_tab" href="" id="tabForm" role="tab">Pelicula</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link_sesion enlaces_tab" href="" id="tabForm" role="tab">Sesión</a>
                        </li>
                        <li class="nav-item">  
                            <a class="nav-link link_asiento enlaces_tab <?php if (!$Registrado){ echo "disabled"; }?>" id="tabForm"  role="tab" href="">Butacas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link_check enlaces_tab <?php if (!$Registrado){ echo "disabled"; }?>" id="tabForm"  role="tab" href="">Confirmación</a>
                        </li>
                    </ul>

                    <form action="" method="post">
                        <div class="tab-content " id="myTabContent">
                            <div class="tab-pane  fade show active" id="pelis" role="tabpanel" > 
                                <div class="container">
                                    <div class="row text-center justify-content-center">
                                        <h3 class="text-center mt-3">Lista de Peliculas</h3>
                                    </div>                           
                                    <div class="row panelPirncipal">
                                        <div class="col-lg-4 offset-lg-1">                                    
                                            <label class="ml-5 mt-3" for="lista_Peliculas">Selecciona la pelicula:</label>
                                            <select multiples value="" name="lista_Peliculas" class="form-control mt-2" id="lista_Peliculas">
                                            </select>
                                        </div>
                                        <div class=" col-lg-6 offset-lg-1 mt-5 text-right justify-content-end" >
                                            <div class="row" id="reseña">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-1 offset-sm-10 offset-5" role="tablist">
                                            <a class=" btn btn-primary text-white peliculaSig tab-next" href="#sesion" id="tabForm" role="tab" data-toggle="tab">Siguiente</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane  fade " id="sesion" role="tabpanel" >
                            <div class="container">
                                <div class="row text-center justify-content-center">
                                    <h3 class="text-center mt-3">Lista de Sesiones</h3>
                                </div>                          
                                <div class="row panelPirncipal">
                                    <div class="col-md-4 offset-lg-1 listaFecha">                                    
                                        <label class="ml-lg-5 mt-3" for="lista_sesiones">Selecciona la sesión:</label>
                                        <select  multiples name="lista_sesiones" class="form-control mt-2" id="lista_sesiones">
                                        </select>
                                    </div>
                                    <div class="col-md-4 offset-md-2" id="horarios">                              
                                        <label class=" ml-lg-5 mt-3" for="lista_horarios">Selecciona el Horario:</label>
                                        <select multiples class="form-control mt-2" name="lista_horarios" id="lista_horarios">
                                        </select>
                                    </div>
                                </div>                                
                                <div class="row mt-5">
                                    <div class="col-1 offset-sm-1 offset-0">
                                        <a class=" btn btn-primary text-white sesionAtras" >Atras</a>
                                    </div>
                                    <div class="col-1 offset-sm-8 offset-5">                                   
                                    
                                        <a class=" btn btn-primary text-white sesionSig" <?php if (!$Registrado){ echo "data-toggle='modal' data-target='#login'"; }?> >Siguiente</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="tab-pane  fade " id="asientos" role="tabpanel" >
                                <div class="container">
                                    <div class="row text-center justify-content-center">
                                        <h3 class="text-center mt-3">Seleccion de asientos</h3>
                                    </div>                           
                                    <div class="row panelPirncipal">
                                        <div class="col-lg-5 col-xl-4 offset-xl-1 mt-5" id="disponibles">    
                                        </div>
                                        <div class="col-lg-5 offset-xl-1 mt-5" id="reservadas">
                                        </div>                                    
                                    </div>                           
                                    <div class="row mt-5">
                                        <div class="col-1 offset-sm-1 offset-0">
                                            <a class=" btn btn-primary text-white asientosAtras" >Atras</a>
                                        </div>
                                        <div class="col-1 offset-sm-8 offset-5">
                                            <a class=" btn btn-primary text-white asientosSig" >Siguiente</a>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div class="tab-pane container fade " id="pagos" role="tabpanel" >
                                <div class="container">
                                    <div class="row text-center justify-content-center">
                                        <h3 class="text-center mt-3">Confirme la Selección</h3>
                                    </div>                                                
                                    <div class="row panelPirncipal">
                                        <div class="row mt-5"  id="datosFinal">
                                        </div>                                 
                                    </div>        
                                    <div class="row mt-5">
                                        <div class="col-1 offset-sm-1 offset-0">
                                            <a class=" btn btn-primary text-white confirmAtras" >Atras</a>
                                        </div>
                                        <div class="col-1 offset-sm-8 offset-5">
                                            <a class=" btn btn-success text-white confirmar" >Finalizar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </form>
                </div>           
            </div>
        </section>

        <?php include 'footer.php';?> 

</body>
</html>