<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    include 'back.php'; 
    if (eliminarCarta($id)) {
      echo 'success';
      header('Location: index.php'); // Redirige a la página principal
      exit;
    } else {
      echo 'error';
    }
  } else {
    echo 'error';
  }
  
?>
