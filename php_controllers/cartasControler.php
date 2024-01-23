<?php
require_once('../php_librarys/back.php');
?>
<?php   

if (isset($_POST['agregar'])) {
    $accion = $_POST['accion'];

    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $generacio_id = $_POST['generacio_id'];
    $tipus_1 = $_POST['tipus_id_1']; 
    $tipus_2 = $_POST['tipus_id_2']; 


    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = "C:/xampp/htdocs/Colleccions/PokemonCollect/imagenesserver/"; 
    $findestino = $carpeta_destino.$imagen;
    $findestinobd = "/Colleccions/PokemonCollect/imagenesserver/".$imagen;

    if(isset($SESSION['error'])){
        move_uploaded_file($imagen_temp, $findestino);
  
        insertCarta($nom, $descripcio, $generacio_id, $tipus_1, $tipus_2, $findestinobd);
    
    header('Location: ../index.php');
    exit();
    }else{
        header('Location: ../index.php');
        exit();
    }
  

}?>


<?php
/*
require_once('../php_librarys/back.php');
*/

/*
if (isset($_POST['agregar'])) {
    $accion = $_POST['accion'];

    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $generacio_id = $_POST['generacio_id'];
    $tipus_1 = $_POST['tipus_id_1']; 
    $tipus_2 = $_POST['tipus_id_2']; 


    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = "C:/xampp/htdocs/Colleccions/PokemonCollect/imagenesserver/"; 
    $findestino = $carpeta_destino.$imagen;
    $findestinobd = "/Colleccions/PokemonCollect/imagenesserver/".$imagen;
  
    move_uploaded_file($imagen_temp, $findestino);
  
    insertCarta($nom, $descripcio, $generacio_id, $tipus_1, $tipus_2, $findestinobd);

    echo "pizza";
    header('Location: ../index.php');
    exit();
}
*/
?>

