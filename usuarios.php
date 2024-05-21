<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        // if(ISSET($_SESSION["tipoUsuario"])==3){
        //     header("Location:index.php");
        // }
        require("menu.php");
        require_once('datos/daoUsuario.php');
        $daoUsuario = new DAOUsuario();
        if(ISSET($_POST["id"]) && is_numeric($_POST["id"])){
            //Eliminar
            if($daoUsuario->eliminar($_POST["id"])){
                $_SESSION["msj"]="success-El usuario ha sido eliminado correctamente";
            }else{
                $_SESSION["msj"]="danger-No se ha podido eliminar el usuario seleccionado";
            }
        }

        $usuarios = $daoUsuario->obtenerTodos();
        $correos = $daoUsuario->obtenerCorreosCoaches();
    ?>
    <!--Contenido-->
    <div class="container">
    <?php
        if(ISSET($_SESSION["msj"])){
          $mensaje=explode("-",$_SESSION["msj"]);
        ?>
        <div id="mensajes" class="alert alert-<?=$mensaje[0]?>">
            <?=$mensaje[1]?>
        </div>
        <?php
          UNSET($_SESSION["msj"]);
        }
        ?>
        <h1 class="py-5 fs-1">Gestión de Usuarios</b></h1>
        <a class="btn btn-success p-2 my-2" href="editarAgregarUsuario.php">Agregar</a>
        <button class="btn btn-dark p-2 my-2" onclick="exportTableToExcel('correos', 'Lista de correos de coaches')">Descargar correos</button>

        <?php

        if($usuarios){
            echo '<div class="container py-4">';
                echo '<table id="usuarios" class="display table table-bordered">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>Nombre</th>';
                            echo '<th>Usuario</th>';
                            echo '<th>Rol</th>';
                            echo '<th>Correo</th>';
                            echo '<th>Acciones</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                        foreach ($usuarios as $usuario) {
                            $tipoUsuarioo = "";
                            if($usuario->tipoUsuario==1){
                                $tipoUsuarioo = "Admin";
                            }
                            else if($usuario->tipoUsuario==2){
                                $tipoUsuarioo = "Auxiliar";
                            }   
                            else{
                                $tipoUsuarioo = "Coach";
                            }
                            echo '<tr>';
                                echo '<td>'.$usuario->nombre.'</td>';
                                echo '<td>'.$usuario->usuario.'</td>';
                                echo '<td>'.$tipoUsuarioo.'</td>';
                                echo '<td>'.$usuario->correo.'</td>';
                                echo '<td><form method="post">';
                                    echo '<button formaction="editarAgregarUsuario.php" name="id" value="'.$usuario->idUsuario.'" class="btn btn-warning p-2 px-4">Editar</button>';
                                    echo '<button type="button" onclick="confirmar(this)" name="eliminar" value="'.$usuario->idUsuario.'" class="btn btn-danger p-2 px-4">Eliminar</button>';
                                echo '</form>';
                            echo '</td></tr>';
                        }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
            
        } else {
            echo '<tr><td colspan="2">No hay usuarios disponibles</td></tr>';
        }
    ?>
    </div>

    <?php
        /*
        if($correos){
            echo '<div class="container py-4">';
                echo '<table id="correos" class="display table table-bordered">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>Nombre</th>';
                            
                            echo '<th>Correo</th>';
                            
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                        foreach ($correos as $usuario) {
                            $tipoUsuarioo = "";
                            if($usuario->tipoUsuario==1){
                                $tipoUsuarioo = "Admin";
                            }
                            else if($usuario->tipoUsuario==2){
                                $tipoUsuarioo = "Auxiliar";
                            }   
                            else{
                                $tipoUsuarioo = "Coach";
                            }
                            echo '<tr>';
                                echo '<td>'.$usuario->nombre.'</td>';
                                echo '<td>'.$usuario->correo.'</td>';
                            echo '</tr>';
                        }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
            
        } */
    ?>
    </div>


    <div class="modal" id="mdlConfirmacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Está a punto de eliminar a <strong id="spnPersona"></strong> 
                    ¿Desea continuar?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form method="post">
                        <button class="btn btn-danger" data-bs-dismiss="modal" id="btnConfirmar" name="id">Si, continuar con la eliminación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php
        require("piePagina.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="js/usuarios.js"></script>
    <script src="js/excel.js"></script>
</body>
</html>