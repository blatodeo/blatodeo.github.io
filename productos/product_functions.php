<?php
    $conexion= mysqli_connect("localhost", "root", "", "alcon");

    if(isset($_POST['agregar_producto'])){

        if(strlen($_POST['codigo_producto']) >=1 && strlen($_POST['linea'])  >=1 && strlen($_POST['descripcion'])  >=1){
    
        $codigo_producto = trim($_POST['codigo_producto']);
        $linea = trim($_POST['linea']);
        $descripcion = trim($_POST['descripcion']);
        $coste_ton = trim($_POST['coste_ton']);
    
    
        $consulta= "INSERT INTO producto (codigo_producto, linea, descripcion, coste_ton)
        VALUES ('$codigo_producto', '$linea','$descripcion','$coste_ton')";
    
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
    
        header('Location: ../productos/productos.php');
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


		}

	}



    


    function editar_producto() {
		$conexion=mysqli_connect("localhost","root","","alcon");
		extract($_POST);
		$consulta="UPDATE producto SET linea = '$linea', descripcion = '$descripcion' , coste_ton = '$coste_ton'  WHERE codigo_producto = '$codigo_producto' ";

		mysqli_query($conexion, $consulta);

		header('Location: productos.php');
    }

        function eliminar_producto() {
            $conexion=mysqli_connect("localhost","root","","alcon");
            extract($_POST);
            $codigo_producto= $_POST['codigo_producto'];
            $consulta= "DELETE FROM producto WHERE codigo_producto= $codigo_producto";
        
            mysqli_query($conexion, $consulta);
        
        
            header('Location: productos.php');
        
        }
        


        function acceso_user(){
            $nombre=$_POST['nombre'];
            $password=$_POST['password'];
            session_start();
            $_SESSION['nombre']=$nombre;
        
            $conexion=mysqli_connect("localhost","root","","alcon");
            $consulta= "SELECT * FROM usuario WHERE nombre='$nombre' AND password='$password'";
            $resultado=mysqli_query($conexion, $consulta);
            $filas=mysqli_fetch_array($resultado);
        
            if($filas['rol'] == 1){ //admin
        
                header('Location: usuarios.php');
        
            }else if($filas['rol'] == 2){//lector
                header('Location: lector_usuario.php');
            }
            
            
            else{
        
                header('Location: login.php');
                session_destroy();
        
            }
          
        }
        
