<?php
$conexion= mysqli_connect("localhost", "root", "", "alcon");

if(isset($_POST['registrar'])){

    if(strlen($_POST['id']) >=1 && strlen($_POST['nombre'])  >=1 &&  strlen($_POST['correo']) >=1 &&
     strlen($_POST['password']) >=1 &&
     strlen($_POST['rol']) >= 1){
    $id = trim($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);
    $rol = trim($_POST['rol']);



    $consulta= "INSERT INTO usuario (id, nombre, correo, password, rol)
    VALUES ('$id', '$nombre', '$correo', '$password', '$rol')";

    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);

    header('Location: usuarios.php');
  }
}









?>