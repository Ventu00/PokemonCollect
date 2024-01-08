<?php

function openbd(){

$servername = "localhost";
$username = "root";
$password = "";


  $conexion = new PDO("mysql:host=$servername;dbname=cartasPokemon", $username, $password);
  // set the PDO error mode to exception
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexion->exec('set names utf8');

  return $conexion;
} 

function closebd(){
    return null;
}


///////////////////////////////////////////////////////////////Funciones selección

function selectTipus() {
  $conexion = openbd();
  $sentenciaText = "SELECT * FROM Tipus";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->execute();
  $resultado = $sentencia->fetchAll();

  $html = '<select class="form-select" id="tipus_id" name="tipus_id_1" required>  ';
  foreach ($resultado as $fila) {
    if (array_key_exists('nomt', $fila)) {
      $html .= '<option value="' . $fila['tipus_id'] . '">' . $fila['nomt'] . '</option>';
    } else {
      echo "La clave 'nomt' no existe en el array fila.";
    }
  }
  $html .= '</select>';
  
  $conexion = closebd();
  return $html;
}

function selectTipus2() {
  $conexion = openbd();
  $sentenciaText = "SELECT * FROM Tipus";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->execute();
  $resultado = $sentencia->fetchAll();

  $html = '<select class="form-select" id="tipus_id" name="tipus_id_2" required>  ';
  foreach ($resultado as $fila) {
    if (array_key_exists('nomt', $fila)) {
      $html .= '<option value="' . $fila['tipus_id'] . '">' . $fila['nomt'] . '</option>';
    } else {
      echo "La clave 'nomt' no existe en el array fila.";
    }
  }
  $html .= '</select>';
  

  $conexion = closebd();
  return $html;
}



function selectTiposcarta($carta_id) {
  $conexion = openbd();

    // Consulta para  tipos
  $sentenciaTextTipos = " SELECT TT.carta_id, T1.nomt as tipo_1, T2.nomt as tipo_2
                        FROM Te_Tipus TT
                        INNER JOIN Tipus T1 ON TT.tipus_id_1 = T1.tipus_id
                        INNER JOIN Tipus T2 ON TT.tipus_id_2 = T2.tipus_id
                        WHERE TT.carta_id = :carta_id";
                        
  $sentenciaTipos = $conexion->prepare($sentenciaTextTipos);
  $sentenciaTipos->bindParam(':carta_id', $carta_id);
  $sentenciaTipos->execute();
  $resultadoTipos = $sentenciaTipos->fetchAll();




  // Consulta para  la generación
  $sentenciaTextGeneracion = "SELECT G.numerog
                             FROM Generacio G
                             INNER JOIN Pertany_a P ON G.generacio_id = P.generacio_id
                             WHERE P.carta_id = :carta_id";

  $sentenciaGeneracion = $conexion->prepare($sentenciaTextGeneracion);
  $sentenciaGeneracion->bindParam(':carta_id', $carta_id);
  $sentenciaGeneracion->execute();
  $generacion = $sentenciaGeneracion->fetchColumn();



  // Agregar la tipos

  $html = '<div class="tiposcontainer">';
  $html .= '<div class="fuentestitulotipo";><strong>Tipo 1</strong><span class="spantipo"><strong>Tipo 2</strong></span></div>';
  foreach ($resultadoTipos as $fila) {
      $html .= '<div class="tipostabla">';
      $html .= '<span>' . $fila['tipo_1'] . '</span>';
      $html .= '<span class="contenidotipospan" ><strong>-</strong></span>';
      $html .= '<span class="contenidotipospan" >' . $fila['tipo_2'] . '</span>';
      $html .= '</div>';
  }

  // Agregar la generación
  $html .= '<div class="generacioninfo" ><strong>Generación:</strong> ' . $generacion . '</div>';

  $html .= '</div>';

  $conexion = closebd();
  return $html;
}

function selectCarta() {
  $conexion = openbd();
  $sentenciaText = "SELECT * FROM Carta";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->execute();
  $resultado = $sentencia->fetchAll();

  $html = '';
  foreach ($resultado as $fila) {
    $html .= '<div class="col-sm mt-4">';
    $html .= '<div class="card"">';
    if (!empty($fila['imagen'])) {
      $html .= "<img src='" . $fila['imagen'] . "' class='card-img-top' alt='Imagen de la carta'>";
    }
    $html .= '<div class="card-body">';
    $html .= '<h5 class="card-title">' . $fila['nom'] . '</h5>';
    $html .= '<p class="card-text">' . $fila['descripcio'] . '</p>';
    $html .= '<form method="post" action="php_controllers/eliminar.php">';
    $html .= '<input type="hidden" name="id" value="' . $fila['carta_id'] . '">';
    $html .= '<div class="btn-group">';
    $html .= '<button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>';
    $html .= '<button type="button" class="btn btn-dark btn-sm" onclick="mostrarFormularioEditar(' . $fila['carta_id'] . ')">EDITAR</button>';
    $html .= '</div>';
    
    
    $html .= '<div  style="float: right;">';
    $html .= selectTiposcarta($fila['carta_id']);
    $html .= '</div>';
    $html .= '</form>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
  }

  return $html;
}



///////////////////////////////////////////////////////  Funciones de controladores

function insertCarta($nom, $descripcio, $generacio_id, $tipus_id_1, $tipus_id_2, $imagen) {
  echo "funciona";
  $conexion = openBd();

  $sentenciaText = "INSERT INTO Carta (nom, descripcio, imagen) VALUES (:nom, :descripcio, :imagen)";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':nom', $nom);
  $sentencia->bindParam(':descripcio', $descripcio);
  $sentencia->bindParam(':imagen', $imagen);
  $sentencia->execute();

  // Obtiene el ID de la carta recién insertada
  $carta_id = $conexion->lastInsertId();

  $sentenciaText = "INSERT INTO Pertany_a (carta_id, generacio_id) VALUES (:carta_id, :generacio_id)";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->bindParam(':generacio_id', $generacio_id);
  $sentencia->execute();

  $sentenciaText = "INSERT INTO Te_Tipus (carta_id, tipus_id_1, tipus_id_2) VALUES (:carta_id, :tipus_id_1, :tipus_id_2)";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->bindParam(':tipus_id_1', $tipus_id_1);
  $sentencia->bindParam(':tipus_id_2', $tipus_id_2);
  $sentencia->execute();

  $conexion = closeBd();
}

function updateCarta($carta_id, $nom, $descripcio, $generacio_id, $tipus_1, $tipus_2, $imagen) {
  $conexion = openBd();

  $sentenciaText = "UPDATE Carta SET nom = :nom, descripcio = :descripcio, imagen = :imagen WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->bindParam(':nom', $nom);
  $sentencia->bindParam(':descripcio', $descripcio);
  $sentencia->bindParam(':imagen', $imagen);
  $sentencia->execute();

  // Actualiza la relación con la generación en la tabla 'Pertany_a'
  $sentenciaText = "UPDATE Pertany_a SET generacio_id = :generacio_id WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->bindParam(':generacio_id', $generacio_id);
  $sentencia->execute();

  // Actualiza la relación con los tipos en la tabla 'Te_Tipus' (relación N-M)
  $sentenciaText = "UPDATE Te_Tipus SET tipus_id_1 = :tipus_id_1, tipus_id_2 = :tipus_id_2 WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->bindParam(':tipus_id_1', $tipus_1);
  $sentencia->bindParam(':tipus_id_2', $tipus_2);
  $sentencia->execute();

  $conexion = closeBd();
}


function eliminarCarta($carta_id) {
  $conexion = openBd();

  $sentenciaText = "DELETE FROM Pertany_a WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->execute();

  $sentenciaText = "DELETE FROM Te_Tipus WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->execute();

  $sentenciaText = "DELETE FROM Carta WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->execute();

  $conexion = closeBd();
}


