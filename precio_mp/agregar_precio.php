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
				$(".country").select2({
					maximumSelectionLength: 2,
				});
				//Chosen
			});
		</script>


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
                            <h3 class="text-center">Agrega precio a <?php echo $descripcion;  ?> </h3>
                            <div class="form-group">

                            <div class="form-group">
                                <input type="hidden" name="mp" value="<?php echo $codigo; ?>">                     
                            </div>

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
                                <input type="text"  id="precio" name="precio" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="fecha" class="form-label">Fecha *</label>
                                <input type="date"  id="fecha" name="fecha" class="form-control" >
                            </div>
                      
                        
                           <br>

                                <div class="mb-3">
                                    
                               <input type="submit" value="Guardar"class="btn btn-success" 
                               name="agregar_precio" onclick="window.history.back();"> 
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
    </form>
</body>
</html>