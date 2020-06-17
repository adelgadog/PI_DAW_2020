<?php
/**
 * Archivo con la clase de acceso a la BBDD.
 */ 
    /** Accedo a Conexión.*/ 
    require_once 'conexion.php';

    /**
    * Class que contiene todas las funciones de interaccion con la BBDD.
    * @author Andrés Delgado García <https://github.com/adelgadog/PI_DAW_2020>
    */     
    class DB extends Conexion{

        /**
        * Función de ejecución de las sentencias SQL.
        *
        * @param string $sql 
        * @return mixed $result
        */

        public static function Ejecutar($sql){
            $conn = new Conexion(); 
            $result = $conn->prepare($sql);
            $result->execute();
            $conn=null;
            return $result;
         }  

        /**
        * Función para obtener un usuario ya registrado de la BBDD.
        * Retorna un objeto Usuario.
        *
        * @param string $mail     Correo del usuario
        * @param string $pass     Contraseña del usuario
        * @return \object|\int $usuario / -1
        */

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

        /**
        * Esta función comprueba que el correo introducido en el registro 
        * no se encuentre ya guardado en la BBDD.
        *
        * @param string $mail
        * @return int 1 / -1
        */     

        public static function revisa_mail($mail){
            $sql = "SELECT * FROM usuario WHERE Mail='".$mail."'";
            $result = DB::Ejecutar($sql);  
            if ($result->rowCount()>0) {    
                return 1; 
            } else {
                return -1;
            }         
        }  

        /**
        * Función para registrar un nuevo usuario en la BBDD.
        *
        * @param string $usr
        * @param string $pass
        * @param string $mail
        * @return \object|\Integer $usuario / -1
        */         

        public static function Set_Usuario($usr, $pass, $mail){            
            $sql = "INSERT INTO `usuario`(`Nombre`, `Mail`, `Psw`,`Admin`) VALUES ('".$usr."','".$mail."','".$pass."','0')";
            $result = DB::Ejecutar($sql);  
            if ($result) {    
                $usuario = DB::Get_Usuario($mail, $pass);  
                return $usuario;
            } else {
                return -1;
            }               
        }

        /**
        * Función para obtener la lista de peliculas almacenadas en la BBDD
        *
        * @return \array|\int $lista_peliculas / -1
        */   

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

        /**
        * Función para recoger las tres ultias peliculas añadidas a la BBDD
        * para mostrarlas en la pagina de Inicio.
        *
        * @return \array|\int $lista_peliculas / -1
        */ 

        public static function Get_Novedades(){
            $sql = "SELECT * FROM pelicula ORDER BY idPelicula DESC LIMIT 3";
            $result = DB::Ejecutar($sql);  
            if ($result->rowCount()>0) {    
                $peliculas = $result->fetchAll(PDO::FETCH_ASSOC);  
                $lista_peliculas=DB::Get_Valoraciones($peliculas);                
                return $lista_peliculas;
            } else {
                return -1;
            }         
        }

        /**
        * Función para obtener las valoraciones de cada cada pelicula.
        * Retorna un array de objetos Peliculas.
        *
        * @param array $peliculas
        * @return \Array|\Integer $lista_peliculas / -1
        */        

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
            }else{
                return -1;
            }       
        }

        /**
        * Función para obtener las proyecciones que se encuentran en la BBDD.
        *
        * @param int $indice
        * @return \Array|\Integer $lista_proyecciones / -1
        */ 

        public static function Get_Proyeccion($indice=""){
            $sql = "SELECT * FROM proyeccion ".$indice;
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

        /**
        * Función para recopilar los distintos datos de cada proyección.
        * Retorna un array de objetos Proyeccion.
        *
        * @param array $proyecciones
        * @return \Array|\Integer $lista_proyeccion / -1
        */ 

        public static function Get_Datos($proyecciones){
            require_once 'proyecciones.php';
            foreach ($proyecciones as $proyeccion) {

                $sql = "SELECT * FROM sala WHERE idsala='".$proyeccion["IdSala"]."'";
                $result = DB::Ejecutar($sql);                
                $fila=$result->fetch(PDO::FETCH_ASSOC);  
                $sala=$fila['idsala'];
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
            } else {
                return -1;
            }     
        }

        /**
        * Función para obtener las tarifas que se encuentran en la BBDD.
        *
        * @return \array|\int $tarifas / -1
        */ 

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

        /**
        * Función para registrar en la BBDD una reserva realizada por un usuario.
        *
        * @param string $id
        * @param string $peli
        * @param int $butacas
        * @param int $proy
        * @return int $result
        */ 

        public static function Set_Reserva($id, $peli, $butacas, $proy){   
            $usuario=json_decode($id);
            $proyeccion=json_decode($proy);
            $userId=$usuario->id;
            $proyec=$proyeccion->id;
            $fecha=$proyeccion->Fecha;
            $hora=$proyeccion->Hora;
            $tarifa=$proyeccion->Definicion_Tarifa;
            $precio=$proyeccion->Precio;
            $total=$precio*$butacas;
            $sql = "INSERT INTO `reserva`(`idUsuario`, `idProyección`, `Butacas`) VALUES ('".$userId."','".$proyec."','".$butacas."')";
            $result = DB::Ejecutar($sql); 
            
            // Codigo para enviar correos desde la pagina.

            if($result) {
                $to = $usuario->mail;
                $subject = "Entradas de Cine La Claqueta Rota";
                $message = "Gracias por comprar en Cine La Claqueta Rota.\n
                            Le enviamos este correo para confirmar su compra de entradas:\n
                            Titulo de la pelicula: ".$peli."\n
                            Dia: ".$fecha."\n
                            Hora: ".$hora."\n
                            Tipo de Tarifa: ".$tarifa."\n
                            Precio por Entrada: ".$precio."\n
                            Total de Entradas: ".$butacas."\n
                            Coste Total: ".$total."\n
                            \n
                            Gracias por confiar en nosotros y que disfrute de la Pelicula.\n
                            ";
                $headers = "From: sitosys@gmail.com" ;
                mail($to, $subject, $message, $headers);
                //cines.la.claqueta.rota@gmail.com
                //claqueta19-20
                //znrpfwyuulpxfusv
            }
            return $result; 
        }

        /**
        * Función que devuelve la información de todas las reservas realizadas
        * por un usuario, asi como su valoración de la pelicula asociada 
        * (si la hubiera), y la fecha de la proyección que reservo.
        * Todo esto se ordena por fecha y se retiran las peliculas duplicadas,
        * para que el usuario puede asignarle una nota de valoración ó modificar
        * la que ya le asigno.
        *
        * @param int $iduser
        * @return \array|\int $valoraciones / -1
        */ 

        public static function Get_Reservas($iduser){
            
            $sql = "SELECT `reserva`.`idReserva`, `reserva`.`idUsuario`, `proyeccion`.`Fecha`, `proyeccion`.`Hora`, 
            `pelicula`.`idPelicula`, `pelicula`.`Título`, `pelicula`.`Cartel` 
            FROM `reserva` 
            INNER JOIN `proyeccion` ON `reserva`.`idProyección`=`proyeccion`.`idProyeccion` 
            INNER JOIN `pelicula` ON `proyeccion`.`idPelicula`=`pelicula`.`idPelicula`       
            WHERE `reserva`.`idUsuario`='".$iduser."'";
            $result = DB::Ejecutar($sql);
            if ($result->rowCount()>0) {    
                require_once 'valor.php';
                $reservas = $result->fetchAll(PDO::FETCH_ASSOC);                  
                foreach ($reservas as $reserva) {
                    $voto = DB::Get_Valoracion($reserva["idUsuario"], $reserva["idPelicula"]);
                    $valoracion = new Valoracion($reserva["idReserva"], $reserva["idUsuario"], $reserva["Hora"], $reserva["idPelicula"], $reserva["Fecha"], $reserva["Título"], $reserva["Cartel"], $voto);
                    if (isset($valoraciones)) {                             
                        $libre=true;                    
                        foreach ($valoraciones as $valorada) {
                            if ($valorada->pelicula==$valoracion->pelicula) {                                 
                                $libre=false;
                                if ($valorada->fecha>$valoracion->fecha) {
                                    $valorada->Modificar_Fecha($valoracion->fecha);
                                } 
                            }                        
                        }                         
                        if($libre){
                            $valoraciones[]= $valoracion;  
                        } 
                    } else {  
                        $valoraciones[]= $valoracion;
                    }
                }
                return $valoraciones;
            } else {
                return -1;
            }         
        }

        /**
        * Función que devuelve la información de todas las reservas realizadas
        * por un usuario, asi como su valoración de la pelicula asociada 
        * (si la hubiera), y la fecha de la proyección que reservo.
        * Estaran ordenadas por fecha y hora.
        *
        * @param int $iduser
        * @return \array|\int $valoraciones / -1
        */ 

        public static function Get_listaReservas($iduser){
            
            $sql = "SELECT `reserva`.`idReserva`, `reserva`.`idUsuario`, `proyeccion`.`Fecha`, `proyeccion`.`Hora`, 
            `pelicula`.`idPelicula`, `pelicula`.`Título`, `pelicula`.`Cartel` 
            FROM `reserva` 
            INNER JOIN `proyeccion` ON `reserva`.`idProyección`=`proyeccion`.`idProyeccion` 
            INNER JOIN `pelicula` ON `proyeccion`.`idPelicula`=`pelicula`.`idPelicula`       
            WHERE `reserva`.`idUsuario`='".$iduser."'
            ORDER BY `proyeccion`.`Fecha`, `proyeccion`.`Hora`";
            $result = DB::Ejecutar($sql);
            if ($result->rowCount()>0) {    
                require_once 'valor.php';
                $reservas = $result->fetchAll(PDO::FETCH_ASSOC);                  
                foreach ($reservas as $reserva) {
                    $voto = DB::Get_Valoracion($reserva["idUsuario"], $reserva["idPelicula"]);
                    $valoracion = new Valoracion($reserva["idReserva"], $reserva["idUsuario"], $reserva["Hora"], $reserva["idPelicula"], $reserva["Fecha"], $reserva["Título"], $reserva["Cartel"], $voto);
                    $valoraciones[]= $valoracion;
                }
                return $valoraciones;
            } else {
                return -1;
            }         
        }

        /**
        * Recupera la valoración asignada por un usuario a una pelicula 
        * concreta.
        *
        * @param int $usuario
        * @param int $pelicula
        * @return int $valor / -1
        */ 
        
        public static function Get_Valoracion($usuario, $pelicula){
            $sql = "SELECT `Valoración` FROM `valoración` WHERE `idUsuario`='".$usuario."' AND `idPelicula`='".$pelicula."'";
            $result = DB::Ejecutar($sql);
            if ($result->rowCount()>0) {    
                $valor = $result->fetch(PDO::FETCH_ASSOC)['Valoración'];
                return $valor;
            } else {
                return -1;
            }     
        }

        /**
        * Guarda en la BBDD un nuevo registro de pelicula.
        *
        * @param int $año
        * @param string $titulo
        * @param string $pais
        * @param string $genero
        * @param string $duracion
        * @param string $estreno
        * @param string $calificacion
        * @param string $sinopsis
        * @param string $cartel
        * @param string $video
        * @return int 1 / -1
        */ 
        
        public static function SetPelicula($año, $titulo, $pais, $genero, $duracion, $estreno, $calificacion, $sinopsis, $cartel, $video){
            $sql = "INSERT INTO `pelicula`
            (`Año`, `Título`, `País`, `Género`, `Duración`, `Fecha de Estreno`, `Calificación`, `Sinopsis`, `Cartel`, `Video`)
            VALUES ('".$año."','".$titulo."','".$pais."','".$genero."','".$duracion."','".$estreno."','".$calificacion."','".$sinopsis."','".$cartel."','".$video."')";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Recupera todos los datos de la Tabla Salas.
        *
        * @return \array|\int $sala / -1
        */ 

        public static function Get_Salas(){
            $sql = "SELECT * FROM sala";
            $result = DB::Ejecutar($sql);  
            if ($result->rowCount()>0) {    
                $sala = $result->fetchAll(PDO::FETCH_ASSOC);                
                return $sala;
            } else {
                return -1;
            }         
        }

        /**
        * Guarda en la BBDD un nuevo registro de Proyección.
        *
        * @param int $sala
        * @param int $peli
        * @param int $tarifa
        * @param string $fecha
        * @param string $hora
        * @return int 1 / -1
        */ 

        public static function SetProyeccion($sala, $peli, $tarifa, $fecha, $hora){
            $sql = "INSERT INTO `proyeccion`(`IdSala`, `idPelicula`, `idTipo`, `Fecha`, `Hora`)
            VALUES ('".$sala."','".$peli."','".$tarifa."','".$fecha."','".$hora."')";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Guarda en la BBDD un nuevo registro de Tarífa.
        *
        * @param string $def
        * @param string $desc
        * @param float $precio
        * @return int 1 / -1
        */ 

        public static function SetTarifa($def, $desc, $precio){
            $sql = "INSERT INTO `tarifa`(`Definicion`, `Descripcion`, `Precio`)
            VALUES ('".$def."','".$desc."','".$precio."')";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Función que elimina de la BBDD un registro de pelicula. 
        * Al tener esta tabla varias asociaciones a traves de su PK, todas
        * los demas registros deben ser borrados antes de borar de la propia
        * tabla peliculas. Estas tablas asociadas son: Valoración, Reserva y
        * Proyección. Una vez se han borrado todas las referencias a una
        * pelicula, esta puede ser borrada de la tabla Peliculas.
        *
        * @param int $id
        * @return int 1 / -1
        */ 

        public static function Dell_Pelicula($id){
            $sql1 = "DELETE FROM `valoración` WHERE `idPelicula`='".$id."'";
            $result1 = DB::Ejecutar($sql1);  
            $sql2 = "DELETE FROM `reserva` WHERE `idProyección` IN (SELECT `idProyeccion` FROM `proyeccion` WHERE `idPelicula`='".$id."')";
            $result2 = DB::Ejecutar($sql2);  
            $sql3 = "DELETE FROM `proyeccion` WHERE `idPelicula`='".$id."'";
            $result3 = DB::Ejecutar($sql3);  
            $sql = "DELETE FROM `pelicula` WHERE `idPelicula`='".$id."'";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Actualiza la informacion de una pelicula en la Tabla Peliculas.
        *
        * @param int $id
        * @param int $año
        * @param string $titulo
        * @param string $pais
        * @param string $genero
        * @param string $duracion
        * @param string $estreno
        * @param string $calificacion
        * @param string $sinopsis
        * @param string $cartel
        * @param string $video
        * @return int 1 / -1
        */ 
        
        public static function updatePelicula($id, $año, $titulo, $pais, $genero, $duracion, $estreno, $calificacion, $sinopsis, $cartel, $video){
            $sql ="UPDATE `pelicula` SET 
            `Año`='".$año."',`Título`='".$titulo."',`País`='".$pais."',`Género`='".$genero."',
            `Duración`='".$duracion."',`Fecha de Estreno`='".$estreno."',`Calificación`='".$calificacion."',
            `Sinopsis`='".$sinopsis."',`Cartel`='".$cartel."',`Video`='".$video."' 
            WHERE `idPelicula`='".$id."'";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Función que elimina de la BBDD un registro de tarifa. 
        * Al tener esta tabla varias asociaciones a traves de su PK, todas
        * los demas registros deben ser borrados antes de borar de la propia
        * tabla Tarifas. Estas tablas asociadas son: Reserva y
        * Proyección. Una vez se han borrado todas las referencias a una
        * tarifa, esta puede ser borrada de la tabla Tarifas.
        *
        * @param int $id
        * @return int 1 / -1
        */ 

        public static function Dell_Tarifa($id){
            $sql1 = "DELETE FROM `reserva` WHERE `idProyección` IN (SELECT `idProyeccion` FROM `proyeccion` WHERE `idTipo`='".$id."')";
            $result1 = DB::Ejecutar($sql1);  
            $sql2 = "DELETE FROM `proyeccion` WHERE `idTipo`='".$id."'";
            $result2 = DB::Ejecutar($sql2);  
            $sql = "DELETE FROM `tarifa` WHERE `idTipo`='".$id."'";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Actualiza la informacion de una tarífa en la Tabla Tarífas.
        *
        * @param int $id
        * @param string $def
        * @param string $desc
        * @param float $precio
        * @return int 1 / -1
        */ 
        
        public static function updateTarifa($id, $def, $desc, $precio){
            $sql ="UPDATE `tarifa` SET 
            `Definicion`='".$def."',`Descripcion`='".$desc."',`Precio`='".$precio."' 
            WHERE `idTipo`='".$id."'";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Función que elimina de la BBDD un registro de proyección. 
        * Al tener esta tabla varias asociaciones a traves de su PK, todas
        * los demas registros deben ser borrados antes de borar de la propia
        * tabla Proyecciones. Estas tabla asociada es: Reserva. 
        * Una vez se ha borrado esta referencia a una
        * proyección, esta puede ser borrada de la tabla Proyecciones.
        *
        * @param int $id
        * @return int 1 / -1
        */ 

        public static function Dell_Proyeccion($id){         
            $sql1 = "DELETE FROM `reserva` WHERE `idProyección`='".$id."'";
            $result1 = DB::Ejecutar($sql1);  
            $sql = "DELETE FROM `proyeccion` WHERE `idProyeccion`='".$id."'";
            $result = DB::Ejecutar($sql);   
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Actualiza la informacion de una proyección en la Tabla Proyecciones.
        *
        * @param int $id
        * @param int $sala
        * @param int $peli
        * @param int $tarifa
        * @param string $fecha
        * @param string $hora
        * @return int 1 / -1
        */ 
        
        public static function updateProyeccion($id, $sala, $peli, $tarifa, $fecha, $hora){
            $sql ="UPDATE `proyeccion` SET 
            `IdSala`='".$sala."',`idPelicula`='".$peli."',`idTipo`='".$tarifa."',`Fecha`='".$fecha."',`Hora`='".$hora."' 
            WHERE `idProyeccion`='".$id."'";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        } 

        /**
        * Función que devuelve todos los datos de la tabla Usuarios.
        *
        * @return \array|\int $usuario / -1
        */      

        public static function Get_Usuarios(){
            $sql = "SELECT * FROM usuario";
            $result = DB::Ejecutar($sql);  
            if ($result->rowCount()>0) {    
                require_once 'usuario.php';
                while($objeto = $result->fetch(PDO::FETCH_ASSOC)){
                    $usuario[] = new Usuario($objeto["idCliente"], $objeto["Nombre"], $objeto["Mail"], $objeto["Admin"]); 
                } 
                return $usuario;  
            } else {
                return -1;
            }         
        }

        /**
        * Función que elimina de la BBDD un registro de usuario. 
        * Al tener esta tabla varias asociaciones a traves de su PK, todas
        * los demas registros deben ser borrados antes de borar de la propia
        * tabla Usuarios. Estas tabla asociada es: Valoraciones y Reservas. 
        * Una vez se ha borrado estas referencias a un
        * usuario, este puede ser borrado de la tabla Usuarios.
        *
        * @param int $id
        * @return int 1 / -1
        */ 
        
        public static function Dell_Usuario($id){
            $sql = "DELETE FROM `usuario` WHERE `idCliente`='".$id."'";
            $nota = DB::Dell_Nota($id);
            $reserva= DB::Dell_Reservas($id);
            if ($nota==1 && $reserva==1) {
                $result = DB::Ejecutar($sql); 
            }            
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Función que elimina todos los registros asociados con un usuario
        * de la tabla Reservas.  
        *
        * @param int $id
        * @return int 1 / -1
        */ 
        
        public static function Dell_Reservas($id){            
            $sql1 = "SELECT * FROM `reserva` WHERE `idUsuario`='".$id."'";
            $result1 = DB::Ejecutar($sql1); 
            if ($result1->rowCount()>0) { 
                $sql = "DELETE FROM `reserva` WHERE `idUsuario`='".$id."'";
                $result = DB::Ejecutar($sql);
            } else {               
                return 1; 
            }    
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Función que elimina todos los registros asociados con un usuario
        * de la tabla Valoración. 
        *
        * @param int $id
        * @return int 1 / -1
        */ 
        
        public static function Dell_Nota($id){
            $sql1 = "SELECT * FROM `valoración` WHERE `idUsuario`='".$id."'";
            $result1 = DB::Ejecutar($sql1); 
            if ($result1->rowCount()>0) {                
                $sql = "DELETE FROM `valoración` WHERE `idUsuario`='".$id."'";
                $result = DB::Ejecutar($sql);  
            } else {                
                return 1; 
            }            
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Función que modifica cualquier campo de la tabla Usuario a excepción
        * del campo contraseña.
        *
        * @param int $id
        * @param string $nombre
        * @param string $mail
        * @param string $admin
        * @return int 1 / -1
        */ 
        
        public static function mod_Usuario($id, $nombre, $mail, $admin){
            $sql ="UPDATE `usuario` SET `Nombre`='".$nombre."',`Mail`='".$mail."', `Admin`='".$admin."' WHERE `idCliente`='".$id."'";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Función que actualiza la nota ya asignada por un usuario concreto a
        * una pelicula concreta.
        *
        * @param int $usr
        * @param int $peli
        * @param float $nota
        * @return int 1 / -1
        */ 
        
        public static function Up_Nota($usr, $peli, $nota){
            $sql ="UPDATE `valoración` SET `Valoración`='".$nota."' WHERE `idUsuario`='".$usr."' AND `idPelicula`='".$peli."'";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * Función que asigna una nota a una pelicula concreta por un usuario concreto.
        *
        * @param int $usr
        * @param int $peli
        * @param float $nota
        * @return int 1 / -1
        */ 
        
        public static function Set_Nota($usr, $peli, $nota){
            $sql ="INSERT INTO `valoración`(`idUsuario`, `idPelicula`, `Valoración`) VALUES ('".$usr."','".$peli."','".$nota."')";
            $result = DB::Ejecutar($sql);  
            if ($result) {  
                return 1; 
            } else {
                return -1;
            }   
        }

        /**
        * ¡¡¡ SCRIPT END !!!
        *
        */ 

    }
?>