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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!--  Datatables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />

    <style>
        .table thead,
        .table tfoot {
            background-color: #455a64;
            color: azure;
        }
    </style>
</head>

<body>

        <br>
        <br>

        <!-- Termina el header -->

        <!-- Comienza el body -->


        <div class="container is-fluid">



<div class="col-xs-12">
  <br>
  <div>



  </div>





            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Formula</h1>

                        <table class="table table-striped table-dark table_id" id="table_id">


<thead>
  <tr>
    <th>ID</th>
    <th>Producto</th>
    <th>Materia Prima</th>
    <th>Coste/Kg</th>
    <th>Acciones</th>

  </tr>
</thead>
<tbody>

<?php

$conexion = mysqli_connect("localhost", "root", "", "alcon");
$SQL = "SELECT formula.id, formula.codigo_producto, producto.codigo, producto.descripcion_producto, formula.codigo_mp, materia_prima.descripcion, materia_prima.precio_mp FROM formula
LEFT JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo  LEFT JOIN producto ON formula.codigo_producto = producto.codigo " ;
$dato = mysqli_query($conexion, $SQL);

if ($dato->num_rows > 0) {
  while ($fila = mysqli_fetch_array($dato)) {

?>
<tr>
        <td><?php echo $fila['id']; ?></td>
        <td><?php echo $fila['codigo_producto']. ' - ' .$fila['descripcion_producto']; ?></td>
        <td><?php echo $fila['codigo_mp']. ' - ' .$fila['descripcion']; ?></td>
        <td><?php echo $fila['precio_mp']; ?></td>




        <td>

          <a class="btn btn-danger" href="eliminar_formula.php?id=<?php echo $fila['id'] ?>">
            <i class="fa fa-trash"></i></a>

            <a class="btn btn-primary" href="agregar_mp_formula.php"> Agregar Materia Prima 
                <i class="fa fa-plus" aria-hidden="true"></i></a>
                <a class="btn btn-primary" href="../producto/productos.php">Productos</a>


        </td>
      </tr>


    <?php
    }
  } else {

    ?>
    <tr class="text-center">
      <td colspan="16">No existen registros</td>
    </tr>


  <?php

  }

  ?>


  </body>
</table>
              </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary">
                            Total: <span id="total" class="badge badge-light"></span>
                        </button>
                    </div>
                </div>
            </div>



            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



<script src="../js/page.js"></script>
<script src="../js/buscador.js"></script>
<script src="../js/user.js"></script>

</body>

</html>