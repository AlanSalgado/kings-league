<?php
    error_reporting(0);
?>

<nav id="menu" class="navbar navbar-expand-md p-3 sticky-top">
        <div class="container-fluid">
            <!-- <a class="navbar-brand px-2" href="./index.php"> -->
            <img src="./src/kl_logo.png" alt="Logo CCUP" title="Volver a la página de inicio" width="50">
            <!-- </a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                        if(ISSET($_SESSION["tipoUsuario"])){
                            if($_SESSION["tipoUsuario"]==1){
                                echo '
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./usuarios.php">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./equipos.php">Menu Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./concursos.php">Concursos</a>
                    </li>    
                    <!--Este es para cerrar sesion no quitar-->
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./cerrarSesion.php">Cerrar Sesion</a>
                    </li> ';
                            }elseif($_SESSION["tipoUsuario"]==2){
                                echo '
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./equipos.php">Menu Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./concursos.php">Concursos</a>
                    </li>
                    <!--Este es para cerrar sesion no quitar-->
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./cerrarSesion.php">Cerrar Sesion</a>
                    </li>';          
                            }elseif($_SESSION["tipoUsuario"]==3){
                    echo'
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./equipos.php">Menu Equipos</a>
                    </li>
                    <!--Este es para cerrar sesion no quitar-->
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./cerrarSesion.php">Cerrar Sesion</a>
                    </li>  ';            
                            }         
                        }else{
                            echo'
                    <li class="nav-item">
                        <a class="nav-link px-4" href="agregarInvitado.php">Registro de Coach</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link px-4" href="./convocatorias.php">Convocatorias</a>
                    </li> '; 
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
    </nav>