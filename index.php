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
    <link rel="stylesheet" href="estilos/style.css">
    <script src="javascript/scripts.js"></script>
  </head>
<body style="margin: 0;">
  <nav  id="nav" class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <div class="position-absolute top-0 start-50 translate-middle-x">
      <a class="navbar-brand" href="#">CARTAS PoKéMoN </a>
    </div>
      </div>
    </div>
    </div>
  </nav>

  <div class="container p-3">
    <div class="row m-4">
      <?php
        require_once('./php_librarys/back.php');
        $resultado = selectCarta();        
    ?>


<div class="container">
    <div class="row">
        <?php foreach ($resultado as $fila): ?>
            <div class="col-sm-4 mt-4"> 
                <div class="card">
                    <?php if (!empty($fila['imagen'])): ?>
                        <img src="<?= $fila['imagen'] ?>" class="card-img-top" alt="Imagen de la carta">
                    <?php endif; ?>
                    <div class="card-body">
                        <?php require_once('./php_partials/mensajes.php'); ?>
                        <h5 class="card-title"><?= $fila['nom'] ?></h5>
                        <p class="card-text"><?= $fila['descripcio'] ?></p>
                        <form method="post" action="php_controllers/eliminar.php">
                            <input type="hidden" name="id" value="<?= $fila['carta_id'] ?>">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                                <button type="button" class="btn btn-dark btn-sm" onclick="mostrarFormularioEditar(<?= $fila['carta_id'] ?>)">EDITAR</button>
                            </div>
                            <div style="float: right;">
                                <?= selectTiposcarta($fila['carta_id']) ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    




<div class="botonmas">
    <button type="button" onclick="mostrarFormulario()" class="btn btn-success btn-circle btn-xl float-right">+</button>
    <div class="container hidden-form hidden-form-agregar">
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
                <button class="btn btn-primary mt-2" name="agregar" type="submit">Agregar</button>
                <button class="btn btn-secondary mt-2" name="cancel" onclick="location.reload()" >Cancelar</button>
                </div>

            </form>
        </div>
    </div>
</div>
 
<div class="container hidden-form hidden-form-editar">
    <div class="container">
        <form action="php_controllers/editarControler.php" method="POST" enctype="multipart/form-data">
            <div>
                <div class="tituloform">
                  
                    <h6 class="nuevacartatitulo">Editar Carta</h6>
                </div>
                <input type="hidden" name="accion" value="editar">

                <label for="nom">Nombre del Pokemon</label><br>
                <input type="text" id="nomE" name="nom" class="form-control" required>
            </div>
            <div>
                <label for="generacion_id">Generación</label><br>
                <input type="number" id="generacio_idE" name="generacio_id" min="1" max="9" class="form-control" required>
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
                <textarea class="form-control" name="descripcio" placeholder="Descripción del Pokémon." id="descripcioE" required></textarea>
            </div>
            <div>
                <label for="pokefile">Imagen:</label><br>
                <div class="imagenagregar">
                    <input type="file" name="imagen" id="imagenE" class="pokefile" accept="image/*">
                </div>
            </div>
            <div class="btn-group">
            <input type="hidden" name="carta_id" id="carta_idE" value="">

            <button class="btn btn-primary mt-2" name="editar" type="submit">Editar</button>
    <button class="btn btn-secondary mt-2" name="cancel" onclick="location.reload()">Cancelar</button>
</div>
        </form>
    </div>
</div>
</div>
</div>
</body>
</html>
