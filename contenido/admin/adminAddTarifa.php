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
    <title>Admin: Añadir Tarifas</title>
    <link rel="stylesheet" href="../../styles/styleAdmin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        function goBack() {
            window.close();
        }
    </script>
</head>
<body class="fondo">  
    <?php
        if (!empty($_GET["accion"])) {
            $accion=$_GET["accion"];
            if ($accion=="-1") {
                ?> <h3 class="h3 text-warning text-center">Ha surguido un problema y no se ha podido realizar la operación</h3> <?php
            } else {                
                ?> <h3 class="h3 text-success text-center">Operación realizada con exito.</h3> <?php
            }
            
        } 
    ?>
    <form action="addTarifa.php" method="post">
    <table class="tablaAdminPelicula">
        <th class="tablaAdminPelicula_th" colspan=2>Formulario de Tarifas</th>
        <tr>
            <td><span>Definición:</span></td>
            <td><input type="text" id="def" name="def"  placeholder="" autofocus></td>        
        </tr>
        <tr>
            <td><span>Descripción:</span></td>
            <td><textarea id="desc" name="desc" rows="6" cols="20" ></textarea></td>        
        </tr>
        <tr>
            <td><span>Precio:</span></td>
            <td><input type="text" id="precio" name="precio"  placeholder=""></td>        
        </tr>
        <tr>
            <td><button onclick="goBack()">Volver</button></td>
            <td><input type="submit" name="addTarifa" id="addTarifa" class="btn btn-primary" value="Añadir"></td>        
        </tr>
    </table>
    </form>
</body>
</html>