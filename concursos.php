<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concursos</title>
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
        // }if(ISSET($_SESSION["tipoUsuario"])==3){
        //     header("Location:index.php");
        }
    ?>
    <?php
        require("menu.php");
        require_once('datos/daoConcurso.php');
        $daoConcurso = new DAOConcurso();
        $concursos = $daoConcurso->obtenerTodos();
    ?>

    <div class="container">
        <h1 class="py-5 fs-1">Gestión de Concursos</b></h1>
        <a class="btn btn-success p-2 my-2" href="editarAgregarConcurso.php">Agregar</a>
        <?php
            if($concursos){
                echo '<div class="container py-4">';
                    echo '<table id="concursos" class="display table table-bordered">';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th>Nombre</th>';
                                echo '<th>Fecha Inicio</th>';
                                echo '<th>Fecha Fin</th>';
                                echo '<th>Ubicacion</th>';
                                echo '<th>Acciones</th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                            foreach ($concursos as $concurso) {
                                echo '<tr>';
                                    echo '<td>'.$concurso->nombreConcurso.'</td>';
                                    echo '<td>'.$concurso->fechaInicio.'</td>';
                                    echo '<td>'.$concurso->fechaFin.'</td>';
                                    echo '<td>'.$concurso->ubicacion.'</td>';
                                    echo '<td><form method="post">';
                                    if($concurso->status==1){
                                        echo '<button name="activar" value="'.$concurso->idConcurso.'" class="btn btn-primary p-2 px-4">Activado</button>';
                                    }
                                    else{
                                        echo '<button formaction="activarDesactivarConcurso.php" name="activarConcurso" value="'.$concurso->idConcurso.'" class="btn btn-warning p-2 px-4">Activar</button>';
                                    }
                                    echo '</form></td>';
                                echo '</tr>';
                            }
                        echo '</tbody>';
                    echo '</table>';
                echo '</div>';
                
            } else {
                echo '<tr><td colspan="2">No hay concursos disponibles</td></tr>';
            }
        ?>
    </div>


    <!--FOOTER-->
    <?php
        require "piePagina.php";
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="./js/concursos.js"></script>
</body>
</html>