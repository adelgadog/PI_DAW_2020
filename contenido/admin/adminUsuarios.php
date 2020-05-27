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
    <title>Admin: Añadir Película</title>
    <link rel="stylesheet" href="../../styles/styleAdmin.css">
    <script>
        function goBack() {
            window.close();
        }
    </script>
</head>
<body>  
    <?php
        if (!empty($_GET["accion"])) {
            $accion=$_GET["accion"];
            if ($accion=="-1") {
                ?> <h3>Ha surguido un problema y no se ha podido realizar la operación</h3> <?php
            } else {                
                ?> <h3>Operación realizada con exito.</h3> <?php
            }
            
        } 
    ?>
    
        <table class="tablaAdminPelicula">
            <th class="tablaAdminPelicula_th" colspan=6><span>Formulario de Administración de Usuarios</span></th>
            <tr>
                <td>Id</td>
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
                            <td><?php echo $usuario->id; ?><input type='hidden' name='id' value='<?php echo $usuario->id; ?>'></td>
                            <td><?php echo $usuario->nombre; ?></td>
                            <td><?php echo $usuario->mail; ?></td>
                            <td><?php echo $usuario->admin; ?><input type='hidden' name='admin' value='<?php echo $usuario->admin; ?>'></td>
                            <td><input type='submit' name='modificar' value='Modificar Admin'></td>
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