<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Convocatorias</title>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>

  <!--MENU SUPERIOR-->
  <?php
        require "menu.php";
    ?>
  <!--Contenido-->
  <div class="py-3">
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="src/imagen_ref.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="src/imagen_ref.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="src/imagen_ref.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>


    <div>
      <div class="mt-auto py-2">
        <div class="text-center">
          <h1>Nombre convocatoria</h1>
        </div>
      </div>
      <div class="mx-auto p-1" style="width: 90%;">
        <div style="display: flex;">
          <div class="mx-auto py-4 px-4 w-100">
            <img src="src/logo-ccup.png" alt="img" style="width: 450px;">
          </div>
          <div class="mx-auto py-4 px-4 w-100 text-center">
            <h2>Datos importantes de la convocatoria</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vulputate blandit tellus nec feugiat.
                Aliquam leo mi, lacinia ac nisi et, auctor iaculis mi. In pharetra est orci, nec finibus orci suscipit
                sed. Pellentesque fermentum gravida tellus, quis lobortis eros dapibus vitae. In gravida sapien eget leo
                lobortis consequat. Nulla eros felis, interdum vel lorem id, dictum rhoncus erat. Duis vitae dui quis
                enim interdum ultricies. Aliquam sodales velit a enim euismod, vel ultricies diam congue. Nullam lectus
                lacus, scelerisque sit amet libero ut, convallis viverra massa. Integer odio justo, porta vitae luctus
                id, vulputate nec mauris.</p>
          </div>
        </div>
        <div class="mx-auto p-2" style="width: 90%;">
          <div style="display: flex;">
            <div class="mx-auto py-4 px-4 w-100 text-center">
              <h2>Como la convocatoria apoya a los jovenes</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vulputate blandit tellus nec feugiat.
                  Aliquam leo mi, lacinia ac nisi et, auctor iaculis mi. In pharetra est orci, nec finibus orci suscipit
                  sed. Pellentesque fermentum gravida tellus, quis lobortis eros dapibus vitae. In gravida sapien eget
                  leo lobortis consequat. Nulla eros felis, interdum vel lorem id, dictum rhoncus erat. Duis vitae dui
                  quis enim interdum ultricies. Aliquam sodales velit a enim euismod, vel ultricies diam congue. Nullam
                  lectus lacus, scelerisque sit amet libero ut, convallis viverra massa. Integer odio justo, porta vitae
                  luctus id, vulputate nec mauris.</p>
            </div>
            <div class="mx-auto py-4 px-4 w-100 text-center">
              <img src="src/logo-ccup.png" alt="img" style="width: 450px;">
            </div>
          </div>
        </div>
      </div>
      <div class="mt-auto py-2">
        <div class="text-center">
          <button class="btn btn-warning" type="button" style="width: 50%;">Inscribirse</button>
        </div>
      </div>
    </div>

    <?php
        require "piePagina.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
    <!--<script src="./js/script.js"></script>-->
</body>

</html>