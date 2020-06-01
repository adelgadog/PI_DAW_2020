<?php
    if (isset($_POST["contactoUser"]) && isset($_POST["contactoMail"]) && isset($_POST["contactoMensaje"])) {
        $to = "cines.la.claqueta.rota@gmail.com";
        $subject = "Mensaje Web de Usuario";
        $message = "Mensaje enviado a traves de contacto Web.\n
                    Usuario: ".$_POST["contactoUser"]."\n
                    Correo del usuario: ".$_POST["contactoMail"]."\n
                    Mensaje: ".$_POST["contactoMensaje"]."\n
                    Hora del envio: ".date("Y-m-d")."\n
                    \n
                    ";
        $headers = "From: cines.la.claqueta.rota@gmail.com" ;
        
        //ini_set("SMTP", "mail.laclaquetarota.com");
        //ini_set("sendmail_from", "cines.la.claqueta.rota@gmail.com");
        mail($to, $subject, $message, $headers);

        header( "Location: contacto.php?enviado=true");

    } else {        
        header( "Location: contacto.php");
    }
    

?>