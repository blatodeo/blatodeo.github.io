<?php
$conexion= mysqli_connect("localhost", "root", "", "alcon");

if(isset($_POST['registrar'])){

    if(strlen($_POST['id']) >=1 && strlen($_POST['nombre'])  >=1 && strlen($_POST['password'])  >=1){
    $id = trim($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);


    $consulta= "INSERT INTO usuario (id, nombre, correo, password)
    VALUES ('$id', '$nombre', '$correo', '$password')";

    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);

    header('Location: usuarios.php');
  }
}









?>