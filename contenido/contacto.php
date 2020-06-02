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
                <div class="row mt-5 mb-1 text-center">
                    <div class="col-lg-4 offset-lg-4 text-center ">
                        <h3 class=" text-center  mt-5">Contacte con nosotros</h3>
                    </div>                    
                </div>

                <div class="row mt-5 mb-1 ">
                    
                    <div class="col-lg-3 offset-1">
                        <address>
                            <span>E-Mail: <a href="mailto:cines.la.claqueta.rota@gmail.com">cines.la.claqueta.rota@gmail.com</a> </span><br>
                            
                            <abbr>Teléfono: </abbr><span>659284353</span> <br>
                        </address>
                    </div>
                    <div class="col-lg-5 col-9 text-center text-lg-left offset-1">
                        <form  action="contactar.php"  method="post">  <!-- <form  action="mailto:cines.la.claqueta.rota@gmail.com"  method="post">  -->
                            <div class="form-group row">
                                <label for="nombreUser">Nombre: </label>
                                <input type="text" class="form-control" name="contactoUser" id="nombreUser" required placeholder="Tu Nombre">
                            </div>
                            <div class="form-group row">
                                <label for="nombreUser">E-Mail: </label>
                                <input type="amail" class="form-control" name="contactoMail" required id="emailUser" placeholder="correo@ejemplo.com">
                            </div>
                            <div class="form-group">
                                <label for="comentUser">Comentario:</label>
                                <textarea class="form-control" id="comentUser" name="contactoMensaje" required rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn mr-5 btn-primary">Enviar</button> <?php if ($_GET["enviado"]){echo "<span>Mensaje enviado.</span>";} ?>
                        </form>
                    </div>

                </div>
            </div>
        </section>

        <?php include 'footer.php';?>
        <?php include 'panelPelicula.php';?>
        
</body>
</html>