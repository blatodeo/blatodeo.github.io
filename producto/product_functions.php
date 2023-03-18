<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




    $conexion= mysqli_connect("localhost", "root", "", "alcon");

    if(isset($_POST['agregar_producto'])){

        if(strlen($_POST['codigo']) >=1 && strlen($_POST['linea'])  >=1 && strlen($_POST['descripcion_producto'])  >=1){
    
        $codigo = trim($_POST['codigo']);
        $linea = trim($_POST['linea']);
        $descripcion_producto = trim($_POST['descripcion_producto']);
    
    
        $consulta= "INSERT INTO producto (codigo, linea, descripcion_producto)
        VALUES ('$codigo', '$linea','$descripcion_producto')";
    
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
    
        header('Location: ../producto/productos.php');
      }
    }

   
require_once ("../conexion/_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros

        case 'editar_producto':
            editar_producto();
            break; 

            case 'eliminar_producto';
            eliminar_producto();
    
            break;

            case 'acceso_user';
            acceso_user();
            break;

            case 'agregar_mp_formula';
            agregar_mp_formula();
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


    


    function editar_producto() {
		$conexion=mysqli_connect("localhost","root","","alcon");
		extract($_POST);
		$consulta="UPDATE producto SET linea = '$linea', descripcion_producto = '$descripcion_producto'  WHERE codigo = '$codigo' ";

		mysqli_query($conexion, $consulta);

		header('Location: ../producto/productos.php');
    }

        function eliminar_producto() {
            $conexion=mysqli_connect("localhost","root","","alcon");
            extract($_POST);
            $codigo= $_POST['codigo'];
            $consulta= "DELETE FROM producto WHERE codigo= $codigo";
        
            mysqli_query($conexion, $consulta);
        
        
            header('Location: ../producto/productos.php');
        
        }

    function agregar_mp_formula(){
        $conexion=mysqli_connect("localhost","root","","alcon");
        extract($_POST);
        $codigo_producto = $_POST['codigo_producto'];
        $codigo_mp = $_POST['codigo_mp'];

        // Agregar los datos a la tabla correspondiente usando una consulta SQL
        $consulta = "INSERT INTO formula SET codigo_producto='$codigo_producto', codigo_mp='$codigo_mp'";
        mysqli_query($conexion, $consulta);

        // Redireccionar al usuario de vuelta a la página detalles_producto.php
        header('Location: detalles_producto.php?codigo_producto=' . $codigo_producto . '&descripcion_producto=' . $descripcion_producto);
        

    }

     ?>   
