<?php
require_once('../php_librarys/back.php');
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carta_id = $_POST['id'];
    eliminarCarta($carta_id);
  }
  header('Location: ../index.php');
  exit();
?>
