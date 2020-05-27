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
    if (!empty($_POST["addTarifa"])) {
        
        require_once '../../scripts/db.php';

        $insert = DB::SetTarifa($_POST["def"], $_POST["desc"], $_POST["precio"]);
        if ($insert==-1) {
           header( "Location: adminAddTarifa.php?accion=-1");
        } else {
            header( "Location: adminAddTarifa.php?accion=1");

        }     
                
    } else {
        header("Location: adminAddTarifa.php");
    }
    

?>