<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $conexion= mysqli_connect("localhost", "root", "", "alcon");

    if(isset($_POST['agregar_linea_producto'])){

    
        $linea = trim($_POST['linea']);
    
        $consulta= "INSERT INTO linea_producto (linea)
        VALUES ('$linea')";
    
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
    
        header('Location: lineas_producto.php');
      }
    

   
require_once ("../conexion/_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'agregar_linea':
            agregar_linea();
            break; 

        case 'editar_linea_producto':
            editar_linea_producto();
            break; 

            case 'eliminar_linea_producto';
            eliminar_linea_producto();
    
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

    


    function editar_linea_producto() {
		$conexion=mysqli_connect("localhost","root","","alcon");
		extract($_POST);
		$consulta="UPDATE linea_producto SET linea = '$linea' WHERE id = '$id' ";

		mysqli_query($conexion, $consulta);

		header('Location: lineas_producto.php');
    }

        function eliminar_linea_producto() {
            $conexion=mysqli_connect("localhost","root","","alcon");
            extract($_POST);
            $id= $_POST['id'];
            $consulta= "DELETE FROM linea_producto WHERE id= $id";
        
            mysqli_query($conexion, $consulta);
        
        
            header('Location: lineas_producto.php');
        
        }
        

