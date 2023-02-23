<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    
      


   
require_once ("../conexion/_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'agregar_mp_formula':
            agregar_mp_formula();
            break; 

        case 'editar_mp':
            editar_mp();
            break; 

            case 'eliminar_formula';
            eliminar_formula();
    
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

        header('Location: index.php');
        session_destroy();

    }

  
}

function agregar_mp_formula() {
    $link = mysqli_connect("localhost", "root", "");
    if($link){
        mysqli_select_db($link, "alcon");
        mysqli_query($link, "SET NAMES 'utf8'");
    }
    

    $codigo_mp = $_POST['codigo_mp'];
    $codigo_producto= $_POST['codigo_producto'];
    $ficha22 = "INSERT INTO formula SET codigo_mp='$codigo_mp', codigo_producto='$codigo_producto'  ";
    mysqli_query($link, $ficha22);
    
    header('Location: ../producto/productos.php');


}

    


    function editar_mp() {
		$conexion=mysqli_connect("localhost","root","","alcon");
		extract($_POST);
		$consulta="UPDATE materia_prima SET linea = '$linea', descripcion = '$descripcion' , coste_kg = '$coste_kg' WHERE codigo = '$codigo' ";

		mysqli_query($conexion, $consulta);

		header('Location: ../mp/mp.php');
    }

        function eliminar_formula() {
            $conexion=mysqli_connect("localhost","root","","alcon");
            extract($_POST);
            $id= $_POST['id'];
            $consulta= "DELETE FROM formula WHERE id = '$id'";
        
            mysqli_query($conexion, $consulta);
        
        
            header('Location: ../producto/productos.php');
        
        }
        



