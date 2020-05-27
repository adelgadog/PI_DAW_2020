<?php

    require_once 'db.php';
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    if(isset($_POST['funcion']) && !empty($_POST['funcion'])) {
        $funcion = $_POST['funcion'];               
        switch($funcion) {
            case 'funcion1': 
                Identificarse($_POST['mail'], $_POST['pass']);
                break;
            case 'funcion2': 
                listado_Peliculas();                
                break;
            case 'funcion3':
                listado_proyecciones();
                break;
            case 'funcion4':
                registro_usuario($_POST['nombre'], $_POST['pass'], $_POST['mail']);
                break;   
            case 'funcion5':
                registro_reserva($_POST['id'], $_POST['butacas'], $_POST['proyeccion']);
                break; 
            case 'funcion6':
                revisa_mail($_POST['mail']);
                break;    
        }
    }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function Identificarse($mail, $pass){
       $usuario= DB::Get_Usuario($mail, $pass);
       echo json_encode($usuario);      
    }        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function revisa_mail($mail){
        $usuario= DB::revisa_mail($mail);
        echo json_encode($usuario);        
    }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function registro_usuario($usr, $pass, $mail){
        $usuario= DB::Set_Usuario($usr, $pass, $mail);
        echo json_encode($usuario);      
    }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function listado_Peliculas(){
        $peliculas= DB::Get_Peliculas();
        echo json_encode($peliculas);      
    }
                 
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function listado_proyecciones(){
        $proyecciones= DB::Get_Proyeccion();
        echo json_encode($proyecciones);      
    }
                     
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function Get_Tarifas(){
        $tarifas= DB::Get_Tarifas();
        return $tarifas;     
    }
                     
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function Get_Peliculas(){
        $peliculas= DB::Get_Peliculas();
        return $peliculas;     
    }
                     
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function Get_Novedades(){
        $peliculas= DB::Get_Novedades();
        return $peliculas;     
    }
                     
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function Get_Proyeccion(){
        $proyeccion= DB::Get_Proyeccion();
        return $proyeccion;     
    }
                     
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function registro_reserva($id, $butacas, $proyeccion){
        $usuario= DB::Set_Reserva($id, $butacas, $proyeccion);
        echo json_encode($usuario);      
    }
                     
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    function Get_reservas($iduser){
        $reservas= DB::Get_Reservas($iduser);
        return $reservas;      
    }
                     
    //////////////////////////////////////////////////////////////////////////


    
    //////////////////////////////////////////////////////////////////////////

    function Get_Usuarios(){
        $usuarios= DB::Get_Usuarios();
        return $usuarios;      
    }
    
?>