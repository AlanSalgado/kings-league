<?php
    session_start();
    if(!ISSET($_SESSION["nombre"])){
        header("Location:index.php");
    }
    // if(ISSET($_SESSION["tipoUsuario"])==3){
    //     header("Location:index.php");
    // }
    require_once('datos/daoUsuario.php');

    if(ISSET($_POST["eliminar"]) && is_numeric($_POST["eliminar"])){
        $dao = new DAOUsuario();
        if($dao -> eliminar($_POST["eliminar"])){
            header("Location: usuarios.php");  
        }
        else{
            $_SESSION["msj"]="danger-Error al intentar guardar";
        }
    }
?>