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
    <!-- Menu superior -->
    <?php
        require("menu.php");
    ?>
    <!--Contenido-->
    <div class="py-3">
        
        <div class="mx-auto py-4" style="width: 200px;">
            <img src="src/logo-ccup.png" alt="logo" width="200px">
        </div>
        <form action="procesarInicio.php" method="post"  class="mx-auto py-4" style="width: 400px;">
            <div>
                <label for="txtUser" class="form-label">Usuario</label>
                <input type="text" class="form-control <?=$valUser?>" name="txtUser">
                <div class="invalid-feedback">
                    <ul>
                        <li>El usuario es obligatorio</li>
                        <li>Debe tener 3 o más caracteres</li>
                    </ul>
                </div>
            </div>
            <div>
                <label for="txtPass" class="form-label">Contraseña</label>
                <input type="password" class="form-control <?=$valPass?>" name="txtPass">
                <div class="invalid-feedback">
                    <ul>
                        <li>La contraseña es obligatoria</li>
                        <li>Debe tener 8 o más caracteres</li>
                    </ul>
                </div>
            </div>
            <div class="d-grid gap-2 py-3">
                <button class="btn btn-warning">Acceder</button>
            </div>
        </form>
    </div>


    <?php
        require("piePagina.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!--script src="./js/script.js"></script>-->
</body>
</html>