<!DOCTYPE html>
<html lang="en">
<head>
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
          <img class="card-img-top" src="/imagenesCarta/Blaziken_9.webp" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Blazicken</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-danger" onclick="eliminar()">Eliminar</a>
          </div>
        </div>      
      </div>
      <?php
        require_once('./php_librarys/back.php');
        echo selectCarta();
    ?>
      <div class="botonmas">
  <button type="button" onclick="mostrarFormulario()" class="btn btn-success btn-circle btn-xl float-right">+</button> 
</div>
  </div>

<script>
  function mostrarFormulario() {
    document.querySelector('.btn.btn-success.btn-circle.btn-xl.float-right').disabled = true;
    // Crear el formulario
    var formulario = document.createElement("form");
    formulario.innerHTML = `
    <div class="container py-5">
    <form onsubmit="return validar()">
        <div class="row">
            <div class="col-md form-group">
                <label for="camp1">Nombre del Pokemon :</label>
                <input type="text" id="camp1" name="camp1" class="form-control">
            </div>
            <div class="col-md form-group">
                <label for="camp3">Numero de su generación :</label>
                <input type="number" id="camp3" name="camp3" min="1" max="9" class="form-control">
            </div>
            <div class="col-md form-group">
                <label for="floatingSelectGrid">Indica su Tipo</label>
                <select class="form-select" id="floatingSelectGrid">
                <option selected>Su  tipo es...</option>
                      <option value="Acero">Acero</option>
                      <option value="Agua">Agua</option>
                      <option value="Bicho">Bicho</option>
                      <option value="Dragón">Dragón</option>
                      <option value="Eléctrico">Eléctrico</option>
                      <option value="Fantasma">Fantasma</option>
                      <option value="Fuego">Fuego</option>
                      <option value="Hada">Hada</option>
                      <option value="Hielo">Hielo</option>
                      <option value="Lucha">Lucha</option>
                      <option value="Normal">Normal</option>
                      <option value="Planta">Planta</option>
                      <option value="Psíquico">Psíquico</option>
                      <option value="Roca">Roca</option>
                      <option value="Siniestro">Siniestro</option>
                      <option value="Tierra">Tierra</option>
                      <option value="Veneno">Veneno</option>
                      <option value="Volador">Volador</option>                </select>
            </div>
            <div class="col-md form-group">
                <label for="floatingSelectGrid2">Indica su segundo Tipo (opcional)</label>
                <select class="form-select" id="floatingSelectGrid2">
                <option selected>Su segundo tipo es...</option>
                      <option value="Acero">Acero</option>
                      <option value="Agua">Agua</option>
                      <option value="Bicho">Bicho</option>
                      <option value="Dragón">Dragón</option>
                      <option value="Eléctrico">Eléctrico</option>
                      <option value="Fantasma">Fantasma</option>
                      <option value="Fuego">Fuego</option>
                      <option value="Hada">Hada</option>
                      <option value="Hielo">Hielo</option>
                      <option value="Lucha">Lucha</option>
                      <option value="Normal">Normal</option>
                      <option value="Planta">Planta</option>
                      <option value="Psíquico">Psíquico</option>
                      <option value="Roca">Roca</option>
                      <option value="Siniestro">Siniestro</option>
                      <option value="Tierra">Tierra</option>
                      <option value="Veneno">Veneno</option>
                      <option value="Volador">Volador</option>                </select>
            </div>
        </div>
        <div class="col form-group">
                <label for="floatingTextarea">Descripción</label>
                <textarea class="form-control" placeholder="Descripción del pokémon." id="floatingTextarea"></textarea>
        </div>
        <button class="btn btn-primary mt-2" type="submit">Listo</button>
        <button type="button" class="btn btn-secondary mt-2 ">Cancelar</button>

    </form>
</div>


    `;
    var botonCancelar = formulario.querySelector('.btn.btn-secondary.mt-2');
    botonCancelar.addEventListener('click', function() {
        // Eliminar el formulario del DOM
        formulario.remove();
        
        // Habilitar el botón para mostrar el formulario
        document.querySelector('.btn.btn-success.btn-circle.btn-xl.float-right').disabled = false;
    });
    // Añadir el formulario al cuerpo del documento
    document.body.appendChild(formulario);
  }
</script>

</body>
</html>