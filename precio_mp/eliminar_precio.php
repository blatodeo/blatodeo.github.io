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
    <title>Eliminar Materias Primas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>


    
    <div class="container mt-5">
    <div class="row">
    <div class="col-sm-6 offset-sm-3">
    <div class="alert alert-danger text-center">
    <p>¿Desea confirmar la eliminacion de este precio?</p>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php
    $link = mysqli_connect("localhost", "root", "");
    if($link){
        mysqli_select_db($link, "alcon");
        mysqli_query($link, "SET NAMES 'utf8'");
    }
    if(isset($_GET['codigo']) && isset($_GET['descripcion'])) {
        $codigo = $_GET['codigo'];
        $descripcion = $_GET['descripcion'];

    }
    ?>

    
    ?>

            <form action="functions_precio.php" method="POST">
                <input type="hidden" name="accion" value="eliminar_precio_mp">
                <input type="hidden" name="codigo" value="<?php echo $_GET['id']; ?>">
                <input type="submit" name="" value="Eliminar" class= " btn btn-danger">
                <a href="precio.php?codigo=<?php echo $codigo ; ?>&descripcion=<?php echo $descripcion; ?>" class="btn btn-success">Cancelar</a>

                               

</form>
</div>
</div>
</div>
</div>

</body>
</html>