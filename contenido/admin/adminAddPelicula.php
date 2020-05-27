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
    <form action="addPelicula.php" method="post">
        <table class="tablaAdminPelicula">
            <th class="tablaAdminPelicula_th" colspan=2><span>Formulario de Películas</span></th>
            <tr>
                <td><label>Título:</label></td> <label for=""></label>
                <td><input type="text" id="titulo" name="titulo"  placeholder="" autofocus></td>        
            </tr>
            <tr>
                <td><label>Año:</label></td>
                <td><input type="text" id="año" name="año"  placeholder=""></td>        
            </tr>
            <tr>
                <td><label>País:</label></td>
                <td><input type="text" id="pais" name="pais"  placeholder=""></td>        
            </tr>
            <tr>
                <td><label>Género:</label></td>
                <td><input type="text" id="genero" name="genero"  placeholder=""></td>        
            </tr>
            <tr>
                <td><label>Duración:</label></td>
                <td><input type="text" id="duracion" name="duracion"  placeholder=""></td>        
            </tr>
            <tr>
                <td><label>Estreno:</label></td>
                <td><input type="text" id="estreno" name="estreno"  placeholder=""></td>        
            </tr>
            <tr>
                <td><label>Calificación:</label></td>
                <td><input type="text" id="calificacion" name="calificacion"  placeholder=""></td>        
            </tr>
            <tr>
                <td><label>Sinopsis:</label></td>
                <td><textarea id="sinopsis" name="sinopsis" rows="6" cols="20"></textarea></td>        
            </tr>
            <tr>
                <td><label>Cartel:</label></td>
                <td><input type="text" id="cartel" name="cartel"  placeholder=""></td>        
            </tr>
            <tr>
                <td><label>Vídeo:</label></td>
                <td><input type="text" id="video" name="video"  placeholder=""></td>        
            </tr>
            <tr>
                <td><button onclick="goBack()">Volver</button></td>
                <td><input type="submit" name="addPelicula" id="addPelicula" class="btn btn-primary" value="Añadir"></td>        
            </tr>
        </table>
    </form>
   
</body>
</html>