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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>

<?php
$codigo = $_GET['codigo_producto'];
$descripcion_producto = $_GET['descripcion_producto'];
?>

    
    <div class="container mt-5">
    <div class="row">
    <div class="col-sm-6 offset-sm-3">
    <div class="alert alert-danger text-center">
    <p>¿Desea confirmar la eliminacion de este producto?</p>
    </div>




<p>Código: <?php echo $codigo; ?></p>
<p>Descripción del producto: <?php echo $descripcion_producto; ?></p>


    <div class="row">
        <div class="col-sm-6">
            <form action="product_functions.php" method="POST">
                <input type="hidden" name="accion" value="eliminar_mp_formula">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="codigo_producto" value="<?php echo $codigo; ?>">
                <input type="hidden" name="descripcion_producto" value="<?php echo $descripcion_producto; ?>">
                <input type="submit" value='Eliminar' class="btn btn-danger" >
                
                <a class="btn btn-success" href="#" onclick="window.history.back();">Cancelar</a>

        </div>
    </div>



</body>
</html>