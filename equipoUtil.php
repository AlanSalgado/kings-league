<?php
	session_start();
    if(!ISSET($_SESSION["nombre"])){
        header("Location:index.php");
    }
	// if(ISSET($_SESSION["tipoUsuario"])==3){
	// 	header("Location:index.php");
	// }

    $equipo=new Equipo();
	//var_dump($equipo);
    $valNombreEquipo=$valNomEstudiante1=$valNomEstudiante2=$valNomEstudiante3="";
    if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        $daoequipo=new DAOEquipo();
        $equipo=$daoequipo->obtenerUno($_POST["id"]);
		//var_dump($equipo);
    }elseif(count($_POST)>1){
		$flag = true;
        
        $valNombreEquipo=$valNomEstudiante1=$valNomEstudiante2=$valNomEstudiante3="is-invalid";
        if(ISSET($_POST["NombreEquipo"]) && (strlen(trim($_POST["NombreEquipo"])))>=3){
            $valNombreEquipo = "is-valid";
        }
        else{
            $flag = false;
        }

        if(ISSET($_POST["NomEstudiante1"]) && (strlen(trim($_POST["NomEstudiante1"])))>=3){
            $valNomEstudiante1 = "is-valid";
        }
        else{
            $flag = false;
        }

		if(ISSET($_POST["NomEstudiante2"]) && (strlen(trim($_POST["NomEstudiante2"])))>=3){
            $valNomEstudiante2 = "is-valid";
        }
        else{
            $flag = false;
        }

		if(ISSET($_POST["NomEstudiante3"]) && (strlen(trim($_POST["NomEstudiante3"])))>=3){
            $valNomEstudiante3 = "is-valid";
        }
        else{
            $flag = false;
        }


		$equipo->idEquipo=ISSET($_POST["id"])?$_POST["id"]:0;
        $equipo->nombre=ISSET($_POST["NombreEquipo"])?$_POST["NombreEquipo"]:"";
		$equipo->idUsuario=ISSET($_POST["idUsuario"])?$_POST["idUsuario"]:0;
        $equipo->idConcurso=ISSET($_POST["Concurso"])?$_POST["Concurso"]:0;
        $equipo->aprobado=ISSET($_POST["Aprobacion"])?$_POST["Aprobacion"]:"";
        $equipo->estudiante1=ISSET($_POST["NomEstudiante1"])?$_POST["NomEstudiante1"]:"";
        $equipo->estudiante2=ISSET($_POST["NomEstudiante2"])?$_POST["NomEstudiante2"]:"";
		$equipo->estudiante3=ISSET($_POST["NomEstudiante3"])?$_POST["NomEstudiante3"]:"";
		//var_dump($equipo);	
		
		if($flag){
			if($equipo->idEquipo==0){
				$daoequipo=new DAOEquipo();
				if($daoequipo->agregar($equipo)==0){
					echo "Error al agregar";
				}else{
					header("Location: equipos.php");
				}
			}else{
				$daoequipo=new DAOEquipo();
				if($daoequipo->editar($equipo)==false){
					echo "Error al editar";
				}else{
					header("Location: equipos.php");
				}
			}
		}
      }
?>