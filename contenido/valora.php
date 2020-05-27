<?php
    if (isset($_POST["poner_nota"])) {
        
        require_once '../scripts/funciones.php';
       $resultado= Set_Nota($_POST["usuario"], $_POST["peli"], $_POST["nota"], $_POST["nueva"]);
        header( "Location: valoracion.php");
    } else {        
        header( "Location: valoracion.php");
    }
    

?>