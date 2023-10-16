<?php

function openbd(){

$servername = "localhost";
$username = "root";
$password = "";


  $conexion = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
  // set the PDO error mode to exception
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexion->exec('set names utf8');

  return $conexion;
} 

function closebd(){
    return null;
}


?>
