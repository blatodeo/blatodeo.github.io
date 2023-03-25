<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




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
<?php include "../navbar/html.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulas</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"
        integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ"
        crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/af4606bedd.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


    <!--  Datatables CSS -->
    <link rel="stylesheet" type=<link rel="stylesheet" href="https://kit.fontawesome.com/af4606bedd.css" crossorigin="anonymous" "text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />

    <style>
        .table thead,
        .table tfoot {
            background-color: #455a64;
            color: azure;
        }
    </style>


</head>






<br>
<br>









<?php
$conexion = mysqli_connect("localhost", "root", "", "alcon");

if(isset($_GET['codigo_producto']) && isset($_GET['descripcion_producto'])) {
    $codigo_producto = $_GET['codigo_producto'];
    $descripcion_producto = $_GET['descripcion_producto'];
    
    // aquí puedes agregar el resto del código
  
  
  $SQL = "SELECT * FROM formula
          LEFT JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo
          LEFT JOIN producto ON formula.codigo_producto = producto.descripcion_producto

          WHERE codigo_producto = '$codigo_producto'";

  $dato = mysqli_query($conexion, $SQL);

  if ($dato->num_rows > 0) {
    ?>

<a class="btn btn-warning" href="productos.php"> Regresa a Productos
                <i class="fa-solid fa-delete-left"></i></a>

                <a class="btn btn-primary" href="agregar_mp_formula.php?codigo_producto=<?php echo $codigo_producto; ?>&descripcion_producto=<?php echo $descripcion_producto; ?>"
>
        <i class="fa fa-plus"></i> Agregar Materia Prima
    </a>


    <table class="table table-striped table-dark">
      <thead>
        <tr>
          <th>ID</th>
          <th>Producto</th>
          <th>Materia Prima</th>
          <th>Coste/Kg</th>
        </tr>
      </thead>
      <tbody>

      <h1>Formula de <?php echo $descripcion_producto;  ?></h1>

        <?php
        $total = 0;
        while ($fila = mysqli_fetch_array($dato)) {
                      // Imprime la variable $fila para verificar que se esté recibiendo correctamente

          ?>

          
          <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['codigo_producto'] ?></td>
            <td><?php echo $fila['codigo_mp']. ' - ' .$fila['descripcion']; ?></td>
            <td><?php echo '$' . $fila['precio_mp']; ?></td>
          </tr>
          <?php
          $total += $fila['precio_mp'];
        }
        ?>
      </tbody>
      
    </table>
    
    <?php
  } else {
    echo "No se encontraron detalles para el producto con código $codigo_producto.";
  }
} else {
  echo "No se especificó ningún código de producto.";
}
?>

<h1>Coste total formula: <?php echo '$' . $total; ?></h1>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



<script src="../js/page.js"></script>
<script src="../js/buscador.js"></script>
<script src="../js/user.js"></script>

</body>

</html>
