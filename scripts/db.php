<?php
    require_once 'conexion.php';
    class DB extends Conexion{

        //////////////////////////////////////////////////////////////////////////
        /*
        Función de ejecución de las sentencias SQL          
        */
        //////////////////////////////////////////////////////////////////////////
        
        public static function Ejecutar($sql){
            $conn = new Conexion(); 
            $result = $conn->prepare($sql);
            $result->execute();
            $conn=null;
            return $result;
         }

        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////        

        public static function Get_Usuario($mail, $pass){
            $sql = "SELECT * FROM usuario WHERE Mail='".$mail."' AND Psw='".$pass."'";
            $result = DB::Ejecutar($sql);  
            if ($result->rowCount()>0) {    
                require_once 'usuario.php';
                $objeto = $result->fetch(PDO::FETCH_ASSOC);                  
                $usuario = new Usuario($objeto["idCliente"], $objeto["Nombre"], $objeto["Mail"], $objeto["Admin"]);  
                return $usuario;  
            } else {
                return -1;
            }         
        }

        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////        

        public static function Set_Usuario($usr, $pass, $mail){            
            $sql = "INSERT INTO `usuario`(`Nombre`, `Mail`, `Psw`,`Admin`) VALUES (?,?,?,?)";
            $conn = new Conexion(); 
            try {
                $stmt= $conn->prepare($sql);
                $stmt->execute([$usr, $mail, $pass, 0]);
            } catch (PDOException $e) {
                return -1;
            }              
            $usuario = Get_Usuario($mail, $pass);  
            return $usuario;
        }

        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

        public static function Get_Peliculas(){
            $sql = "SELECT * FROM pelicula";
            $result = DB::Ejecutar($sql);  
            if ($result->rowCount()>0) {    
                $peliculas = $result->fetchAll(PDO::FETCH_ASSOC);  
                $lista_peliculas=DB::Get_Valoraciones($peliculas);                
                return $lista_peliculas;
            } else {
                return -1;
            }         
        }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////
        
        public static function Get_Valoraciones($peliculas){
            require_once 'pelicula.php';
            foreach ($peliculas as $pelicula) {
                $id=$pelicula["idPelicula"];
                $sql = "SELECT AVG(Valoración) AS media FROM valoración WHERE idPelicula='".$id."'";
                $result = DB::Ejecutar($sql);
                if ($result->rowCount()>0) {    
                    $media = $result->fetch(PDO::FETCH_ASSOC)['media'];
                    $Peli= new Pelicula ($pelicula["idPelicula"], $pelicula["Título"], $pelicula["País"], $pelicula["Género"], $pelicula["Año"], $pelicula["Duración"], $pelicula["Fecha de Estreno"], $pelicula["Calificación"], $pelicula["Sinopsis"], $media,  $pelicula["Cartel"],  $pelicula["Video"]);  
                    $lista_peliculas[]=$Peli;
                }
            }
            if (isset($lista_peliculas)) {   
                return $lista_peliculas;
            } /*else {
                return -1;
            }  */     
        }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

        public static function Get_Proyeccion(){
            $sql = "SELECT * FROM proyeccion";
            $result = DB::Ejecutar($sql);
            if ($result->rowCount()>0) {    
                $proyecciones = $result->fetchAll(PDO::FETCH_ASSOC);                  
                //return $proyecciones;                
                $lista_proyecciones=DB::Get_Datos($proyecciones); 
                return $lista_proyecciones;
            } else {
                return -1;
            }         
        }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

        public static function Get_Datos($proyecciones){
            require_once 'proyecciones.php';
            foreach ($proyecciones as $proyeccion) {

                $sql = "SELECT * FROM sala WHERE idsala='".$proyeccion["IdSala"]."'";
                $result = DB::Ejecutar($sql);                
                $fila=$result->fetch(PDO::FETCH_ASSOC);  
                $sala=$fila['Tipo'];
                $butacas=$fila['Butacas'];

                $sql = "SELECT * FROM tarifa WHERE idTipo='".$proyeccion["idTipo"]."'";
                $result2 = DB::Ejecutar($sql);   
                $fila2=$result2->fetch(PDO::FETCH_ASSOC);             
                $tipo=$fila2['Definicion'];
                $precio=$fila2['Precio'];

                $sql = "SELECT SUM(Butacas) AS sumatorio FROM reserva WHERE idProyección='".$proyeccion["idProyeccion"]."'";
                $result3 = DB::Ejecutar($sql);                
                $disponibles=$butacas-$result3->fetch(PDO::FETCH_ASSOC)['sumatorio'];
                
                $Proy= new Proyeccion ($proyeccion["idProyeccion"], $sala, $proyeccion["idPelicula"], $tipo, $proyeccion["Fecha"], $proyeccion["Hora"], $butacas, $precio, $disponibles);
                $lista_proyeccion[]=$Proy;
                
            }
            if (isset($lista_proyeccion)) {   
                return $lista_proyeccion;
            } /*else {
                return -1;
            }  */     
        }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

        public static function Get_Tarifas(){
            $sql = "SELECT * FROM tarifa";
            $result = DB::Ejecutar($sql);  
            if ($result->rowCount()>0) {    
                $tarifas = $result->fetchAll(PDO::FETCH_ASSOC);                
                return $tarifas;
            } else {
                return -1;
            }         
        }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

        public static function Set_Reserva($id, $butacas, $proyeccion){        
            $sql = "INSERT INTO `reserva`(`idUsuario`, `idProyección`, `Butacas`) VALUES (?,?,?)";
            $conn = new Conexion(); 
            try {
                $stmt= $conn->prepare($sql);
                $stmt->execute([$id, $proyeccion, $butacas]);
            } catch (PDOException $e) {
                return -1;
            }  
        }
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

    }
?>