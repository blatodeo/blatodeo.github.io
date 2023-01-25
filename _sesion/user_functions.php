<?php


   
require_once ("../conexion/_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros

        case 'editar_usuario':
            editar_usuario();
            break; 

            case 'eliminar_usuario';
            eliminar_usuario();
    
            break;

            case 'acceso_user';
            acceso_user();
            break;


		}

	}



    


    function editar_usuario() {
		$conexion=mysqli_connect("localhost","root","","alcon");
		extract($_POST);
		$consulta="UPDATE usuario SET nombre = '$nombre', correo = '$correo' , password = '$password', rol = '$rol'  WHERE id = '$id' ";

		mysqli_query($conexion, $consulta);

		header('Location: usuarios.php');
    }

        function eliminar_usuario() {
            $conexion=mysqli_connect("localhost","root","","alcon");
            extract($_POST);
            $id= $_POST['id'];
            $consulta= "DELETE FROM usuario WHERE id= $id";
        
            mysqli_query($conexion, $consulta);
        
        
            header('Location: usuarios.php');
        
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
        
