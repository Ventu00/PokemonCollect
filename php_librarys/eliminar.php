<?php
include("php_librarys/back.php");

$id = $_POST['id']; 

if (isset($id)) {
    try {
        $conexion = openbd();
        $sentenciaText = "DELETE FROM Carta WHERE carta_id = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        
        if ($sentencia->rowCount() > 0) {
            echo "<script language='JavaScript'>
                alert('La carta se eliminó de la BD');
                location.assign('back.php')</script>";
        } else {
            echo "<script language='JavaScript'>
                alert('La carta NO se eliminó de la BD');
                location.assign('back.php')</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    $conexion = closebd();
} else {
    echo "No se proporcionó un ID válido para eliminar.";
}
?>
