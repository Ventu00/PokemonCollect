<!DOCTYPE html>
<html lang="en">
<head>
<style>
  .hidden-form {
    display: none;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Col·leccions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilos/style.css">
    <script src="javascript/scripts.js"></script>

  </head>
<body style="margin: 0;">
  <nav class="navbar navbar-expand-lg " style="background-color: rgb(190, 0, 0); height: 70px;">
    <div class="container-fluid">
      <div class="position-absolute top-0 start-50 translate-middle-x">
      <a class="navbar-brand" href="#" style="color: white; font-weight: bold; font-size: 40px;">Cartas Pokémon </a>
    </div>
      </div>
    </div>
    </div>
  </nav>

  <div class="container p-3">
    <div class="row m-4">
      <?php
        require_once('./php_librarys/back.php');
        echo selectCarta();
    ?>
      <div class="botonmas">
  <button type="button" onclick="mostrarFormulario()" class="btn btn-success btn-circle btn-xl float-right">+</button>
  <div class="container py-5 hidden-form">
  <div class="container py-5">
  <form action="php_controllers/cartasControler.php" method="POST" enctype="multipart/form-data">
  <div class="row">

    <div class="col-md form-group">
      <label for="nom">Nombre del Pokemon:</label>
      <input type="text" id="nom" name="nom" class="form-control" required>
    </div>
    <div class="col-md form-group">
      <label for="generacion_id">Generación:</label>
      <input type="number" id="generacio_id" name="generacio_id" min="1" max="9" class="form-control" required>
    </div>
    <div class="col-md form-group">
      <label for="nomt">Tipo:</label>
      <?php
        require_once('./php_librarys/back.php');
        echo selectTipus();
  ?>
    </div>
  </div>
  </div>
  <div class="col form-group">
    <label for="descripcio">Descripción:</label>
    <textarea class="form-control" name="descripcio" placeholder="Descripción del Pokémon." id="descripcio" required></textarea>
  </div>
  <div class="col-md form-group">
      <label for="imatge">Imagen del Pokémon:</label>
    <input type="file" name="imagen" id="imagen" class="form-control-file" accept="image/*" required>
    </div>
  <button class="btn btn-primary mt-2" name="insert" type="submit">Agregar Carta</button>
  <button class="btn btn-secondary mt-2" name="cancel" onclick="location.reload()" type="submit">Cancelar</button>
</form>
</div>
</div>
 
</div>
  </div>

<script>
function mostrarFormulario() {
  var botonMas = document.querySelector('.btn.btn-success.btn-circle.btn-xl.float-right');
  botonMas.disabled = true;

  var formulario = document.querySelector('.hidden-form');
  formulario.style.display = 'block';

  var botonCancelar = formulario.querySelector('.btn.btn-secondary.mt-2');
  botonCancelar.addEventListener('click', function() {
    formulario.style.display = 'none';
    botonMas.disabled = false;
  });
}

</script>

</body>
</html>
