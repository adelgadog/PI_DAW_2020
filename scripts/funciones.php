<?php
/**
 * Archivo de funciones PHP.
 * @author Andrés Delgado García <https://github.com/adelgadog/PI_DAW_2020>
 */ 
    /** Accedo a las funciones de BBDD.*/ 
    require_once 'db.php';

    /**
    * Aqui se gestionan las llamadas de Ajax desde los scripts JQUERY.
    * @author Andrés Delgado García <https://github.com/adelgadog/PI_DAW_2020>
    * 
    */
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
                registro_reserva($_POST['id'], $_POST['peli'], $_POST['butacas'], $_POST['proyeccion']);
                break; 
            case 'funcion6':
                revisa_mail($_POST['mail']);
                break;    
        }
    }
        
    /**
    * Función para identificar al usuario.
    *
    * @param string $mail 
    * @param string $pass 
    * @return string $usuario
    */

    function Identificarse($mail, $pass){
       $usuario= DB::Get_Usuario($mail, $pass);
       echo json_encode($usuario);      
    }       

    /**
    * Función para comprobar que el usuario existe en la base de datos.
    *
    * @param string $mail 
    * @return string $usuario
    */

    function revisa_mail($mail){
        $usuario= DB::revisa_mail($mail);
        echo json_encode($usuario);        
    }
        
    /**
    * Función para guardar un nuevo usuario en la BBDD.
    *
    * @param string $usr 
    * @param string $pass 
    * @param string $mail 
    * @return string $usuario
    */

    function registro_usuario($usr, $pass, $mail){
        $usuario= DB::Set_Usuario($usr, $pass, $mail);
        echo json_encode($usuario);      
    }
        
    /**
    * Función que retorna todos los elementos de la tabla peliculas.
    *
    * @return string $peliculas
    */
    function listado_Peliculas(){
        $peliculas= DB::Get_Peliculas();
        echo json_encode($peliculas);      
    }
                 
    /**
    * Función que retorna todos los elementos de la tabla proyecciones.
    *
    * @return string $proyecciones
    */
    function listado_proyecciones(){
        $proyecciones= DB::Get_Proyeccion();
        echo json_encode($proyecciones);      
    }
                     
    /**
    * Función que retorna todos los elementos de la tabla tarifas.
    *
    * @return array $tarifas
    */
    function Get_Tarifas(){
        $tarifas= DB::Get_Tarifas();
        return $tarifas;     
    }
                     
    /**
    * Función que retorna todos los elementos de la tabla peliculas.
    *
    * @return array $peliculas
    */
    function Get_Peliculas(){
        $peliculas= DB::Get_Peliculas();
        return $peliculas;     
    }
                     
    /**
    * Función que retorna los tres primeros elementos de la tabla peliculas.
    *
    * @return array $peliculas
    */
    function Get_Novedades(){
        $peliculas= DB::Get_Novedades();
        return $peliculas;     
    }
                     
    /**
    * Función que retorna todos los elementos de la tabla proyecciones.
    *
    * @return array $proyecciones
    */
    function Get_Proyeccion(){
        $proyeccion= DB::Get_Proyeccion();
        return $proyeccion;     
    }
                     
    /**
    * Función que registra una nueva reserva en la BBDD.
    *
    * @param int $id 
    * @param int $peli 
    * @param int $butacas 
    * @param int $proyeccion 
    * @return int $usuario
    */
    function registro_reserva($id, $peli, $butacas, $proyeccion){
        $usuario= DB::Set_Reserva($id, $peli, $butacas, $proyeccion);
        
        //$usuario=json_decode($id);
       // $proy=json_decode($proyeccion);
        //echo "id:".gettype ( $usuario ).", mail: ".$usuario->mail.", proyeccion:".gettype (  $proy );
        //echo json_encode($id);
        echo json_encode($usuario);      
    }
                     
    /**
    * Función que devuelve las reservas de un usuario para ser valoradas.
    *
    * @param int $iduser 
    * @return array $reservas
    */
    function Get_reservas($iduser){
        $reservas= DB::Get_Reservas($iduser);
        return $reservas;      
    }
                     
    /**
    * Función que devuelve todas las reservas de un usuario.
    *
    * @param int $iduser 
    * @return array $reservas
    */
    function Get_listaReservas($iduser){
        $reservas= DB::Get_listaReservas($iduser);
        return $reservas;      
    }
                     
    /**
    * Función que devuelve todos los datos de la tabla Usuarios.
    *
    * @return array $usuarios
    */
    function Get_Usuarios(){
        $usuarios= DB::Get_Usuarios();
        return $usuarios;      
    }
    /**
    * Función registra o actualiza la nota de una pelicula.
    *
    * @param int $usr 
    * @param int $peli 
    * @param int $nota 
    * @param int $nueva 
    * @return string $resultado
    */
    function Set_Nota($usr, $peli, $nota, $nueva){
        if ( $nueva==1) {
            $resultado= DB::Up_Nota($usr, $peli, $nota);
        } else if( $nueva==0)  {
            $resultado= DB::Set_Nota($usr, $peli, $nota);
        }        
        echo json_encode($resultado);      
    }

/**
* ¡¡¡ SCRIPT END !!!
*
*/ 
    
?>