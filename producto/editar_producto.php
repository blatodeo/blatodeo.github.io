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
$consulta = "SELECT * FROM producto WHERE codigo = $codigo";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);

?>


<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>


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
<!--<script>
$(document).ready(function () {
  //Select2
  var select2_element = $(".country").select2({
    maximumSelectionLength: 10,
  });

// Establecer valor predefinido en select2
var valor_predefinido = '<?php //echo $usuario["empaque"] ?>';
var valor_presentacion = '<?php //echo $usuario["presentacion"] ?>';


  if (valor_predefinido == '') {
    valor_predefinido = '<?php //echo $usuario["linea"] ?>';
  }
  if (valor_presentacion == '') {
    valor_presentacion = '<?php //echo $usuario["presentacion"] ?>';
  }
  if (valor_predefinido == '') {
    valor_predefinido = '<?php //echo $usuario["dado"] ?>';
  }
  if (valor_predefinido == '') {
    valor_predefinido = '<?php //echo $usuario["medicado"] ?>';
  }

  select2_element.val(valor_predefinido);
  select2_element.trigger('change');

  select2_element.val(valor_presentacion);
  select2_element.trigger('change');

});</script>-->

</head>

<body id="page-top">
<?php
    $link = mysqli_connect("localhost", "root", "");
    if($link){
        mysqli_select_db($link, "alcon");
        mysqli_query($link, "SET NAMES 'utf8'");
    }
    ?>


    <form action="product_functions.php" method="POST">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">

                            <br>
                            <br>
                            <h3 class="text-center">Editar producto</h3>

                            <div class="form-group">
    <label for="linea" class="form-label">Linea *</label>
    <select class="country" name="linea" required style="width: 200px;">
        <?php
        $v = mysqli_query($link, "SELECT * FROM linea_producto");
        while($linea = mysqli_fetch_row($v)){
            if ($linea[0] == $usuario['linea']) {
                echo "<option value=\"$linea[0]\" selected>$linea[1]</option>";
            } else {
                echo "<option value=\"$linea[0]\">$linea[1]</option>";
            }
        } 
        ?>
    </select>
</div>                            <div class="form-group">
                                <label for="descripcion_producto">Descripcion:</label><br>
                                <input type="text" name="descripcion_producto" id="descripcion_producto" class="form-control" placeholder="" value="<?php echo $usuario['descripcion_producto']; ?>">
                                <input type="hidden" name="accion" value="editar_producto">
                                <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">


                            </div>

                            <div class="form-group">
    <label for="presentacion" class="form-label">Presentación *</label>
    <select class="country" name="presentacion" required style="width: 200px;">
        <?php
        $v = mysqli_query($link, "SELECT * FROM presentacion");
        while($presentacion = mysqli_fetch_row($v)){
            if ($presentacion[0] == $usuario['presentacion']) {
                echo "<option value=\"$presentacion[0]\" selected>$presentacion[1]</option>";
            } else {
                echo "<option value=\"$presentacion[0]\">$presentacion[1]</option>";
            }
        } 
        ?>
    </select>
</div>                            <div class="form-group">


<div class="form-group">
    <label for="empaque" class="form-label">Empaque *</label>
    <select class="country" name="empaque" required style="width: 200px;">
        <?php
        $v = mysqli_query($link, "SELECT * FROM empaque");
        while($empaque = mysqli_fetch_row($v)){
            if ($empaque[0] == $usuario['empaque']) {
                echo "<option value=\"$empaque[0]\" selected>$empaque[1]</option>";
            } else {
                echo "<option value=\"$empaque[0]\">$empaque[1]</option>";
            }
        } 
        ?>
    </select>
</div>                            <div class="form-group">




<div class="form-group">
    <label for="dado" class="form-label">Dado *</label>
    <select class="country" name="dado" required style="width: 200px;">
        <?php
        $v = mysqli_query($link, "SELECT * FROM dado");
        while($dado = mysqli_fetch_row($v)){
            if ($dado[0] == $usuario['dado']) {
                echo "<option value=\"$dado[0]\" selected>$dado[1]</option>";
            } else {
                echo "<option value=\"$dado[0]\">$dado[1]</option>";
            }
        } 
        ?>
    </select>
</div>                            <div class="form-group">

<div class="form-group">
    <label for="medicado" class="form-label">Medicado *</label>
    <select class="country" name="medicado" required style="width: 200px;">
        <?php
        $v = mysqli_query($link, "SELECT * FROM medicado");
        while($medicado = mysqli_fetch_row($v)){
            if ($medicado[0] == $usuario['linea']) {
                echo "<option value=\"$medicado[0]\" selected>$medicado[1]</option>";
            } else {
                echo "<option value=\"$medicado[0]\">$medicado[1]</option>";
            }
        } 
        ?>
    </select>
</div>                            <div class="form-group">



                            <br>

                            <div class="mb-3">

                                <button type="submit" class="btn btn-success">Editar</button>
                                <a href="productos.php" class="btn btn-danger">Cancelar</a>

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