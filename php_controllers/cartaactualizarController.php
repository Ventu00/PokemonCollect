<?php
if(isset($_GET['id'])){
$id=$_GET['id']
updateCarta($id);
header('Location: ../index.php');

}
exit();
?>