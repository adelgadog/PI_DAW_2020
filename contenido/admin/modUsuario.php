<?php
    if(isset($_COOKIE["usuario_cine"])) {
        $Registrado=true;
        $array_User= json_decode($_COOKIE['usuario_cine']);
        if ($array_User->admin=="1") {
            $admin=true;
        } else {
            header("Location: ../../index.php");
        }        
    }else{        
        header("Location: ../../index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin: Actualizar Usuario</title>
        <link rel="stylesheet" href="../../styles/styleAdmin.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script>        
            function goBack() {
                window.location.replace("adminUsuarios.php");
            }
        </script>
    </head>

    <body class="fondo">  
<?php

    if (empty($_POST["borrar"]) && empty($_POST["modificar"]) ) {
        header("Location: adminUsuarios.php?vacio=1");      
    } else {
        if (!empty($_POST["borrar"])) {            
            $usuario= json_decode($_POST['datos']);
            ?>
        <form action="upUsuario.php" method="post">
            <table class="tablaAdminPelicula">
                <th class="tablaAdminPelicula_th" colspan=2><span>Confirmación de borrado de Usuario</span></th>
                <tr>
                    <td colspan=2><span>Borrar Usuario:</span></td>
                         
                </tr>
                <tr>
                    <td><span>Nombre:</span></td>
                    <td><span><?php echo $usuario->nombre; ?></span></td>        
                </tr>
                <tr>
                    <td><span>Correo:</span></td>
                    <td>
                    <span><?php echo $usuario->mail; ?></span>     
                    <input type="hidden" id="id" name="id"  value='<?php echo $usuario->id; ?>'>                      
                    </td>        
                </tr>
                <tr>
                    <td><button onclick="goBack()">No</button></td>
                    <td><input type="submit" name="dellUsuario" id="dellUsuario" class="btn btn-warning" value="Borrar"></td>        
                </tr>                   
            </table>
        </form>
<?php         
        } else {           
            $usuario= json_decode($_POST['datos']);
?>
        <form action="upUsuario.php" method="post">
            <table class="tablaAdminPelicula">
                <th class="tablaAdminPelicula_th" colspan=2><span>Formulario de Actualización de Usuario</span></th>
                <tr>
                    <td><span>Nombre:</span></td>
                    <td><input type="text" id="nombre" name="nombre"  value='<?php echo $usuario->nombre; ?>'  autofocus>
                    <input type="hidden" id="id" name="id"  value='<?php echo $usuario->id; ?>'></td>        
                </tr>
                <tr>
                    <td><span>Correo:</span></td>
                    <td><input type="text" id="mail" name="mail" value='<?php echo $usuario->mail; ?>'></td>        
                </tr>
                <tr>
                    <td><span>Admin:</span></td>
                    <td>
                        <input type="radio" id="admin1" name="admin" value="1" <?php if($usuario->admin==1) {echo "checked";}?>>
                        <label for="admin1">Si</label><br>
                        <input type="radio" id="admin2" name="admin" value="0" <?php if($usuario->admin==0) {echo "checked";}?>>
                        <label for="admin2">No</label>                            
                    </td>        
                </tr>
                <tr>
                    <td><button onclick="goBack()">Volver</button></td>
                    <td><input type="submit" name="upUsuario" id="upUsuario" class="btn btn-primary" value="Actualizar"></td>        
                </tr>
            </table>
        </form>   

<?php            
        }
    }    
?>
    </body>
</html>