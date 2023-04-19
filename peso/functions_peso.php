<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $conexion= mysqli_connect("localhost", "root", "", "alcon");

    if(isset($_POST['agregar_peso'])){

        if(strlen($_POST['peso']) >=1 && strlen($_POST['fecha'])  >=1){

        $peso = trim($_POST['peso']);
        $fecha = trim($_POST['fecha']);
        $mp = trim($_POST['mp']);



        $consulta= "INSERT INTO peso (peso, fecha, mp)
        VALUES ('$peso','$fecha','$mp')";

        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);



    // Obtener los valores de $codigo y $descripcion_producto de $_POST
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];

    // Verificar que los valores existen antes de redirigir
    if (isset($codigo) && isset($descripcion)) {
        $url = "peso.php?codigo=$codigo&descripcion=$descripcion";
        header("Location: $url");
    }

        }
    }
require_once ("../conexion/_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros

        case 'editar_peso':
            editar_peso();
            break; 

            case 'eliminar_peso';
            eliminar_peso();

            break;

            case 'acceso_user';
            acceso_user();
            break;


		}

	}
    function acceso_user(){
    $nombre=$_POST['nombre'];
    $password=$_POST['password'];
    session_start();
    $_SESSION['nombre']=$nombre;

    $conexion=mysqli_connect("localhost","root","","alcon");
    $consulta= "SELECT * FROM usuario WHERE nombre='$nombre' AND password='$password'";
    $resultado=mysqli_query($conexion, $consulta);
    $filas=mysqli_num_rows($resultado);

    if($filas){

        header('Location: ../views/mp.php');

    }else{

        header('Location: login.php');
        session_destroy();

    }


}





    function editar_peso() {
		$conexion=mysqli_connect("localhost","root","","alcon");
		extract($_POST);
		$consulta="UPDATE peso SET peso = '$peso', fecha = '$fecha' WHERE id = '$id' ";

		mysqli_query($conexion, $consulta);

    // Obtener los valores de $codigo y $descripcion_producto de $_POST
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];

     //Verificar que los valores existen antes de redirigir
    if (isset($codigo) && isset($descripcion)) {
        $url = "peso.php?codigo=$codigo&descripcion=$descripcion";
        header("Location: $url");
    }
    }

    

    function eliminar_peso() {
        $conexion=mysqli_connect("localhost","root","","alcon");
        extract($_POST);
        $id= $_POST['id'];
        $consulta= "DELETE FROM peso WHERE id= $id"; 

        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);

        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
    
        // Verificar que los valores existen antes de redirigir
        if (isset($codigo) && isset($descripcion)) {
            $url = "peso.php?codigo=$codigo&descripcion=$descripcion";
            header("Location: $url");
        }
    

    }
    


    