<?php
require_once('../php_librarys/back.php');

if (isset($_POST['insert'])) {
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $imatge = $_POST['imatge'];
    $generacion_id = $_POST['generacion_id']; // Asegúrate de tener un campo para la generación en tu formulario
    $tipos = $_POST['tipos']; // Supongamos que 'tipos' es un array que contiene los ID de los tipos seleccionados

    // Llama a la función para insertar la carta
    insertCarta($nom, $descripcio, $imatge, $generacion_id, $tipos);

    // Redirige a la página principal o a donde desees después de la inserción
    header('Location: ../index.php');
    exit();
}
?>
