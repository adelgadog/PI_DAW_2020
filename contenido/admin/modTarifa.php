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
        <title>Admin: Actualizar Tarifa</title>
        <link rel="stylesheet" href="../../styles/styleAdmin.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script>
            function goBack() {
                window.location.replace("adminTarifas.php");
            }
        </script>
    </head>
<body class="fondo">  
<?php
    if (empty($_POST["borrar"]) && empty($_POST["modificar"]) ) {
        header("Location: adminTarifas.php?vacio=1");      
    } else {
        if (!empty($_POST["borrar"])) {
            $tarifa= json_decode($_POST['datos']);
            ?>
        <form action="upTarifa.php" method="post">
            <table class="tablaAdminPelicula">
                <th class="tablaAdminPelicula_th" colspan=2><span>Confirmación de borrado de Tarífa</span></th>
                <tr>
                    <td colspan=2><span>Borrar Tarífa:</span></td>
                         
                </tr>
                <tr>
                    <td><span>Definición:</span></td>
                    <td><span><?php echo $tarifa->Definicion; ?></span></td>        
                </tr>
                <tr>
                    <td><span>Precio:</span></td>
                    <td>
                    <span><?php echo $tarifa->Precio; ?></span>     
                    <input type="hidden" id="id" name="id"  value='<?php echo $tarifa->idTipo; ?>'>                      
                    </td>        
                </tr>
                <tr>
                    <td><button onclick="goBack()">No</button></td>
                    <td><input type="submit" name="dellTarifa" id="dellTarifa" class="btn btn-warning" value="Borrar"></td>        
                </tr>                   
            </table>
        </form>

  <?php          
        } else {
            $tarifa= json_decode($_POST['datos']);

            ?>
    <form action="upTarifa.php" method="post">
        <table class="tablaAdminPelicula">
            <th class="tablaAdminPelicula_th" colspan=2><span>Formulario de Actualización de Tarifa</span></th>
            <tr>
                <td><span>Definición:</span></td>
                <td><input type="text" id="def" name="def"  value='<?php echo $tarifa->Definicion; ?>'  autofocus>
                <input type="hidden" id="id" name="id"  value='<?php echo $tarifa->idTipo; ?>'></td>        
            </tr>
            <tr>
                <td><span>Descripción:</span></td>
                <td><textarea id="desc" name="desc" rows="6" cols="20" ><?php echo $tarifa->Descripcion; ?></textarea></td>        
            </tr>
            <tr>
                <td><span>Precio:</span></td>
                <td><input type="text" id="precio" name="precio" value='<?php echo $tarifa->Precio; ?>'></td>        
            </tr>
            <tr>
                <td><button onclick="goBack()">Volver</button></td>
                <td><input type="submit" name="upTarifa" id="upTarifa" class="btn btn-primary" value="Actualizar"></td>        
            </tr>                   
        </table>
    </form>
<?php
        }
    }    
?>
</body>
</html>