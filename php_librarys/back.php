<?php
session_start();

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
  try {
      $conexion = openbd();

      $sentenciaText = "SELECT * FROM Tipus";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->execute();
      $resultado = $sentencia->fetchAll();

      $html = '<select class="form-select" id="tipus_id" name="tipus_id_1" required>';
      foreach ($resultado as $fila) {
          if (array_key_exists('nomt', $fila)) {
              $html .= '<option value="' . $fila['tipus_id'] . '">' . $fila['nomt'] . '</option>';
          } else {
              throw new Exception("La clave 'nomt' no existe en el array fila.");
          }
      }
      $html .= '</select>';

      closebd($conexion);
      return $html;
  } catch (PDOException $e) {
      $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
      return false;
  } catch (Exception $ex) {
      $_SESSION['error'] = $ex->getMessage();
      return false;
  }
}


function selectTipus2() {
  try {
      $conexion = openbd();

      $sentenciaText = "SELECT * FROM Tipus";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->execute();
      $resultado = $sentencia->fetchAll();

      $html = '<select class="form-select" id="tipus_id" name="tipus_id_2" required>';
      foreach ($resultado as $fila) {
          if (array_key_exists('nomt', $fila)) {
              $html .= '<option value="' . $fila['tipus_id'] . '">' . $fila['nomt'] . '</option>';
          } else {
              throw new Exception("La clave 'nomt' no existe en el array fila.");
          }
      }
      $html .= '</select>';

      closebd($conexion);
      return $html;
  } catch (PDOException $e) {
      $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
      return false;
  } catch (Exception $ex) {
      $_SESSION['error'] = $ex->getMessage();
      return false;
  }
}




function selectTiposcarta($carta_id) {
  try {
      $conexion = openbd();

      // Consulta para tipos
      $sentenciaTextTipos = "SELECT TT.carta_id, T1.nomt AS tipo_1, T2.nomt AS tipo_2
                          FROM Te_Tipus TT
                          INNER JOIN Tipus T1 ON TT.tipus_id_1 = T1.tipus_id
                          INNER JOIN Tipus T2 ON TT.tipus_id_2 = T2.tipus_id
                          WHERE TT.carta_id = :carta_id";

      $sentenciaTipos = $conexion->prepare($sentenciaTextTipos);
      $sentenciaTipos->bindParam(':carta_id', $carta_id);
      $sentenciaTipos->execute();
      $resultadoTipos = $sentenciaTipos->fetchAll();

      // Consulta para la generación
      $sentenciaTextGeneracion = "SELECT G.numerog
                                  FROM Generacio G
                                  INNER JOIN Pertany_a P ON G.generacio_id = P.generacio_id
                                  WHERE P.carta_id = :carta_id";

      $sentenciaGeneracion = $conexion->prepare($sentenciaTextGeneracion);
      $sentenciaGeneracion->bindParam(':carta_id', $carta_id);
      $sentenciaGeneracion->execute();
      $generacion = $sentenciaGeneracion->fetchColumn();

      // Generar HTML
      $html = '<div class="tiposcontainer">';
      $html .= '<div class="fuentestitulotipo"><strong>Tipo 1</strong><span class="spantipo"><strong>Tipo 2</strong></span></div>';
      foreach ($resultadoTipos as $fila) {
          $html .= '<div class="tipostabla">';
          $html .= '<span>' . $fila['tipo_1'] . '</span>';
          $html .= '<span class="contenidotipospan"><strong>-</strong></span>';
          $html .= '<span class="contenidotipospan">' . $fila['tipo_2'] . '</span>';
          $html .= '</div>';
      }

      // Agregar la generación
      $html .= '<div class="generacioninfo"><strong>Generación:</strong> ' . $generacion . '</div>';

      $html .= '</div>';

      closebd($conexion);
      return $html;
  } catch (PDOException $e) {
      $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
      return false;
  }
}


function selectCarta() {
  try {
      $conexion = openbd();

      $sentenciaText = "SELECT * FROM Carta";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->execute();
      $resultado = $sentencia->fetchAll();

      closebd($conexion);

      return $resultado;
  } catch (PDOException $e) {
      $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
      return false;
  }
}




///////////////////////////////////////////////////////  Funciones de controladores

function insertCarta($nom, $descripcio, $generacio_id, $tipus_id_1, $tipus_id_2, $imagen) {
  $conexion = openBd();
  try {
    // Inicia la transacción
    $conexion->beginTransaction();

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

    // Confirma la transacción
    $conexion->commit();
    $conexion = closeBd();

  } catch(PDOException $e) {
    // Revierte la transacción si hay un error
    $conexion->rollback();
    $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
  }
}


function updateCarta($carta_id, $nom, $descripcio, $generacio_id, $tipus_1, $tipus_2, $imagen) {
  $conexion = openBd();
  try {
      $conexion->beginTransaction();

      // Actualizamos la carta
      $sentenciaText = "UPDATE Carta SET nom = :nom, descripcio = :descripcio, imagen = :imagen WHERE carta_id = :carta_id";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->bindParam(':carta_id', $carta_id);
      $sentencia->bindParam(':nom', $nom);
      $sentencia->bindParam(':descripcio', $descripcio);
      $sentencia->bindParam(':imagen', $imagen);
      $sentencia->execute();

      // Actualizamos la relación con la generación en la tabla 'Pertany_a'
      $sentenciaText = "UPDATE Pertany_a SET generacio_id = :generacio_id WHERE carta_id = :carta_id";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->bindParam(':carta_id', $carta_id);
      $sentencia->bindParam(':generacio_id', $generacio_id);
      $sentencia->execute();

      // Actualizamos la relación con los tipos en la tabla 'Te_Tipus' (relación N-M)
      $sentenciaText = "UPDATE Te_Tipus SET tipus_id_1 = :tipus_id_1, tipus_id_2 = :tipus_id_2 WHERE carta_id = :carta_id";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->bindParam(':carta_id', $carta_id);
      $sentencia->bindParam(':tipus_id_1', $tipus_1);
      $sentencia->bindParam(':tipus_id_2', $tipus_2);
      $sentencia->execute();

      $conexion->commit();
      closeBd($conexion);
  } catch (Exception $e) {
      $conexion->rollback();
      $_SESSION['error'] = $e->getMessage();
  }
}



function eliminarCarta($carta_id) {
  $conexion = openBd();
  try {
      $conexion->beginTransaction();

      // Eliminamos la relación con la generación
      $sentenciaText = "DELETE FROM Pertany_a WHERE carta_id = :carta_id";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->bindParam(':carta_id', $carta_id);
      $sentencia->execute();

      // Eliminamos la relación con los tipos
      $sentenciaText = "DELETE FROM Te_Tipus WHERE carta_id = :carta_id";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->bindParam(':carta_id', $carta_id);
      $sentencia->execute();

      // Eliminamos la carta
      $sentenciaText = "DELETE FROM Carta WHERE carta_id = :carta_id";
      $sentencia = $conexion->prepare($sentenciaText);
      $sentencia->bindParam(':carta_id', $carta_id);
      $sentencia->execute();

      $conexion->commit();
      closebd($conexion);
  } catch (Exception $e) {
      $conexion->rollback();
      $_SESSION['error'] = $e->getMessage();
  }
}



