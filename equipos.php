<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css"/>
</head>
<body>
    <!--MENU SUPERIOR-->
    <?php
        
        session_start();
        if(!ISSET($_SESSION["nombre"])){
            header("Location:index.php");
        }
        require "menu.php";
        
    ?>
    <!--Contenido-->
    <div class="container">
        <h1 class="py-5 fs-1">Gestión de Equipos</b></h1>
        <a class="btn btn-success p-2 my-2" href="editarAgregarEquipo.php">Agregar</a>
        <button class="btn btn-dark p-2 my-2" onclick="exportTableToExcel('equiposAprobados', 'Lista de equipos aprobados')">Descargar lista</button>
    </div>


    <?php
        require_once 'datos/daoEquipo.php';
        $daoEquipo = new DAOEquipo();
        /*
        if($daoEquipo->updateStatus(15)){
            echo "Editado";
        }*/
        $equipos="";
        if($_SESSION["tipoUsuario"]==3){
            $equipos = $daoEquipo->obtenerTodosPorCoach($_SESSION["idUsuario"]);
        }else{
            $equipos = $daoEquipo->obtenerTodos();
        }
        

        if($equipos){
            echo '<div class="container py-4">';
                echo '<table id="equipos" class="display table table-bordered">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>Nombre del Equipo</th>';
                            echo '<th>Estudiante 1</th>';
                            echo '<th>Estudiante 2</th>';
                            echo '<th>Estudiante 3</th>';
                            echo '<th>Acciones</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                        foreach ($equipos as $equipo) {
                            echo '<tr>';
                                echo '<td>'.$equipo->nombre.'</td>';
                                echo '<td>'.$equipo->estudiante1.'</td>';
                                echo '<td>'.$equipo->estudiante2.'</td>';
                                echo '<td>'.$equipo->estudiante3.'</td>';
                                echo '<td>';
                                if($_SESSION['tipoUsuario']==3){
                                    echo '<form method="post">';
                                        echo '<button name="id" formaction="editarAgregarEquipo.php" value="'.$equipo->idEquipo.'" class="btn btn-warning p-2 px-4">Editar</button>';
                                    echo '</form>';
                                } 
                                else {
                                    $texto = "";
                                    if($equipo->aprobado==0){
                                        $texto = "Aprobar";
                                        echo '<form method="post">';
                                            echo '<button name="activar" formaction="activarDesactivarEquipo.php" class="btn btn-primary p-2 px-4" value="'.$equipo->idEquipo.'">'.$texto.'</button>';
                                        echo '</form>';
                                    }
                                    else if($equipo->aprobado==1){
                                        $texto = "Desaprobar";
                                        echo '<form method="post">';
                                            echo '<button name="activar" formaction="activarDesactivarEquipo.php" class="btn btn-danger p-2 px-4" value="'.$equipo->idEquipo.'">'.$texto.'</button>';
                                        echo '</form>';
                                    }
                                    
                                }
                                echo '</td>';
                            echo '</tr>';
                        }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
            
        } else {
            echo '<tr><td colspan="2">No hay equipos disponibles</td></tr>';
        }
    ?>

    <?php
        require_once 'datos/daoEquipo.php';
        require_once 'modelos/exportar.php';
        $daoEquipo = new DAOEquipo();
        $equipos = $daoEquipo->obtenerTodosAprobados();
        /*
        if($equipos){
            echo '<div class="container py-4">';
                echo '<table id="equiposAprobados" class="display table table-bordered">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>Nombre del equipo</th>';
                            echo '<th>Coach</th>';
                            echo '<th>Institucion</th>';
                            echo '<th>Estudiante 1</th>';
                            echo '<th>Estudiante 2</th>';
                            echo '<th>Estudiante 3</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                        foreach ($equipos as $equipo) {
                            echo '<tr>';
                                echo '<td>'.$equipo->nombreEquipo.'</td>';
                                echo '<td>'.$equipo->coach.'</td>';
                                echo '<td>'.$equipo->institucion.'</td>';
                                echo '<td>'.$equipo->estudiante1.'</td>';
                                echo '<td>'.$equipo->estudiante2.'</td>';
                                echo '<td>'.$equipo->estudiante3.'</td>';
                            echo '</tr>';
                        }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
            
        } 
        */
    ?>
    
    <!-- Footer -->
    <?php
        require "piePagina.php";
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="js/equipos.js"></script>
    <script src="js/excel.js"></script>
</body>
</html>