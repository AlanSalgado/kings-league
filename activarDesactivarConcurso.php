<?php
    session_start();
    if(!ISSET($_SESSION["nombre"])){
        header("Location:index.php");
    }
    require_once('datos/daoConcurso.php');

    if(ISSET($_POST["activarConcurso"]) && is_numeric($_POST["activarConcurso"])){
        $dao = new DAOConcurso();
        $dao -> setConcursoActivo($_POST["activarConcurso"]);
        header("Location: concursos.php");
    }
?>