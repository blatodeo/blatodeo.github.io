<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

  header("Location: ../_sesion/index.php");
  die();
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];
$conexion = mysqli_connect("localhost", "root", "", "alcon");
$consulta = "SELECT * FROM precio_mp WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);



//value="<?php echo $codigo;

?>




<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Materia Prima</title>

	<link rel="stylesheet" href="../css/es.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
	</script>

		<!--These jQuery libraries for
		chosen need to be included-->
		<script src=
"https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js">
		</script>
		<link rel="stylesheet"
			href=
"https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />

		<!--These jQuery libraries for select2
			need to be included-->
		<script src=
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
	</script>
		<link rel="stylesheet"
			href=
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />
<script>
$(document).ready(function () {
  //Select2
  var select2_element = $(".country").select2({
    maximumSelectionLength: 10,
  });

  // Establecer valor predefinido en select2
  select2_element.val('<?php echo $usuario["linea_precio"]; ?>');
  select2_element.trigger('change');
  //Chosen
});		</script>


</head>

<body id="page-top">

<br>
<?php
    $link = mysqli_connect("localhost", "root", "");
    if($link){
        mysqli_select_db($link, "alcon");
        mysqli_query($link, "SET NAMES 'utf8'");
    }
    if(isset($_GET['codigo']) && isset($_GET['descripcion'])) {
        $codigo = $_GET['codigo'];
        $descripcion = $_GET['descripcion'];

    ?>





<form  action="functions_precio.php" method="POST">
<div id="login" >
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                            <br>
                            <br>
                            <h3 class="text-center">Edita precio a <?php echo $descripcion;  ?> </h3>
                            <div class="form-group">
                            <input type="hidden" name="accion" value="editar_precio">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                                <label for="linea_precio">Linea:</label><br>
                                <select class="country" name="linea_precio" 
					style="width: 200px;">
                    <?php
        $v = mysqli_query($link, "SELECT * FROM linea_precio");
        while($linea_precio = mysqli_fetch_row($v)){
    ?>
            <option value="<?php echo $linea_precio[0] ?>"><?php echo $linea_precio[1] ?></option>
        <?php   } ?></select>


                            </div>
                            <div class="form-group">
                                <label for="precio" class="form-label">Precio *</label>
                                <input type="number" step="0.01"  id="precio" name="precio" value="<?php echo $usuario['precio']; ?>" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="fecha">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" value="<?php echo $usuario['fecha']; ?>">
                                <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                                <input type="hidden" name="descripcion" value="<?php echo $descripcion; ?>">


                            </div>
                    
                        
                           <br>

                                <div class="mb-3">
                                    
                               <input type="submit" value="Editar"class="btn btn-success"> 
                               <a href="precio.php?codigo=<?php echo $codigo ; ?>&descripcion=<?php echo $descripcion; ?>" class="btn btn-danger">Cancelar</a>

                            </div>
                            </div>
                            </div>

                        </form>
                        <?php
                    } else {
  echo "No se especificó ningún código de materia prima.";
}
?>



                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>