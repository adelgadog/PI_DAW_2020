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
        <title>Admin: Actualizar Proyección</title>
        <link rel="stylesheet" href="../../styles/styleAdmin.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script>
            function goBack() {
                window.location.replace("adminProyeccion.php");
            }
        </script>
    </head>
    <body class="fondo">  
<?php

    if (empty($_POST["borrar"]) && empty($_POST["modificar"]) ) {
        header("Location: adminProyeccion.php?vacio=1");      
    } else {      

        $proyeccion= json_decode($_POST['datos']);
        require_once '../../scripts/db.php';
        $tarifas = DB::Get_Tarifas(); 
        $peliculas = DB::Get_Peliculas();        
        $salas = DB::Get_Salas();

        if (!empty($_POST["borrar"])) {    
?>
        <form action="upProyeccion.php" method="post">
            <table class="tablaAdminPelicula">
                <th class="tablaAdminPelicula_th" colspan=2><span>Confirmación de borrado de Proyección</span></th>
                <tr>
                    <td colspan=2><span>Borrar Proyección:</span></td>                            
                </tr>
                <tr>
                    <td><span>Título:</span></td>
                    <td><span>
                            <?php
                                foreach ($peliculas as $pelicula) {
                                       if($pelicula->id==$proyeccion->idPelicula){echo $pelicula->Titulo;} 
                                }
                            ?></span>
                    </td>        
                </tr>
                <tr>
                    <td><span>Fecha:</span></td>
                    <td><span><?php echo $proyeccion->Fecha; ?></span></td>        
                </tr>
                <tr>
                    <td><span>Hora:</span></td>
                    <td><span><?php echo $proyeccion->Hora; ?></span></td>        
                </tr>
                <tr>
                    <td><span>Sala:</span></td>
                    <td>
                    <span><?php echo $proyeccion->Sala; ?></span>     
                    <input type="hidden" id="id" name="id"  value='<?php echo $proyeccion->id; ?>'>                      
                    </td>        
                </tr>
                <tr>
                    <td><button onclick="goBack()">No</button></td>
                    <td><input type="submit" name="dellProyeccion" id="dellProyeccion" class="btn btn-warning" value="Borrar"></td>        
                </tr>                   
            </table>
        </form>
<?php  
        } else {
?>
        <form action="upProyeccion.php" method="post">
            <table class="tablaAdminPelicula">
                <th class="tablaAdminPelicula_th" colspan=2>Formulario de Modificación de Proyecciones</th>
                <tr>
                    <td><label>Sala:</label></td>
                    <td>
                        <select id="sala" name="sala">
                            <?php
                                foreach ($salas as $sala) {
                                    ?><option value="<?php echo $sala["idsala"]; ?>" <?php if($sala["idsala"]==$proyeccion->Sala){echo "selected";} ?>><?php echo "ID: ".$sala["idsala"]." Def: ".$sala["Tipo"]; ?></option>  <?php
                                }
                            ?>                    
                        </select>
                    </td>        
                </tr>
                <tr>
                    <td><label>Pelicula:</label></td>
                    <td>
                        <select id="peli" name="peli">
                            <?php
                                foreach ($peliculas as $pelicula) {
                                    ?><option value="<?php echo $pelicula->id; ?>"  <?php if($pelicula->id==$proyeccion->idPelicula){echo "selected";} ?>><?php echo $pelicula->Titulo; ?></option>  <?php
                                }
                            ?>  
                        </select>
                    </td>        
                </tr>
                <tr>
                    <td><label>Tarifa:</label></td>
                    <td>
                        <select id="tarifa" name="tarifa">
                            <?php
                                foreach ($tarifas as $tarifa) {
                                    ?><option value="<?php echo $tarifa["idTipo"]; ?>"  <?php if($tarifa["Definicion"]==$proyeccion->Definicion_Tarifa){echo "selected";} ?>><?php echo "ID: ".$tarifa["idTipo"]." Def: ".$tarifa["Definicion"]; ?></option>  <?php
                                }
                            ?> 
                        </select>
                    </td>        
                </tr>
                <tr>
                    <td><label>Fecha:</label></td>
                    <td><input type="date" id="fecha" name="fecha" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $proyeccion->Fecha; ?>"></td>        
                </tr>
                <tr>
                    <td><label>Hora:</label></td>
                    <td> <input type="time" id="hora" name="hora" value="<?php echo $proyeccion->Hora; ?>">
                    <input type='hidden' name='id' value='<?php echo $proyeccion->id; ?>'></td>        
                </tr>
                <tr>
                    <td><button onclick="goBack()">Volver</button></td>
                    <td><input type="submit" name="upProyeccion" id="upProyeccion" class="btn btn-primary" value="Añadir"></td>        
                </tr>
            </table>
        </form>
<?php
        }
    }    
?>   
</body>
</html>