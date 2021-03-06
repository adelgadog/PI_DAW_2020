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
    
    require_once '../../scripts/db.php';
    $tarifas = DB::Get_Tarifas();    

    $peliculas = DB::Get_Peliculas();

    $salas = DB::Get_Salas();
    //$sala["idsala"] $sala["Tipo"] $sala["Butacas"]

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Añadir Proyecciones</title>
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
<form action="addProyeccion.php" method="post">
    <table class="tablaAdminPelicula">
        <th class="tablaAdminPelicula_th" colspan=2>Formulario de Proyecciones</th>
        <tr>
            <td><label>Sala:</label></td>
            <td>
                <select id="sala" name="sala">
                    <?php
                        foreach ($salas as $sala) {
                            ?><option value="<?php echo $sala["idsala"]; ?>"><?php echo "ID: ".$sala["idsala"]." Def: ".$sala["Tipo"]; ?></option>  <?php
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
                            ?><option value="<?php echo $pelicula->id; ?>"><?php echo $pelicula->Titulo; ?></option>  <?php
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
                            ?><option value="<?php echo $tarifa["idTipo"]; ?>"><?php echo "ID: ".$tarifa["idTipo"]." Def: ".$tarifa["Definicion"]; ?></option>  <?php
                        }
                    ?> 
                </select>
            </td>        
        </tr>
        <tr>
            <td><label>Fecha:</label></td>
            <td><input type="date" id="fecha" name="fecha" min="<?php echo date("Y-m-d"); ?>"></td>        
        </tr>
        <tr>
            <td><label>Hora:</label></td>
            <td> <input type="time" id="hora" name="hora"></td>        
        </tr>
        <tr>
            <td><button onclick="goBack()">Volver</button></td>
            <td><input type="submit" name="addProyeccion" id="addProyeccion" class="btn btn-primary" value="Añadir"></td>        
        </tr>
    </table>
    </form>
</body>
</html>