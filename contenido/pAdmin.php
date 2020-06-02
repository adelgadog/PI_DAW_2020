<?php
    if(isset($_COOKIE["usuario_cine"])) {
        $Registrado=true;
        $array_User= json_decode($_COOKIE['usuario_cine']);
        if ($array_User->admin=="1") {
            $admin=true;
        } else {
            header("Location: inicio.php");
        }        
    }else{        
        header("Location: inicio.php");
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
                <h3 class="text-center mt-5">Panel de Administración</h3>
                <div class="row mt-5 mb-1 justify-content-center">
                    <div class="col-offset-1 col-md-10">
                        <table class="table col-md-4  table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col " colspan="2">Seleccione una Opción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Añadir Pelicula</th>
                                    <th>Modificar Pelicula</th>
                                </tr>
                                <tr>
                                    <td><a class="btn btn-info" href="admin/adminAddPelicula.php" target="_blank">Añadir</a> </td>
                                    <td><a class="btn btn-info" href="admin/adminPeliculas.php" target="_blank">Modificar</a> </td>
                                </tr>
                                <tr>
                                    <th>Añadir Proyección</th>
                                    <th>Modificar Proyección</th>
                                </tr>
                                <tr>
                                    <td><a class="btn btn-info" href="admin/adminAddProyeccion.php" target="_blank">Añadir</a> </td>
                                    <td><a class="btn btn-info" href="admin/adminProyeccion.php" target="_blank">Modificar</a> </td>
                                </tr>
                                <tr>
                                    <th>Añadir Tarifa</th>
                                    <th>Modificar Tarifa</th>
                                </tr>
                                <tr>
                                    <td><a class="btn btn-info" href="admin/adminAddTarifa.php" target="_blank">Añadir</a> </td>
                                    <td><a class="btn btn-info" href="admin/adminTarifas.php" target="_blank">Modificar</a> </td>
                                </tr>
                                <tr>
                                    <th colspan="2">Modificar Usuario</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><a class="btn btn-info" href="admin/adminUsuarios.php" target="_blank">Modificar</a> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>        

            </div>
        </section>

        
        <?php include 'footer.php';?>
        <?php include 'panelPelicula.php';?>
</body>
</html>