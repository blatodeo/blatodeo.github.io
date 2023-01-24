<?php
    $conexion= mysqli_connect("localhost", "root", "", "alcon");

    if(isset($_POST['agregar_mp'])){

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

   
require_once ("_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'agregar_mp':
            agregar_mp();
            break; 

        case 'editar_mp':
            editar_mp();
            break; 

            case 'eliminar_mp';
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
		$consulta="UPDATE materia_prima SET linea = '$linea', descripcion = '$descripcion' , coste_kg = '$coste_kg' WHERE codigo = '$codigo' ";

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
        



