<?php
    session_start();
    if(!ISSET($_SESSION["nombre"])){
        header("Location:index.php");
    }
    require_once('datos/daoEquipo.php');

    if(ISSET($_POST["activar"]) && is_numeric($_POST["activar"])){
        $dao = new DAOEquipo();
        $dao -> updateStatus($_POST["activar"]);
        header("Location: equipos.php");
    }
?>