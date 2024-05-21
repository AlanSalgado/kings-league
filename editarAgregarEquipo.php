<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Equipo</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    
    <!--MENU SUPERIOR-->
    <?php
        session_start();
        if(!ISSET($_SESSION["nombre"])){
            header("Location:index.php");
        }
      require('menu.php');
      require_once('datos/daoEquipo.php');
      require_once('equipoUtil.php');
    ?>

    <div class="container-fluid w-50 justify-content-center mt-5">
        <h1 id="titulo" class="py-x|3"><?php if($equipo->idEquipo){echo "Editar";}else{echo "Agregar";} ?> Equipo</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $equipo->idEquipo ?>">
            <div class="form-group">
                <label>Nombre del equipo</label>
                <input type="text" name="NombreEquipo" id="txtNombreEquipo" class="form-control <?=$valNombreEquipo?>" <?=$valNombreEquipo?> value="<?= $equipo->nombre ?>"/>
                <div class="invalid-feedback">
                    <ul>
                        <li>El nombre de equipo no es válido</li>
                        <li>Debe tener más de 3 caracteres</li>
                    </ul>
                </div>
            </div>
			<input type="hidden" name="idUsuario" value="<?= $_SESSION["idUsuario"] ?>">
            <div class="form-group">
                <label>Concurso</label>
                <?php
                    require_once 'datos/daoConcurso.php';
                    require_once 'modelos/concurso.php';
                    $dao = new DAOConcurso();
                    $concurso = $dao->obtenerActivo();
                    $equipo->idConcurso=$concurso->idConcurso;
                    if($concurso){
                        echo '<label class="form-control">'.$concurso->nombreConcurso.'<label/>';
                    }
                ?>
                <input type="hidden" name="Concurso"  value="<?= $concurso->idConcurso; ?>">
            </div>
			<div class="form-group" <?php if($_SESSION["tipoUsuario"]==3){echo 'style="display:none;"';} ?>>
                <label>Aprobacion</label>
                <select name="Aprobacion" class="form-select rounded-0" required>
					<option value="0" selected>No aprobado</option>
					<option value="1" <?= ($equipo->aprobado==1)?"selected":""; ?>>Aprobado</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nombre completo estudiante #1</label>
                <input type="text" name="NomEstudiante1" class="form-control <?=$valNomEstudiante1?>" value="<?= $equipo->estudiante1 ?>"/>
                <div class="invalid-feedback">
                    <ul>
                        <li>El nombre debe tener 3 o más caracteres</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Nombre completo estudiante #2</label>
                <input type="text" name="NomEstudiante2" class="form-control <?=$valNomEstudiante2?>" value="<?= $equipo->estudiante2 ?>" />
                <div class="invalid-feedback">
                    <ul>
                        <li>El nombre debe tener 3 o más caracteres</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Nombre completo estudiante #3</label>
                <input type="text" name="NomEstudiante3" class="form-control <?=$valNomEstudiante3?>" value="<?= $equipo->estudiante3 ?>"/>
                <div class="invalid-feedback">
                    <ul>
                        <li>El nombre debe tener 3 o más caracteres</li>
                    </ul>
                </div>
            </div>
			<button formaction="editarAgregarEquipo.php" class="btn btn-primary col-4 mx-2">Guardar</button>
        </form>
		
    </div>


    <?php
        require "piePagina.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/equipos.js"></script>
</body>
</html>