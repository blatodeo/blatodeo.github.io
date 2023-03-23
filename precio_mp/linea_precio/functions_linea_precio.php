<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $conexion= mysqli_connect("localhost", "root", "", "alcon");

    if(isset($_POST['agregar_linea_precio'])){

    
        $linea = trim($_POST['linea']);
    
        $consulta= "INSERT INTO linea_precio (linea)
        VALUES ('$linea')";
    
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
    
        header('Location: linea_precio.php');
      }
    

   
require_once ("../../conexion/_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'agregar_linea':
            agregar_linea();
            break; 

        case 'editar_linea_precio':
            editar_linea_precio();
            break; 

            case 'eliminar_linea_precio';
            eliminar_linea_precio();
    
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

function agregar_linea() {
}

    


    function editar_linea_precio() {
		$conexion=mysqli_connect("localhost","root","","alcon");
		extract($_POST);
		$consulta="UPDATE linea_precio SET linea = '$linea' WHERE id = '$id' ";

		mysqli_query($conexion, $consulta);

		header('Location: linea_precio.php');
    }

        function eliminar_linea_precio() {
            $conexion=mysqli_connect("localhost","root","","alcon");
            extract($_POST);
            $id= $_POST['id'];
            $consulta= "DELETE FROM linea_precio WHERE id= $id";
        
            mysqli_query($conexion, $consulta);
        
        
            header('Location: linea_precio.php');
        
        }
        

