<?php
/**
 * Archivo de clase Usuario.
 */ 

    /**
     * Class que permite generar un objeto Usuario.
     * @author Andrés Delgado García <https://github.com/adelgadog/PI_DAW_2020>
     */   
    class Usuario {
        
        /** @var int $id  Id del usuario*/
        public $id;
        /** @var string $nombre  Nombre del usuario*/
        public $nombre;
        /** @var int $admin  Derechos de admin del usuario*/
        public $admin;
        /** @var string $mail  Correo del usuario*/
        public $mail;

        /**
        * Constructor sobrecagado de la clase.
        *
        * @param int $id     Id del usuario
        * @param string $user     Nombre del usuario
        * @param string $mail     Correo del usuario
        * @param int $admin     Derechos de admin del usuario
        */
        public function __construct($id, $user, $mail, $admin){
            $this->id = $id;
            $this->nombre = $user;
            $this->admin = $admin;
            $this->mail = $mail;
        }

        /**
        * Función que retorna el nombre del Usuario.
        *
        * @return string $nombre  
        */
        public function Mostrar_nombre(){
            return $this->nombre;
        }
        /**
        * Función que retorna el correo del Usuario.
        *
        * @return string $mail  
        */
        public function Mostrar_mail(){
            return $this->mail;
        }
        /**
        * Función que retorna si Usuario es Admin o no.
        *
        * @return int $admin  
        */
        public function Mostrar_admin(){
            return $this->admin;
        }
    }
?>