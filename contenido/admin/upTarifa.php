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

    if (empty($_POST["dellTarifa"]) && empty($_POST["upTarifa"]) ) {
        header("Location: adminTarifas.php?vacio=1");      
    } else {
        if (!empty($_POST["dellTarifa"])) {
            require_once '../../scripts/db.php';
            $insert = DB::Dell_Tarifa($_POST["id"]);
            if ($insert==-1) {
                header( "Location: adminTarifas.php?accion=-1");
            } else {
                header( "Location: adminTarifas.php?accion=1");
            }    
        } else {
            require_once '../../scripts/db.php';
            $insert = DB::updateTarifa($_POST["id"], $_POST["def"], $_POST["desc"], $_POST["precio"]);
            if ($insert==-1) {
                header( "Location: adminTarifas.php?accion=-1");
            } else {
                header( "Location: adminTarifas.php?accion=1");
            }        
        }
    }
    

?>