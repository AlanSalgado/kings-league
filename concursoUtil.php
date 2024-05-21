<?php
    session_start();
    if(!ISSET($_SESSION["nombre"])){
        header("Location:index.php");
    }
    // if(ISSET($_SESSION["tipoUsuario"])==3){
    //     header("Location:index.php");
    // }

    $concurso = new concurso();
    
    $valNombreConcurso = $valFechaInicio = $valFechaFin = $valUbicacion = $valRango = "";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        $dao = new DAOConcurso();
        $concurso = $dao->obtenerUno($_POST["id"]); 
    }
    else if(count($_POST)>1){
        $flag = true;
        $valNombreConcurso = $valFechaInicio = $valFechaFin = $valUbicacion = $valRango = "is-invalid";
        if(ISSET($_POST["nombreConcurso"]) && (strlen(trim($_POST["nombreConcurso"])))>=3){
            $valNombreConcurso = "is-valid";
        }
        else{
            $flag = false;
        }

        $fecha1 = explode('-', $_POST["fechaInicio"]);
        if(ISSET($_POST["fechaInicio"]) && (strlen(trim($_POST["fechaInicio"])))==10 && count($fecha1)==3 && checkdate($fecha1[1], $fecha1[2], $fecha1[0])){
            $valFechaInicio = "is-valid";
        }
        else{
            $flag = false;
        }

        $fecha2 = explode('-', $_POST["fechaFin"]);
        if(ISSET($_POST["fechaFin"]) && (strlen(trim($_POST["fechaFin"])))==10 && count($fecha2)==3 && checkdate($fecha2[1], $fecha2[2], $fecha2[0])){
            $valFechaFin = "is-valid";
        }
        else{
            $flag = false;
        }

        if(ISSET($_POST["fechaFin"]) && (strlen(trim($_POST["fechaFin"])))==10 && count($fecha2)==3 && checkdate($fecha2[1], $fecha2[2], $fecha2[0])
        && ISSET($_POST["fechaInicio"]) && (strlen(trim($_POST["fechaInicio"])))==10 && count($fecha1)==3 && checkdate($fecha1[1], $fecha1[2], $fecha1[0])){
            if($fecha2[0]>$fecha1[0]){
                $valRango = "is-valid";
            }   
            else{
                if($fecha2[1]>$fecha1[1]){
                    $valRango = "is-valid";
                }
                else{
                    if($fecha2[2]>$fecha1[2]){
                        $valRango = "is-valid";
                    }
                    else{
                        $flag = false;
                    }
                }
            }
        }
        else{
            $flag = false;
        }


        if(ISSET($_POST["ubicacion"]) && (strlen(trim($_POST["ubicacion"]))>=3)){
            $valUbicacion = "is-valid";
        }
        else{
            $flag = false;
        }

        $concurso->idConcurso = ISSET($_POST["id"])?trim($_POST["id"]):0;
        $concurso->nombreConcurso = ISSET($_POST["nombreConcurso"])?trim($_POST["nombreConcurso"]):"";
        $concurso->fechaInicio = ISSET($_POST["fechaInicio"])?trim($_POST["fechaInicio"]):"";
        $concurso->fechaFin = ISSET($_POST["fechaFin"])?trim($_POST["fechaFin"]):"";
        $concurso->ubicacion = ISSET($_POST["ubicacion"])?trim($_POST["ubicacion"]):"";

        if($flag){
            $dao = new DAOConcurso();        
            if($concurso->idConcurso==0){ 
                if($dao->agregar($concurso)==0){
                    $_SESSION["msj"]="danger-Error al intentar guardar";
                }
                else {
                    $_SESSION["msj"]="success-El concurso ha sido almacenado exitósamente";
                    header("Location: concursos.php");
                }
            }
            else{
                if($dao->editar($concurso)){
                    $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                    header("Location: concursos.php");
                }
                else{
                    $_SESSION["msj"]="danger-Error al intentar actualizar";
                }
            }
        }
    }
?>