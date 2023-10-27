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
    $html .= '<img class="card-img-top" src="' . $fila['imatge'] . '" alt="Card image cap">';
    $html .= '<div class="card-body">';
    $html .= '<h5 class="card-title">' . $fila['nom'] . '</h5>';
    $html .= '<p class="card-text">' . $fila['descripcio'] . '</p>';
    $html .= '<form method="post" action="eliminar.php">';
    $html .= '<input type="hidden" name="id" value="' . $fila['carta_id'] . '">';
    $html .= '<button type="submit" class="btn btn-danger">Eliminar</button>';
    $html .= '</form>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
  }

  $conexion = closebd();

  // Devolver el HTML
  return $html;
}


function eliminarCarta($id) {
  $conexion = openbd();
  $sentenciaText = "DELETE FROM Carta WHERE carta_id = ?";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->execute([$id]);
  $conexion = closebd();
  return true; // Puedes retornar true si la eliminación fue exitosa
}


?>
