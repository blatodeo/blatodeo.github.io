<?php
    date_default_timezone_set('America/Bogota');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Declaracion para la funcion agregar_mp_formula en linea 118


    $conexion= mysqli_connect("localhost", "root", "", "alcon");

    if(isset($_POST['agregar_producto'])){

        if(strlen($_POST['codigo']) >=1 && strlen($_POST['linea'])  >=1 && strlen($_POST['descripcion_producto'])  >=1 && strlen($_POST['presentacion'])  >=1 && strlen($_POST['empaque'])  >=1 && strlen($_POST['dado'])  >=1 && strlen($_POST['medicado'])  >=1){

        $codigo = trim($_POST['codigo']);
        $linea = trim($_POST['linea']);
        $descripcion_producto = trim($_POST['descripcion_producto']);
        $presentacion = trim($_POST['presentacion']);
        $empaque = trim($_POST['empaque']);
        $dado = trim($_POST['dado']);
        $medicado = trim($_POST['medicado']);



        $consulta= "INSERT INTO producto (codigo, linea, descripcion_producto, presentacion, empaque, dado, medicado)
        VALUES ('$codigo', '$linea','$descripcion_producto', '$presentacion', ' $empaque', '$dado', '$medicado')";

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

            case 'cambiar_peso':
            cambiar_peso();
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

            case 'eliminar_mp_formula';
            eliminar_mp_formula();
            break;

            case 'eliminar_datos';
            eliminar_datos();
            break;

            case 'agregar_fecha';
            agregar_fecha();
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
		$consulta="UPDATE producto SET linea = '$linea', descripcion_producto = '$descripcion_producto' , presentacion = '$presentacion', empaque = '$empaque', dado = '$dado', medicado = '$medicado' WHERE codigo = '$codigo' ";

		mysqli_query($conexion, $consulta);


		header('Location: ../producto/productos.php');
    }

function cambiar_peso() {
    $conexion=mysqli_connect("localhost","root","","alcon");
    extract($_POST);
    $consulta="UPDATE formula SET peso = '$peso'  WHERE id = '$id' ";

    mysqli_query($conexion, $consulta);

    // Agregar consulta para actualizar la fecha y hora de modificación

    $codigo = $_POST['codigo'];
    $descripcion_producto = $_POST['descripcion_producto'];
    $fecha = $_POST['fecha'];


    // Verificar que los valores existen antes de redirigir
    if (isset($codigo) && isset($descripcion_producto) && isset($fecha) && mysqli_affected_rows($conexion) > 0 && mysqli_affected_rows($conexion) > 0) {
        $url = "detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha";
        header("Location: $url");
        exit(); // Asegura que no se envía ninguna otra salida al navegador
    }
}


        function eliminar_producto() {
            $conexion=mysqli_connect("localhost","root","","alcon");
            extract($_POST);
            $codigo= $_POST['codigo'];

            $consulta= "DELETE FROM producto WHERE codigo= $codigo";

            mysqli_query($conexion, $consulta);

                // Agregar consulta para actualizar la fecha y hora de modificación


            $codigo = $_POST['codigo'];
            $descripcion_producto = $_POST['descripcion_producto'];
            $fecha= $_POST['fecha'];


            // Verificar que los valores existen antes de redirigir
            if (isset($codigo) && isset($descripcion_producto) && isset($fecha)) {
                $url = "detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha";
                header("Location: $url");
                exit(); // Asegura que no se envía ninguna otra salida al navegador


            }

        }

        function agregar_mp_formula() {
            $conexion = mysqli_connect("localhost", "root", "", "alcon");
            extract($_POST);
        
            $descripcion_producto = $_POST['descripcion_producto'];
            $codigo_mp = $_POST['codigo_mp'];
            $peso = $_POST['peso'];
            $codigo = $_POST['codigo'];
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null; // Verificar si la variable está definida
        
            // Verificar si la variable $fecha está definida antes de usarla en la consulta SQL
            if (isset($fecha)) {
                // Agregar los datos a la tabla correspondiente usando una consulta SQL
                $consulta = "INSERT INTO formula SET codigo_mp='$codigo_mp', peso='$peso', codigo_producto='$codigo', fecha='$fecha' ";
                mysqli_query($conexion, $consulta);
        
                // Agregar consulta para actualizar la fecha y hora de modificación
        
                // Verificar que los valores existen antes de redirigir
                if (isset($codigo) && isset($descripcion_producto)) {
                    $url = "detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha";
                    header("Location: $url");
                    exit(); // Asegura que no se envía ninguna otra salida al navegador
                }
            }
        }
        
// Guardar la URL anterior en una variable

function eliminar_mp_formula() {
    $conexion=mysqli_connect("localhost","root","","alcon");
    extract($_POST);
    $id = $_POST['id'];
    $consulta = "DELETE FROM formula WHERE id = $id";
    mysqli_query($conexion, $consulta);

        // Agregar consulta para actualizar la fecha y hora de modificación
    

    // Obtener los valores de $codigo y $descripcion_producto de $_POST
    $codigo = $_POST['codigo'];
    $descripcion_producto = $_POST['descripcion_producto'];
    $fecha = $_POST['fecha']; // Fecha que deseas mantener en la tabla

    // Verificar que los valores existen antes de redirigir
    if (isset($codigo) && isset($descripcion_producto)&& isset($fecha)) {
        $url = "detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha";
        header("Location: $url");
    }
}

function eliminar_datos() {
    if (isset($_POST['codigo']) && isset($_POST['descripcion_producto'])) {
        $codigo = $_POST['codigo'];
        $descripcion_producto = $_POST['descripcion_producto'];
        $fecha = $_POST['fecha']; // Fecha que deseas mantener en la tabla
        // Realizar la conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "alcon");

        // Verificar si la conexión fue exitosa
        if ($conexion) {
            // Construir la consulta para eliminar los datos de la tabla
            $sql = "UPDATE formula SET codigo_mp = NULL, peso = NULL WHERE codigo_producto = '$codigo'";

            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);

            // Verificar si la consulta se ejecutó correctamente
            if ($resultado) {
                // Redirigir de vuelta a la página detalles_producto.php
                header("Location: detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha");
                exit;
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
        } else {
            echo "Error al conectar a la base de datos";
        }
    } else {
        echo "No se recibieron los datos necesarios";
    }
}

function agregar_fecha() {
    if (isset($_POST['codigo']) && isset($_POST['descripcion_producto']) && isset($_POST['fecha'])) {
        $codigo = $_POST['codigo'];
        $descripcion_producto = $_POST['descripcion_producto'];
        $fecha = $_POST['fecha'];

        // Realizar la conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "alcon");

        // Verificar si la conexión fue exitosa
        if ($conexion) {
            // Construir la consulta para eliminar los datos de la tabla
            $sql = "INSERT INTO formula (codigo_producto, fecha) VALUES ($codigo, '$fecha');
            ;
            ";

            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);

            // Verificar si la consulta se ejecutó correctamente
            if ($resultado) {
                // Redirigir de vuelta a la página detalles_producto.php
                header("Location: fechas_formula.php?codigo=$codigo&descripcion_producto=$descripcion_producto");
                exit;
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
        } else {
            echo "Error al conectar a la base de datos";
        }
    } else {
        echo "No se recibieron los datos necesarios";
    }
}
     ?>   
