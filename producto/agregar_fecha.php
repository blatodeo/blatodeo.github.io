<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

  header("Location: ../_sesion/index.php");
  die();
}


?>






<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Fecha</title>

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

<?php
    $link = mysqli_connect("localhost", "root", "");
    if($link){
        mysqli_select_db($link, "alcon");
        mysqli_query($link, "SET NAMES 'utf8'");
    }
    ?>

<?php

$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];
?>


<form  action="product_functions.php" method="POST">
<div id="login" >
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    
                            <br>
                            <br>
                            <h3 class="text-center">Registro de nueva fecha</h3>
                            <div class="form-group">
                            <input type="hidden"  id="codigo" name="codigo" class="form-control" value="<?php echo $codigo; ?>" required>
                            <input type="hidden"  id="descripcion_producto" name="descripcion_producto" class="form-control" value="<?php echo $descripcion_producto; ?>" required>

                            <label for="fecha" class="form-label">Fecha *</label>
                            <input type="date"  id="fecha" name="fecha" class="form-control" required>
                            </div>




                           <br>

                                <div class="mb-3">
 
                            <button class="btn btn-success" type="submit" name="accion" value="agregar_fecha">Agregar</button>
                            <a href="fechas_formula.php?codigo=<?php echo $_GET['codigo']; ?>&descripcion_producto=<?php echo $_GET['descripcion_producto']; ?>" class="btn btn-danger">Cancelar</a>

                            </div>
                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>