<?php
    if(isset($_COOKIE["usuario_cine"])) {
        $Registrado=true;
        $array_User= json_decode($_COOKIE['usuario_cine']);
        if ($array_User->admin=="1") {
            $admin=true;
        }       
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
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="../scripts/script.js"></script>    
    <title>Cine</title>
</head>
<body>


    <div class="container-fluid bg-secondary">

        <header class="row">
                <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top justify-content-center">    
                    <div class="navbar-brand d-flex w-50 mr-auto">
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
                        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                            <?php
                            if (!$Registrado) {
                            ?>
                                <li class="nav-item">
                                    <input class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#login" type="button" value="Log-In">
                                </li> 
                                <li class="nav-item mt-2 mt-sm-0">
                                    <input class="btn btn-primary btn-sm" data-toggle="modal" data-target="#registrar" type="button" value="Registrarse">
                                </li> 
                            <?php
                            }else{                    
                            ?>
                                <li class="nav-item">
                                    <span class="text-white mr-3">Hola, <?php echo $array_User->nombre;?> </span>
                                </li> 
                                <li class="nav-item">
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
            <div class="col bg-white pt-4">
                
            </div>
        </section>

        <?php include 'footer.php';?>
        <?php include 'panelPelicula.php';?>
        
</body>
</html>