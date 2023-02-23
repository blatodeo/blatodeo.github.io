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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Agregar Materia Prima a Formula</title>

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
				$(".country1").chosen({
					max_selected_options: 2,
				});
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
    ?>


<form  action="functions_formula.php" method="POST">
<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    
                            <br>
                            <br>
                            <h3 class="text-center">Selecciona una materia prima para agregarla a la formula</h3>
                            <div class="form-group">
                            <label for="codigo_producto" class="form-label">Selecciona a que producto va dirigido *</label>
                            <script>$(document).ready(function() {
    $('.js-example-basic-single').select2();
});</script>
                <input type="hidden" name="accion" value="agregar_mp_formula">

                            <select name="codigo_producto" class="country"
					style="width: 200px;">
                    <?php
        $v = mysqli_query($link, "SELECT * FROM producto");
        while($codigo = mysqli_fetch_row($v)){
    ?>
            <option value="<?php echo $codigo[0] ?>"><?php echo $codigo[1] ?></option>
        <?php   } ?>
			</select>

                            <label for="codigo_mp" class="form-label">Selecciona Materia Prima *</label>
                            <script>$(document).ready(function() {
    $('.js-example-basic-single').select2();
});</script>
                            <select name="codigo_mp" class="country"
					style="width: 200px;">
                    <?php
        $v = mysqli_query($link, "SELECT * FROM materia_prima");
        while($descripcion = mysqli_fetch_row($v)){
    ?>
            <option value="<?php echo $descripcion[0] ?>"><?php echo $descripcion[1] ?></option>
        <?php   } ?>
			</select>


                             
                            </div>
                      
                        
                           <br>

                                <div class="mb-3">
                                    
                               <input type="submit" value="Guardar"class="btn btn-success" 
                               name="agregar_mp_formula"> 
                               <a href="formula.php" class="btn btn-danger">Cancelar</a> 
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