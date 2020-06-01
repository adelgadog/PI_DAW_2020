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
        $array_Proyecciones=Get_Proyeccion();
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Administrar Proyecciones</title>
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
            <th class="tablaAdminPelicula_th" colspan=8><span>Administración de Proyecciones</span></th>
            <tr>
                <td>Id</td>
                <td>Sala</td>
                <td>Id Pelicula</td>
                <td>Fecha</td>
                <td>Hora</td>
                <td>Tarifa</td>
                <td colspan=2>Opciones</td>
            </tr>
            <?php
                foreach ($array_Proyecciones as $proyeccion) {
                    ?>
                    <form action="modProyeccion.php" method="post">
                        <tr>
                            <td><?php echo $proyeccion->id; ?><input type='hidden' name='id' value='<?php echo $proyeccion->id; ?>'></td>
                            <td><?php echo $proyeccion->Sala; ?></td>
                            <td><?php echo $proyeccion->idPelicula; ?></td>
                            <td><?php echo $proyeccion->Fecha; ?></td>
                            <td><?php echo $proyeccion->Hora; ?></td>
                            <td><?php echo $proyeccion->Definicion_Tarifa; ?><input type='hidden' name='datos' value='<?php echo json_encode($proyeccion) ?>'></td>
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