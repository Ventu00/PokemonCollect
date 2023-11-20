<!DOCTYPE html>
<html lang="en">
<head>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://fonts.cdnfonts.com/css/pokemon-solid" rel="stylesheet">
                
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Col·leccions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js"></script>
  </head>
<body style="margin: 0;">
  <nav  id="nav" class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <div class="position-absolute top-0 start-50 translate-middle-x">
      <a class="navbar-brand" href="#" style="color: white; font-size: 40px;font-family: 'Pokemon Solid', sans-serif;
">CARTAS PoKéMoN 
<hr>
<h6>By Àlex Ventura</h6></a>

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
    <button type="button" onclick="mostrarFormulario('agregar')" class="btn btn-success btn-circle btn-xl float-right">+</button>
    <div class="container  hidden-form">
        <div class="container ">
            <form action="php_controllers/cartasControler.php" method="POST" enctype="multipart/form-data">
                <div>
                  <div class="tituloform">
                  <h6 class="nuevacartatitulo">Nueva Carta</h6>
                  </div>
                    <label for="nom">Nombre del Pokemon</label><br>
                    <input type="text" id="nom" name="nom" class="form-control" required>
                    <input type="hidden" name="accion" id="accion" value="agregar"> <!-- de aqui dependera la accion de agregar o modificar, que tengo un lio que no veas-->
                </div>
                <div>
                    <label for="generacion_id">Generación</label><br>
                    <input type="number" id="generacio_id" name="generacio_id" min="1" max="9" class="form-control" required>
                </div>
                <div>
                    <label for="nomt">Tipo</label><br>
                    <?php
                    require_once('./php_librarys/back.php');
                    echo selectTipus();
                    ?>
                </div>
                <div>
                    <label>Segundo Tipo:</label><br>
                    <?php
                    require_once('./php_librarys/back.php');
                    echo selectTipus2();
                    ?>
                </div>
                <div>
                    <label for="descripcio">Descripción:</label><br>
                    <textarea class="form-control" name="descripcio" placeholder="Descripción del Pokémon." id="descripcio" required></textarea>
                </div>
                <div>
                <label for="pokefile">Imagen:</label><br>
                <div class="imagenagregar">
                    <input type="file" name="imagen" id="imagen" class="pokefile" accept="image/*" required>
                  </div>
                </div>
                <div class="btn-group">
                <button class="btn btn-primary mt-2" name="insert" type="submit" onclick="actualizarAccion('agregar')">Agregar</button>
                <button class="btn btn-secondary mt-2" name="cancel" onclick="location.reload()" type="submit">Cancelar</button>
                </div>

            </form>
        </div>
    </div>
</div>
 
</div>
  </div>

</body>
</html>
