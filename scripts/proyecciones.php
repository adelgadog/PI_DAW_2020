<?php
    class Proyeccion {        
        
        //////////////////////////////////////////////////////////////////////////
        //
        //  Objeto Proyección.
        //
        //////////////////////////////////////////////////////////////////////////

        public $id;
        public $Sala;
        public $idPelicula;
        public $Definicion_Tarifa;
        public $Fecha;
        public $Hora;
        public $Butacas;
        public $Precio;
        public $Disponibles;

        public function __construct($id, $sala, $idPelicula, $Definicion_Tarifa, $Fecha, $Hora, $Butacas, $Precio, $Disponibles){
            $this->id = $id;
            $this->Sala = $sala;
            $this->idPelicula = $idPelicula;
            $this->Definicion_Tarifa = $Definicion_Tarifa;
            $this->Fecha = $Fecha;
            $this->Hora = $Hora;
            $this->Butacas = $Butacas;
            $this->Precio = $Precio;
            $this->Disponibles = $Disponibles;
        }
    }
?>