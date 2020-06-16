<?php
/**
 * Archivo de clase Valoracion.
 */ 

    /**
     * Class que permite guardar una valoracion de un usuario a una pelicula.
     * @author Andrés Delgado García <https://github.com/adelgadog/PI_DAW_2020>
     */   
    class Valoracion{

        /** @var int $id  Id del usuario*/
        public $id;
        /** @var string $usuario  Nombre del usuario*/
        public $usuario;
        /** @var string $fecha  Fecha de la proyeccion*/
        public $fecha;
        /** @var string $hora  Hora de la proyeccion*/
        public $hora;
        /** @var int $pelicula  Id de la pelicula*/
        public $pelicula;
        /** @var string $titulo  Titulo de la pelicula*/
        public $titulo;
        /** @var string $cartel  Cartel de la pelicula*/
        public $cartel;
        /** @var float $nota  Nota asignada a la pelicula*/
        public $nota;


        /**
        * Constructor sobrecagado de la clase.
        *
        * @param int $id     Id del usuario
        * @param string $usuario     Nombre del usuario
        * @param string $hora     Hora de la proyeccion
        * @param int $pelicula     Id de la pelicula
        * @param string $fecha     Fecha de la proyeccion
        * @param string $titulo     Titulo de la pelicula
        * @param string $cartel     Cartel de la pelicula
        * @param float $nota     Nota asignada a la pelicula
        */
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

        /**
        * Funcion para modificar la nota.
        *
        * @param int $id     Id del usuario
        * @param string $usuario     Nombre del usuario
        * @param string $hora     Hora de la proyeccion
        * @param int $pelicula     Id de la pelicula
        * @param string $fecha     Fecha de la proyeccion
        * @param string $titulo     Titulo de la pelicula
        * @param string $cartel     Cartel de la pelicula
        * @param float $nota     Nota asignada a la pelicula
        */
        public function Modificar($id, $usuario, $hora, $pelicula, $fecha, $titulo, $cartel, $nota=0){
            $this->id = $id;
            $this->usuario = $usuario;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->pelicula = $pelicula;
            $this->titulo = $titulo;
            $this->cartel = $cartel;
            $this->nota = $nota;
        }

        /**
        * Función para modificar la fecha de la proyeccion.
        *
        * @param string $fecha     Fecha de la proyeccion
        */
        public function Modificar_Fecha($fecha){
            $this->fecha = $fecha;
        }
    }
?>