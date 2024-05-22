<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concurso</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
</head>
<body>
    
    <!--MENU SUPERIOR-->
    <?php
        session_start();
        if(!ISSET($_SESSION["nombre"])){
            header("Location:index.php");
        }
        // if(ISSET($_SESSION["tipoUsuario"])==3){
        //     header("Location:index.php");
        // }
        require("menu.php");
		require_once('datos/daoConcurso.php');
		require_once('concursoUtil.php');
    ?>

    <div class="container-fluid w-50 justify-content-center mt-5">
        <h1 id="titulo" class="py-x|3"><?php if($concurso->idConcurso){echo "Editar";}else{echo "Agregar";} ?> Torneo</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $concurso->idConcurso ?>">
            <div class="form-group">
                <label>Nombre del Torneo</label>
                <input type="text" name="nombreConcurso" id="txtNombreConcurso" class="form-control <?=$valNombreConcurso?>" value="<?= $concurso->nombreConcurso ?>" minlength="3">
                <div class="invalid-feedback">
                    <ul>
                        <li>El nombre es obligatorio</li>
                        <li>Debe tener 3 o más caracteres</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Fecha de Inicio</label>
                <input type="date" name="fechaInicio" id="txtFechaInicio" class="form-control <?=$valFechaInicio?>" value="<?= $concurso->fechaInicio ?>">
                <div class="invalid-feedback">
                    <ul>
                        <li>El formato de la fecha no es el correcto</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Fecha de Fin</label>
                <input type="date" name="fechaFin" id="txtFechaFin" class="form-control <?=$valFechaFin?>" value="<?= $concurso->fechaFin ?>">
                <div class="invalid-feedback">
                    <ul>
                        <li>El formato de la fecha no es el correcto</li>
                    </ul>
                </div>
                <input type="hidden" name="guia" id="txtGuia" class="form-control <?=$valRango?>">
                <div class="invalid-feedback">
                    <ul>
                        <li>La fecha de Inicio debe ser anterior a la fecha de Fin</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label>Ubicacion</label>
                <input type="text" name="ubicacion" id="txtUbicacion" class="form-control <?=$valUbicacion?>" value="<?= $concurso->ubicacion ?>" minlength="3">
                <div class="invalid-feedback">
                    <ul>
                        <li>La ubicación es obligatoria</li>
                        <li>Debe tener 3 o más caracteres</li>
                    </ul>
                </div>
            </div>
            <button class="btn btn-primary" formaction="editarAgregarConcurso.php">Aceptar</button>
        </form>
    </div>


    <!--FOOTER-->
    <?php
        require("piePagina.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="./js/concursos.js"></script>
</body>
</html>