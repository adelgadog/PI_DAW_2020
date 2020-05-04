<?php
    class Pelicula {
        
        
        //////////////////////////////////////////////////////////////////////////
        //
        //  Objeto Pelicula.
        //
        //////////////////////////////////////////////////////////////////////////
        
        public $id;
        public $Titulo;
        public $Pais;
        public $Genero;
        public $Año;
        public $Duracion;
        public $Estreno;
        public $Calificacion;
        public $Sinopsis;
        public $Valoracion;
        public $Cartel;
        public $Trailer;


        public function __construct($id, $titulo, $pais, $genero, $año, $duracion, $estreno, $calificacion, $sinopsis, $valoracion, $cartel, $trailer){
            $this->id = $id;
            $this->Titulo = $titulo;
            $this->Pais = $pais;
            $this->Genero = $genero;
            $this->Año = $año;
            $this->Duracion = $duracion;
            $this->Estreno = $estreno;
            $this->Calificacion = $calificacion;
            $this->Sinopsis = $sinopsis;
            $this->Valoracion = $valoracion;
            $this->Cartel = $cartel;
            $this->Trailer = $trailer;
        }
    }
?>