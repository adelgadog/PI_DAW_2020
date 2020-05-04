<?php
    class Usuario {
        
        //////////////////////////////////////////////////////////////////////////
        //
        //  Objeto Usuario.
        //
        //////////////////////////////////////////////////////////////////////////
        
        public $id;
        public $nombre;
        public $admin;
        public $mail;

        public function __construct($id, $user, $mail, $admin){
            $this->id = $id;
            $this->nombre = $user;
            $this->admin = $admin;
            $this->mail = $mail;
        }
        
        public function Mostrar_nombre(){
            return $this->nombre;
        }
        public function Mostrar_mail(){
            return $this->mail;
        }
        public function Mostrar_admin(){
            return $this->admin;
        }
    }
?>