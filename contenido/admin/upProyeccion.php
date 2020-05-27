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
    if (!empty($_POST["upProyeccion"])) {
        
        require_once '../../scripts/db.php';

        $insert = DB::updateProyeccion($_POST["id"], $_POST["sala"], $_POST["peli"], $_POST["tarifa"], $_POST["fecha"], $_POST["hora"]);
        if ($insert==-1) {

           header( "Location: adminProyeccion.php?accion=-1");

        } else {
            header( "Location: adminProyeccion.php?accion=1");

        }        
    } else {
        header("Location: adminProyeccion.php");
    }
    

?>