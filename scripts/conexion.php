<?php
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

   class Conexion extends PDO {
      private $datos = "mysql:host=localhost;dbname=cine;charset=utf8mb4";
      private $usuario = "adminCine";
      private $pass = "adminCine"; 
      public function __construct(){
         try{
            parent::__construct($this->datos, $this->usuario, $this->pass);
         }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
         } 
      }      
   }  
        
        //////////////////////////////////////////////////////////////////////////


        
        //////////////////////////////////////////////////////////////////////////

?>