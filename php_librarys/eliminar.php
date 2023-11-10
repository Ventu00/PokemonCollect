<?php
require_once('../php_librarys/back.php');
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carta_id = $_POST['id'];
    eliminarCarta($carta_id);
    // Redirigeix o realitza altres accions necessàries després de l'eliminació.
  }
  header('Location: ../index.php');
  exit();
?>
