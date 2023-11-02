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
    $html .= '<button type="submit" class="btn btn-danger">ELIMINAR</button>';
    $html .= '</form>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
 }
 
 
  $conexion = closebd();
 
  // Devolver el HTML
  return $html;
 }

 function insertCarta($nom, $descripcio, $imatge, $generacion_id, $tipos) {
  $conexion = openBd();
  
  // Primero, inserta la carta en la tabla 'carta'
  $sentenciaText = "INSERT INTO Carta (nom, descripcio, imatge) VALUES (:nom, :descripcio, :imatge)";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':nom', $nom);
  $sentencia->bindParam(':descripcio', $descripcio);
  $sentencia->bindParam(':imatge', $imatge);
  $sentencia->execute();

  // Obtiene el ID de la carta recién insertada
  $carta_id = $conexion->lastInsertId();

  // Inserta la relación entre la carta y la generación en la tabla 'carta_generacion'
  $sentenciaText = "INSERT INTO Generacio (carta_id, generacion_id) VALUES (:carta_id, :generacion_id)";
  $sentencia = $conexion->prepare($sentenciaText);
  $sentencia->bindParam(':carta_id', $carta_id);
  $sentencia->bindParam(':generacion_id', $generacion_id);
  $sentencia->execute();

  // Inserta la relación entre la carta y los tipos en la tabla 'carta_tipo' (relación N-M)
  foreach ($tipos as $tipo_id) {
      $sentenciaText = "INSERT INTO Tipus (carta_id, tipo_id) VALUES (:carta_id, :tipo_id)";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->bindParam(':carta_id', $carta_id);
      $sentencia->bindParam(':tipo_id', $tipo_id);
      $sentencia->execute();
  }

  $conexion = closeBd();
}

