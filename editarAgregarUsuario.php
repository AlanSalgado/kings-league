<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    
    <!--MENU SUPERIOR-->
    <?php

        // if(!(ISSET($_SESSION['tipoUsuario']))){
        //     session_start();
        //     $_SESSION['tipoUsuario'] = 3;
        // }
        require("menu.php");
		require_once('datos/daoUsuario.php');
		require_once('usuarioUtil.php');
    ?>
    
    <div class="container-fluid w-50 justify-content-center mt-5">
		
        <h1 id="titulo" class="py-x|3"><?php if($usuario->idUsuario){echo "Editar";}else{echo "Agregar";} ?> Usuario</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $usuario->idUsuario ?>"/>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" id="txtNombre"  class="form-control <?=$valNombre?>" value="<?= $usuario->nombre ?>" minlength="3">
                <div class="invalid-feedback">
                    <ul>
                        <li>El nombre es obligatorio</li>
                        <li>Debe tener más de 3 caracteres</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="usuario" id="txtUsuario" class="form-control <?=$valUsuario?>" value="<?= $usuario->usuario ?>" minlength="3">
                <div class="invalid-feedback">
                    <ul>
                        <li>El usuario es obligatorio</li>
                        <li>Debe tener 3 o más caracteres</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Correo</label>
                <input type="text" name="correo" id="txtCorreo" class="form-control <?=$valCorreo?>" value="<?= $usuario->correo ?>"  minlength="3">
                <div class="invalid-feedback">
                    <ul>
                        <li>El correo es obligatorio</li>
                        <li>Debe tener 3 o más caracteres</li>
                        <li>Correo electrónico no válido</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Telefono</label>
                <input type="tel" name="telefono" id="txtTelefono" class="form-control <?=$valTelefono?>" value="<?= $usuario->telefono ?>" pattern="\d{10}" title="Debe contener exactamente 10 dígitos" minlength="10" maxlength="10">
                <div class="invalid-feedback">
                    <ul>
                        <li>El telefono es obligatorio</li>
                        <li>Debe tener 10 digitos</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password" id="txtPassword" class="form-control <?=$valPassword?>" value="<?php $usuario->password?>" minlength="8">
                    <button type="button" class="btn btn-outline-secondary" id="btnMostrar" onclick="mostrar()" >Mostrar</button>
                    <div class="invalid-feedback">
                        <ul>
                            <li>La contraseña es obligatoria</li>
                            <li>Debe tener 8 o más caracteres</li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if(ISSET($SESSION["tipoUsuario"]) && ($SESSION["tipoUsuario"]==1 || $SESSION["tipoUsuario"]==2)){
            ?>
            
            <div class="form-group">
                <label>Tipo de usuario</label>
                <select name="tipo" class="form-select rounded-0" id="cmbTipo" required>
                    <option value="1" <?php if($usuario->tipoUsuario==1){echo "selected";}?>>Admin</option>
                    <option value="2" <?php if($usuario->tipoUsuario==2){echo "selected";}?>>Auxiliar</option>
                    <option value="3" <?php if($usuario->tipoUsuario==3){echo "selected";}?>>Coach</option>
                </select>
            </div>
            <?php } ?>
            
            <div class="form-group">
                <label>Institucion</label>
                <select name="institucion" class="form-select rounded-0" id="cmbInstitucion" >
                    <?php
                        $dao = new DAOUsuario();
                        $escuelas = $dao->getInstituciones();
                        if($escuelas){
                            foreach($escuelas as $escuela){
								if($escuela->idInstitucion==$usuario->idInstitucion){
									echo '<option value="'.$escuela->idInstitucion.'" selected>'.$escuela->nombre.' </option>';
								}else{
									echo '<option value="'.$escuela->idInstitucion.'">'.$escuela->nombre.'</option>';
								}
                            }
                        } else {
                            echo '<option>No hay escuelas disponibles</option>';
                        }
                    ?>
                </select>
            </div>
			<button class="btn btn-primary"" formaction="editarAgregarUsuario.php">Aceptar</button>
        </form>
        
    </div>

    <?php
        require("piePagina.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/usuarios.js"></script>
</body>
</html>