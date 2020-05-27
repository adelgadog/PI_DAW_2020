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
    if (!empty($_POST["addPelicula"])) {
        
        require_once '../../scripts/db.php';

        $insert = DB::SetPelicula($_POST["año"], $_POST["titulo"], $_POST["pais"], $_POST["genero"], $_POST["duracion"], $_POST["estreno"], $_POST["calificacion"], $_POST["sinopsis"], $_POST["cartel"], $_POST["video"]);

        if ($insert==-1) {
           header( "Location: adminAddPelicula.php?accion=-1");

        } else {
            header( "Location: adminAddPelicula.php?accion=1");

        }        
    } else {
        header("Location: adminAddPelicula.php");
    }
    

?>