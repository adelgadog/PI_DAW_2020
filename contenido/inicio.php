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
                            <a href="reservas.php" class="nav-link" >Reserar</a>
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
                                <a href="" class="nav-link">Administrar</a>
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
                <h3 class="text-center mt-5">El Cine</h3>
                <h3 class="text-center mt-5">Inicio</h3>
                        

            </div>
        </section>

        <footer class="page-footer  bg-dark">             
        <div class=" row bg-dark text-white justify-content-end">
                    <div class="d-flex justify-content-end mt-2">
                        <nav class="navbar navbar-expand-md navbar-dark justify-content-end bg-dark">
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav mr-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contactanos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Ubicación</a>
                                </li>
                                </ul>
                            </div>                        
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </nav>
                    </div>
                </div>         
                
                <div class=" row text-center  bg-dark text-white ">
                    <div class="mx-auto mb-2">
                    <span>© 2020 Copyright:</span>    
                    <span>Andrés Delgado</span></div>
                </div> 
        </footer>
    </div>




    <article class="modal fade" id="login">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inicia sesión</h5>
                    <span data-dismiss="modal" class="close">X</span>
                </div>
                <form method="post" class="form-signin" id="inicio">
                    <div class="modal-body">
                        <div class="form-label-group">
                            <label for="correo" class="col-form-label">Correo electrónico:</label>
                            <input type="email" id="correo_L" name="correo" class="form-control" placeholder="Correo electrónico" autofocus required>
                        </div>

                        <div class="form-label-group">
                            <label for="password" class="col-form-label">Contraseña:</label>
                            <input type="password" id="password_L" name="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group">
                            <label for="remember" class="col-form-label">Recuerdame:</label>
                            <input type="checkbox" name="remember" id="remember">
                        </div>
                    </div>
                    <div class="modal-footer">                          
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" name="entrar" id="b_login" class="btn btn-success b_login">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </article>

        
    <article class="modal fade" id="registrar">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrarse</h5>
                    <span data-dismiss="modal" class="close">X</span>
                </div>

                <form method="post" class="form-signin ">
                    <div class="modal-body">
                        
                        <div class="form-label-group">
                            <label for="nombre" class="col-form-label">Nombre:</label>
                            <input type="text" id="Usuario_R" name="nombre" class="form-control" placeholder="Nombre" autofocus>
                        </div>

                        <div class="form-label-group">
                            <label for="mail" class="col-form-label">Correo electrónico:</label>
                            <input type="email" id="Mail_R" name="correo" class="form-control" placeholder="Dirección de correo electrónico" autofocus required>
                        </div>

                        <div class="form-label-group">                            
                            <label for="psw1" class="col-form-label">Contraseña:</label>
                            <input type="password" id="Pass_R" name="password" class="form-control" placeholder="Contraseña">
                        </div>

                        <div class="form-label-group">        
                            <label for="psw2" class="col-form-label">Repita Contraseña:</label>
                            <input type="password" id="psw2" name="password" class="form-control" placeholder="Contraseña">
                        </div>

                    </div>

                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" name="entrar" id="b_registro" class="btn btn-primary b_registro">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </article>

</body>
</html>