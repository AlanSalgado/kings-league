<?php
	session_start();
    // if(!ISSET($_SESSION["nombre"])){
    //     header("Location:index.php");
    // }
	// if(ISSET($_SESSION["tipoUsuario"])==3){
	// 	header("Location:index.php");
	// }
	
    $usuario=new usuario();
	
	$valNombre = "";
	$valUsuario = "";
	$valCorreo = "";
	$valTelefono = "";
	$valPassword = "";


	if(count($_POST)==1 && ISSET($_POST["id"]) && is_numeric($_POST["id"])){
        //Obtener la info del usuario con ese id
        $dao=new DAOUsuario();
        $usuario=$dao->obtenerUno($_POST["id"]);
	}
	else if(count($_POST)>1){
		$valNombre = "is-invalid";
		$valUsuario = "is-invalid";
		$valCorreo = "is-invalid";
		$valTelefono = "is-invalid";
		$valPassword = "is-invalid";
		$flag = true;
        if(ISSET($_POST["nombre"]) && (strlen(trim($_POST["nombre"])))>3){
			$valNombre = "is-valid";
        }
		else{
			$flag = false;
		}

		if(ISSET($_POST["usuario"]) && (strlen(trim($_POST["usuario"])))>3){
			$valUsuario = "is-valid";
        }
        else{
            $flag = false;
        }

		if(ISSET($_POST["correo"]) && (strlen(trim($_POST["correo"])))>3 && filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL)){
			$valCorreo = "is-valid";
		}
        else{
            $flag = false;
        }

		if(ISSET($_POST["telefono"]) && (strlen(trim($_POST["telefono"])))==10){
			$valTelefono = "is-valid";
		}
        else{
            $flag = false;
        }

		if(ISSET($_POST["password"]) && (strlen(trim($_POST["password"])))>=8){
			$valPassword = "is-valid";
        }
        else{
            $flag = false;
        }


		$usuario->idUsuario=ISSET($_POST["id"])?trim($_POST["id"]):0;
        $usuario->nombre=ISSET($_POST["nombre"])?trim($_POST["nombre"]):"";
		$usuario->usuario=ISSET($_POST["usuario"])?trim($_POST["usuario"]):"";
		$usuario->correo=ISSET($_POST["correo"])?trim($_POST["correo"]):"";
		$usuario->telefono=ISSET($_POST["telefono"])?trim($_POST["telefono"]):"";
		$usuario->password=ISSET($_POST["password"])?$_POST["password"]:"";
		$usuario->tipoUsuario=ISSET($_POST["tipo"])?$_POST["tipo"]:3;
		$usuario->idInstitucion = ISSET($_POST["institucion"])?$_POST["institucion"]:1;
			
		if($flag){
			$dao= new DAOUsuario();
			if($usuario->idUsuario==0){
				//echo $usuario->tipoUsuario;
				//echo "ENTRO A AGREGAR";
				if($usuario->tipoUsuario==3){
					if($dao->agregarCoach($usuario)==3){
						$_SESSION["msj"]="danger-Error al intentar guardar";
					}else{
						$_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
						//Al finalizar el guardado redireccionar a la lista
						header("Location: index.php");
					}
				}
				elseif($usuario->tipoUsuario<3){
					if($dao->agregar($usuario)==0){
						$_SESSION["msj"]="danger-Error al intentar guardar";
					}else{
						$_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
						//Al finalizar el guardado redireccionar a la lista
						header("Location: usuarios.php");
					}
				}
            }
			else{
				//echo "ENTRO A EDITAR";
                if($dao->editar($usuario)){
                    $_SESSION["msj"]="success-El usuario ha sido almacenado exitósamente";
                    //Al finalizar el guardado redireccionar a la lista
                   header("Location: usuarios.php");
                }else{
                    $_SESSION["msj"]="danger-Error al intentar guardar";
                }
            }
		}
			
	} 

	
?>