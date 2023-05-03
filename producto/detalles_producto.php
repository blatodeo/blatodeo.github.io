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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">


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
$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];
?>




<a class="btn btn-warning" href="productos.php"> Regresa a Productos
                <i class="fa-solid fa-delete-left"></i></a>

                <a class="btn btn-primary" href="agregar_mp_formula.php?codigo=<?php echo $codigo; ?>&descripcion_producto=<?php echo $descripcion_producto; ?>"
>
        <i class="fa fa-plus"></i> Agregar Materia Prima
    </a>

    <h1>Formula de <?php echo $descripcion_producto;  ?></h1>

    <table class="table table-striped table-dark table_id" id="table_id">


      <thead>
        <tr>
        <th>ID</th>
        <th>Materia Prima</th>
        <th>Costo/Kg</th>
        <th>Kg/Batch</th>
        <th>Costo MP</th>
        <th>Eliminar</th>



        </tr>
      </thead>
      <tbody>
      <?php
      $totalPeso = 0;
      $totalPrecio = 0; // agregar esta variable      
      $conexion = mysqli_connect("localhost", "root", "", "alcon");
      // Obtener datos de las materias primas de la fórmula
      $SQL= "SELECT 
      formula.id,
      materia_prima.codigo,
      materia_prima.descripcion,
      peso.peso AS valor,
      (SELECT precio FROM precio_mp WHERE precio_mp.mp = materia_prima.codigo AND linea_precio = 6) AS precio,
      formula.peso AS peso 
    FROM formula 
    INNER JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo
    LEFT JOIN peso ON formula.peso = peso.id
    WHERE codigo_producto = $codigo";

$dato = mysqli_query($conexion, $SQL);
if ($dato->num_rows > 0) {
  while ($fila = mysqli_fetch_array($dato)) {
    $totalPeso += $fila['valor'];
    $totalPrecio += $fila['precio'];
    $costoMP = $fila['precio'] * $fila['valor'];
    $totalCostoMP += $costoMP;
    // Agregar condición para establecer un valor de 0 en la columna 'Kg/Batch'
    if (empty($fila['valor']) || $fila['valor'] == 0) {
      $fila['valor'] = 0;
    }
    ?>
  <tr>
    <td><?php echo $fila['id']; ?></td>
    <td><?php echo $fila['codigo'] . ' - ' . $fila['descripcion'] ?> </td>
    <td><?php echo '$' . number_format($fila['precio'], 3); ?></td>
    <td><?php echo $fila['valor']; ?><a class="btn btn-warning" href="cambiar_peso.php?id=<?php echo $fila['id'] ?>&codigo_mp=<?php echo $fila['codigo'] ?>&codigo_producto=<?php echo $codigo; ?>&descripcion_producto=<?php echo $descripcion_producto ?>"
>
                  <i class="fas fa-pencil-alt"></i></a>

                  <td><?php echo '$' . number_format($costoMP, 3); ?></td>
              <td>

                <a class="btn btn-danger" href="eliminar_mp_formula.php?id=<?php echo $fila['id'] ?>&codigo_producto=<?php echo $codigo; ?>&descripcion_producto=<?php echo $descripcion_producto ?>"
>
                  <i class="fa fa-trash"></i></a>



              </td>



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

        </tbody>
    </table>
    <tr>
  <td></td>
  <td></td>
  <td></td>
  <td><strong>Total Peso: <?php echo  $totalPeso . ' Kg'  ?></strong></td>
  <td></td>
</tr>

<div><strong>Total Precio: <?php echo '$' . number_format($totalPrecio, 3) ; ?></strong></div> <!-- agregar esto -->




<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



<script src="../js/page.js"></script>
<script src="../js/buscador.js"></script>
<script src="../js/user.js"></script>

</body>

</html>
