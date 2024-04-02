<?php
require_once('../php_librarys/back.php');

// Primero
if(isset($_GET['id'])){
    $id=$_GET['id'];
    updateCarta($id);
    header('Location: ../index.php');
    exit();
}

// Segundo
if (isset($_POST['agregar'])) {
    $accion = $_POST['accion'];
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $generacio_id = $_POST['generacio_id'];
    $tipus_1 = $_POST['tipus_id_1']; 
    $tipus_2 = $_POST['tipus_id_2']; 
    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = "../imagenesserver/"; 
    $findestino = $carpeta_destino.$imagen;
    $findestinobd = "/Colleccions/PokemonCollect/imagenesserver/".$imagen;
    move_uploaded_file($imagen_temp, $findestino);
    insertCarta($nom, $descripcio, $generacio_id, $tipus_1, $tipus_2, $findestinobd);
    header('Location: ../index.php');
    exit();
}

// Tercero
if (isset($_POST['editar'])) {
    $accion = $_POST['accion'];
    $carta_id = $_POST['carta_id'];
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $generacio_id = $_POST['generacio_id'];
    $tipus_1 = $_POST['tipus_id_1']; 
    $tipus_2 = $_POST['tipus_id_2']; 
    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = "../imagenesserver/"; 
    $findestino = $carpeta_destino.$imagen;
    $findestinobd = "/Colleccions/PokemonCollect/imagenesserver/".$imagen;
    move_uploaded_file($imagen_temp, $findestino);
    updateCarta($carta_id, $nom, $descripcio, $generacio_id, $tipus_1, $tipus_2, $findestinobd);
    header('Location: ../index.php');
    exit();
}

// Cuarto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carta_id = $_POST['id'];
    eliminarCarta($carta_id);
}
header('Location: ../index.php');
exit();
?>
