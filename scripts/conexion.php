<?php
/**
 * Archivo de clase Conexión.
 */ 

    /**
     * Class que realiza la conexión mediante PDO al servidor MySQL.
     * @author Andrés Delgado García <https://github.com/adelgadog/PI_DAW_2020>
     */  
   class Conexion extends PDO {

      /** @var string $datos Cadena de datos requeridos para realizar la conexión a PDO */
      private $datos = "mysql:host=localhost;dbname=cine;charset=utf8mb4";
      /** @var string $usuario Usuario de acceso a la BBDD */
      private $usuario = "adminCine";
      /** @var string $pass Contraseña de acceso a la BBDD*/
      private $pass = "adminCine"; 


      /**
       * Función constructor que realiza la conexión mediante la clase de la que hereda, PDO.
      *
      */
      public function __construct(){
         try{
            parent::__construct($this->datos, $this->usuario, $this->pass);
         }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
         } 
      }      
   }  
?>