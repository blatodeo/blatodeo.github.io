<?php
$conexion= mysqli_connect("localhost", "root", "", "alcon");

if(isset($_POST['registrar_mp'])){

    if(strlen($_POST['codigo']) >=1 && strlen($_POST['linea'])  >=1 && strlen($_POST['descripcion'])  >=1){

    $codigo = trim($_POST['codigo']);
    $linea = trim($_POST['linea']);
    $descripcion = trim($_POST['descripcion']);
    $coste_kg = trim($_POST['coste_kg']);


    $consulta= "INSERT INTO materia_prima (codigo, linea, descripcion, coste_kg)
    VALUES ('$codigo', '$linea','$descripcion','$coste_kg')";

    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);

    header('Location: ../mp/mp.php');
  }
}









?>