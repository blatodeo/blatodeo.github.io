<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $conexion= mysqli_connect("localhost", "root", "", "alcon");

    if(isset($_POST['agregar_precio'])){

        if(strlen($_POST['linea_precio']) >=1 && strlen($_POST['precio'])  >=1 && strlen($_POST['fecha'])  >=1){
    
        $linea_precio = trim($_POST['linea_precio']);
        $precio = trim($_POST['precio']);
        $fecha = trim($_POST['fecha']);
        $mp = trim($_POST['mp']);

    
    
        $consulta= "INSERT INTO precio_mp (linea_precio, precio, fecha, mp)
        VALUES ('$linea_precio', '$precio','$fecha','$mp')";
    
        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
    
        header('Location: ../precio_mp/precio.php?codigo=<?php echo $codigo ; ?>&descripcion=<?php echo $descripcion; ?>');
      }
    }

   
require_once ("../conexion/_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'agregar_precio':
            agregar_mp();
            break; 

        case 'editar_precio':
            editar_mp();
            break; 

            case 'eliminar_precio';
            eliminar_mp();
    
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

function agregar_mp() {
}

    


    function editar_mp() {
		$conexion=mysqli_connect("localhost","root","","alcon");
		extract($_POST);
		$consulta="UPDATE materia_prima SET linea = '$linea', descripcion = '$descripcion' , precio_mp = '$precio_mp' WHERE codigo = '$codigo' ";

		mysqli_query($conexion, $consulta);

		header('Location: ../mp/mp.php');
    }

        function eliminar_mp() {
            $conexion=mysqli_connect("localhost","root","","alcon");
            extract($_POST);
            $codigo= $_POST['codigo'];
            $consulta= "DELETE FROM materia_prima WHERE codigo= $codigo";
        
            mysqli_query($conexion, $consulta);
        
        
            header('Location: ../mp/mp.php');
        
        }
        



