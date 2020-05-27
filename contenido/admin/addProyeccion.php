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
    if (!empty($_POST["addProyeccion"])) {
        
        require_once '../../scripts/db.php';

        $insert = DB::SetProyeccion($_POST["sala"], $_POST["peli"], $_POST["tarifa"], $_POST["fecha"], $_POST["hora"]);

        if ($insert==-1) {
           header( "Location: adminAddProyeccion.php?accion=-1");

        } else {
            header( "Location: adminAddProyeccion.php?accion=1");

        }     
        
      /*  echo "Sala: ".$_POST["sala"];
        echo "Pelicula: ".$_POST["peli"];
        echo "Tarifa: ".$_POST["tarifa"];
        echo "Fecha: ".$_POST["fecha"];
        echo "Hora: ".$_POST["hora"];*/
        
    } else {
        header("Location: adminAddProyeccion.php");
    }
    

?>