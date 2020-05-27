<?php
    class Valoracion {
        
        //////////////////////////////////////////////////////////////////////////
        //
        //  Objeto Valoración.
        //
        //////////////////////////////////////////////////////////////////////////
        
        public $id;
        public $usuario;
        public $fecha;
        public $hora;
        public $pelicula;
        public $titulo;
        public $cartel;
        public $nota;


        public function __construct($id, $usuario, $hora, $pelicula, $fecha, $titulo, $cartel, $nota){
            $this->id = $id;
            $this->usuario = $usuario;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->pelicula = $pelicula;
            $this->titulo = $titulo;
            $this->cartel = $cartel;
            $this->nota = $nota;
        }
        
        /*public function Modificar($id, $usuario, $hora, $pelicula, $fecha, $titulo, $cartel, $nota=0){
            $this->id = $id;
            $this->usuario = $usuario;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->pelicula = $pelicula;
            $this->titulo = $titulo;
            $this->cartel = $cartel;
            $this->nota = $nota;
        }*/
    }
?>