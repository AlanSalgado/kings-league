<?php
    require_once('datos/daoUsuario.php');
    
    $flag = true;
    $valUser = $valPass = "is-invalid";
    if(ISSET($_POST["txtUser"]) && (strlen(trim($_POST["txtUser"])))>=3){
        $valUser = "is-valid";
    }
    else{
        $flag = false;
    }

    if(ISSET($_POST["txtPass"]) && (strlen(trim($_POST["txtPass"])))>=3){
        $valPass = "is-valid";
    }
    else{
        $flag = false;
    }

    if($flag){
        //Verificar que llegan datos
        if(ISSET($_POST["txtUser"]) && ISSET($_POST["txtPass"])){
            //Conectarme y buscar usuario
            $dao=new DAOUsuario();
            
            $usuario=$dao->autenticar($_POST["txtUser"],$_POST["txtPass"]);
            if($usuario){
                session_start();
                $_SESSION["idUsuario"]=$usuario->idUsuario;
                $_SESSION["nombre"]=$usuario->nombre;
                $_SESSION["tipoUsuario"]=$usuario->tipoUsuario;
                // Tipo de usuario
                // 1 Administrador
                // 2 Auxiliar
                // 3 Coach
                if($usuario->tipoUsuario==1 ){
                    header("Location: adminPanel.php");
                }elseif($usuario->tipoUsuario==2){
                    header("Location: adminPanel.php");
                }elseif($usuario->tipoUsuario==3){
                    header("Location: equipos.php");
                }
                return;
                echo $usuario->tipoUsuario;
            }
            else{
                $valUser = $valPass = "is-invalid";
            }
        }
        else{
            $valUser = $valPass = "is-invalid";
        }
    }
    
    //session_destroy();
    header("Location: index.php");
?>