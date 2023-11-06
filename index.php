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

      <div class="col-sm mt-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Blazicken</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>      
      </div>
      <?php
        require_once('./php_librarys/back.php');
        echo selectCarta();
    ?>
      <div class="botonmas">
  <button type="button" onclick="mostrarFormulario()" class="btn btn-success btn-circle btn-xl float-right">+</button>
  <div class="container py-5 hidden-form">
  <div class="container py-5">
    <form action="/php_controllers/cartasControler.php" method="POST" onsubmit="return validar()">
        <div class="row">
            <div class="col-md form-group">
                <label for="nom">Nombre del Pokemon :</label>
                <input type="text" id="nom" name="nom" class="form-control">
            </div>
            <div class="col-md form-group">
                <label for="numero">Numero de su generación :</label>
                <input type="number" id="numerog" name="numerog" min="1" max="9" class="form-control">
            </div>
            <div class="col-md form-group">
                <label for="floatingSelectGrid">Indica su Tipo</label>
                <select class="form-select" id="nomt" name="nomt">
                <option selected>Su  tipo es...</option>
                      <option value="1">Acero</option>
                      <option value="2">Agua</option>
                      <option value="3">Bicho</option>
                      <option value="4">Dragón</option>
                      <option value="5">Eléctrico</option>
                      <option value="6">Fantasma</option>
                      <option value="7">Fuego</option>
                      <option value="8">Hada</option>
                      <option value="9">Hielo</option>
                      <option value="10">Lucha</option>
                      <option value="11">Normal</option>
                      <option value="12">Planta</option>
                      <option value="13">Psíquico</option>
                      <option value="14">Roca</option>
                      <option value="15">Siniestro</option>
                      <option value="16">Tierra</option>
                      <option value="17">Veneno</option>
                      <option value="18">Volador</option>       
                    </select>
            </div>
            <div class="col-md form-group">
                <label for="floatingSelectGrid2">Indica su segundo Tipo (opcional)</label>
                <select class="form-select" id="nom" name="nom[]">
                <option selected>Su segundo tipo es...</option>
                      <option value="1">Acero</option>
                      <option value="2">Agua</option>
                      <option value="3">Bicho</option>
                      <option value="4">Dragón</option>
                      <option value="5">Eléctrico</option>
                      <option value="6">Fantasma</option>
                      <option value="7">Fuego</option>
                      <option value="8">Hada</option>
                      <option value="9">Hielo</option>
                      <option value="10">Lucha</option>
                      <option value="11">Normal</option>
                      <option value="12">Planta</option>
                      <option value="13">Psíquico</option>
                      <option value="14">Roca</option>
                      <option value="15">Siniestro</option>
                      <option value="16">Tierra</option>
                      <option value="17">Veneno</option>
                      <option value="18">Volador</option>        
                    </select>
            </div>
        </div>
        <div class="col form-group">
                <label for="floatingTextarea">Descripción</label>
                <textarea class="form-control" name="descripcio" placeholder="Descripción del pokémon." id="floatingTextarea"></textarea>
        </div>
        <div class="form-group mt-2">
                <label for="pokemonImage">Selecciona una imagen del Pokémon:</label>
                <input type="file" class="form-control-file" id="imatge" name="imatge">
            </div>
        <button class="btn btn-primary mt-2" name="insert" type="submit">Listo</button>
        <button type="button" class="btn btn-secondary mt-2 ">Cancelar</button>

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
