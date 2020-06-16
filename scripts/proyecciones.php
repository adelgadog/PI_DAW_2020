<?php
/**
 * Archivo de clase Proyeccion.
 */ 

    /**
     * Class que permite generar un objeto Proyección con todos los datos vinculados a esta.
     * @author Andrés Delgado García <https://github.com/adelgadog/PI_DAW_2020>
     */  
    class Proyeccion {        

        /** @var int $id  Id de la proyección */
        public $id;
        /** @var int $Sala  Sala en la que se proyecta */
        public $Sala;
        /** @var int $idPelicula  Id de la pelicula que se proyecta */
        public $idPelicula;
        /** @var string $Definicion_Tarifa Definición de la tarifa que se aplica */
        public $Definicion_Tarifa;
        /** @var string $Fecha Fecha de la proyección */
        public $Fecha;
        /** @var string $Hora Hora de la proyección */
        public $Hora;
        /** @var int $Butacas Butacas totales de la sala donde se proyecta */
        public $Butacas;
        /** @var float $Precio  Precio por cada butaca*/
        public $Precio;
        /** @var int $Disponibles  Butacas aun no reservadas*/
        public $Disponibles;


        /**
        * Constructor sobrecagado de la clase.
        *
        * @param int $id    Id de la proyección
        * @param int $sala  Sala en la que se proyecta
        * @param int $idPelicula    Id de la pelicula que se proyecta
        * @param string $Definicion_Tarifa  Definición de la tarifa que se aplica
        * @param string $Fecha  Fecha de la proyección
        * @param string $Hora   Hora de la proyección
        * @param int $Butacas   Butacas totales de la sala donde se proyecta
        * @param float $Precio  Precio por cada butaca
        * @param int $Disponibles   Butacas aun no reservadas
        */
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