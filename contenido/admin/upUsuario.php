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
    if (empty($_POST["upUsuario"]) && empty($_POST["dellUsuario"]) ) {
        header("Location: adminUsuarios.php?vacio=1");      
    }else{
        if (!empty($_POST["upUsuario"])) {        
            require_once '../../scripts/db.php';
               if ($_POST["admin"]==0) {
                   $admin=1;
               } else {
                   $admin=0;
               }
               
               $insert = DB::mod_Usuario($_POST["id"], $_POST["nombre"], $_POST["mail"], $_POST["admin"]);
               if ($insert==-1) {
                  header( "Location: adminUsuarios.php?accion=-1");
               } else {
                  header( "Location: adminUsuarios.php?accion=actualizado");
               }  
       } else {
            require_once '../../scripts/db.php';
            $insert = DB::Dell_Usuario($_POST["id"]);
            if ($insert==-1) {
                header( "Location: adminUsuarios.php?accion=-1");
            } else {
                header( "Location: adminUsuarios.php?accion=borrado");
            }    
       }
    }
   
    

?>