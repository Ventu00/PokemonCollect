<?php
require_once('../php_librarys/back.php');

if (isset($_POST['insert'])) {
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $generacio_id = $_POST['generacio_id'];
    $tipus = $_POST['tipus_id']; 

    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = "C:/xampp/htdocs/Colleccions/PokemonCollect/imagenesserver/"; 
    $findestino = $carpeta_destino.$imagen;
    $findestinobd = "/Colleccions/PokemonCollect/imagenesserver/".$imagen;
  
    move_uploaded_file($imagen_temp, $findestino);
  
    insertCarta($nom, $descripcio, $generacio_id, $tipus, $findestinobd);

    header('Location: ../index.php');
    exit();


}
?>
