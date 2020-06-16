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
    if(!isset($array_Pelicula)) {
        require_once '../../scripts/funciones.php';
        $array_Usuarios=Get_Usuarios();
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Administrar Usuarios</title>
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
    
        <table class="tablaAdminPelicula">
            <th class="tablaAdminPelicula_th" colspan=5><span>Administración de Usuarios</span></th>
            <tr>
                <td>Nombre</td>
                <td>Mail</td>
                <td>Admin</td>
                <td colspan=2>Opciones</td>
            </tr>
            <?php
                foreach ($array_Usuarios as $usuario) {
                    ?>
                    <form action="modUsuario.php" method="post">
                        <tr>
                            <td><?php echo $usuario->nombre; ?><input type='hidden' name='id' value='<?php echo $usuario->id; ?>'></td>
                            <td><?php echo $usuario->mail; ?></td>
                            <td><?php echo $usuario->admin; ?><input type='hidden' name='datos' value='<?php echo json_encode($usuario) ?>'></td>
                            <td><input type='submit' name='modificar' value='Modificar'></td>
                            <td><input type='submit' name='borrar' value='Borrar'></td>
                        </tr>
                    </form>
                    <?php
                }
            ?>
           <tr> <td><button onclick="goBack()">Volver</button></td></tr>
        </table>
    
   
</body>
</html>