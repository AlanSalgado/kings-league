<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
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
        // if(ISSET($_SESSION["tipoUsuario"])==3){
        //     header("Location:index.php");
        // }
        require "menu.php";
    ?>


    <div class="container">
        <p class="fs-1 text-center font-arial">¡Bienvenido, <strong class="fw-bold"><?php if($_SESSION["tipoUsuario"]==1){echo "Administrador";}else{echo "Auxiliar";} ?></strong>!</p>
        <div class="pt-2 text-center">
            <img src="./src/kl_logo.png" class="img-fluid" alt="...">
        </div>
        <div class="pt-2">
            <p class="fs-6 font-arial"><strong class="fw-bold">La Kings League </strong> denominada oficialmente por motivos de patrocinio como Kings League InfoJobs y Kings League Santander, es una liga de fútbol 7 con sede principal en Barcelona, España, creada por el exfutbolista Gerard Piqué en 2022 en asociación con otras personalidades de internet y streamers.</p>
            <p class="fs-6 font-arial">Consulta el reglamento para poder participar.</p>
        </div>
    </div>

    <?php
        require "piePagina.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!--<script src="./js/script.js"></script>-->
</body>
</html>