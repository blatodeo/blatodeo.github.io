<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

    header("Location: ../_sesion/index.php");
    die();
    
}


 



$codigo = $_GET['codigo'];
$conexion = mysqli_connect("localhost", "root", "", "alcon");
$consulta = "SELECT * FROM materia_prima WHERE codigo = $codigo";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);

?>


<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia Prima</title>


    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
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


    <form action="_functions.php" method="POST">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">

                            <br>
                            <br>
                            <h3 class="text-center">Editar materia prima</h3>
                            <div class="form-group">
                                <label for="linea" class="form-label">Linea *</label>
                                <select class="country" name="linea" value="<?php echo $usuario['linea']; ?>" required 
					style="width: 200px;">
            <?php
        $v = mysqli_query($link, "SELECT * FROM linea");
        while($linea = mysqli_fetch_row($v)){
    ?>
            <option value="<?php echo $linea[0] ?>"><?php echo $linea[1] ?></option>
        <?php   } ?></select>


                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion:</label><br>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="" value="<?php echo $usuario['descripcion']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="coste_kg">Coste/Kg:</label><br>
                                <input type="hidden" name="accion" value="editar_mp">
                                <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                                <select  class="country" name="precio_mp" value="<?php echo $usuario['precio_mp']; ?>" required 
					style="width: 200px;">
            <?php
        $v = mysqli_query($link, "SELECT * FROM precio_mp");
        while($precio = mysqli_fetch_row($v)){
    ?>
            <option value="<?php echo $precio[0] ?>"><?php echo $precio[1] ?></option>
        <?php   } ?></select>
                            </div>


                            <br>

                            <div class="mb-3">

                                <button type="submit" class="btn btn-success">Editar</button>
                                <a href="mp.php" class="btn btn-danger">Cancelar</a>

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