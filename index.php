<?php
    if(!isset($_COOKIE["peliculas"]) || !isset($_COOKIE["proyecciones"])) {
        require_once 'scripts/funciones.php';
        $array_peliculas=Get_Peliculas();
        $array_proyecciones=Get_Proyeccion();

    }    
    header('Location: contenido/inicio.php');
?>