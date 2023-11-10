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

function selectTipus() {
  $conexion = openbd();
  $sentenciaText = "SELECT * FROM Tipus";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->execute();
  $resultado = $sentencia->fetchAll();

  $html = '<select class="form-select" id="tipus_id" name="tipus_id" required>  ';
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


function selectCarta() {
  $conexion = openbd();
  $sentenciaText = "SELECT * FROM Carta";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->execute();
  $resultado = $sentencia->fetchAll();

  // Crear un HTML
  $html = '';
  foreach ($resultado as $fila) {
    $html .= '<div class="col-sm mt-4">';
    $html .= '<div class="card" style="width: 18rem;">';

    // Mostrar la imagen si está disponible
    if (!empty($fila['imagen'])) {
      $html .= "<img src='" . $fila['imagen'] . "' class='card-img-top' alt='Imagen de la carta'>";
    }

    $html .= '<div class="card-body">';
    $html .= '<h5 class="card-title">' . $fila['nom'] . '</h5>';
    $html .= '<p class="card-text">' . $fila['descripcio'] . '</p>';
    $html .= '<form method="post" action="php_librarys/eliminar.php">';
    $html .= '<input type="hidden" name="id" value="' . $fila['carta_id'] . '">';
    $html .= '<button type="submit" class="btn btn-danger">ELIMINAR</button>';
    $html .= '</form>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
  }

  return $html;
}

 function insertCarta($nom, $descripcio, $generacio_id, $tipos, $imagen) {
  $conexion = openBd();
  
  // Primero, inserta la carta en la tabla 'carta'
  $sentenciaText = "INSERT INTO Carta (nom, descripcio, imagen) VALUES (:nom, :descripcio, :imagen)";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':nom', $nom);
  $sentencia->bindParam(':descripcio', $descripcio);
  $sentencia->bindParam(':imagen', $imagen);

  $sentencia->execute();

  // Obtiene el ID de la carta recién insertada
  $carta_id = $conexion->lastInsertId();

  // Inserta la relación entre la carta y la generación en la tabla 'carta_generacion'
  $sentenciaText = "INSERT INTO Pertany_a (carta_id, generacio_id) VALUES (:carta_id, :generacio_id)";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->bindParam(':generacio_id', $generacio_id);
  $sentencia->execute();

  // Inserta la relación entre la carta y los tipos en la tabla 'carta_tipo' (relación N-M)
  foreach ($tipus as $tipus_id) {
      $sentenciaText = "INSERT INTO Te_Tipus (carta_id, tipus_id) VALUES (:carta_id, :tipus_id)";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->bindParam(':carta_id', $carta_id);
      $sentencia->bindParam(':tipus_id', $tipus_id);
      $sentencia->execute();
  }

  $conexion = closeBd();
}
function eliminarCarta($carta_id) {
  $conexion = openBd();

  // Elimina la relació entre la carta i la generació en la taula 'pertany_a'
  $sentenciaText = "DELETE FROM Pertany_a WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->execute();

  // Elimina la relació entre la carta i els tipus en la taula 'te_tipus'
  $sentenciaText = "DELETE FROM Te_Tipus WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->execute();

  // Elimina la carta de la taula 'carta'
  $sentenciaText = "DELETE FROM Carta WHERE carta_id = :carta_id";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->execute();

  $conexion = closeBd();
}

