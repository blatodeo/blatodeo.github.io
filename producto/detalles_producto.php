<?php

date_default_timezone_set('America/Bogota');


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
$fecha = $_GET['fecha'];

?>




        <a class="btn btn-secondary" href="fechas_formula.php?codigo=<?php echo $_GET['codigo']; ?>&descripcion_producto=<?php echo $_GET['descripcion_producto']; ?>&fecha=<?php echo $_GET['fecha']; ?>">
          Regresar a Fechas Formula                
        <i class="fa-solid fa-delete-left"></i></a>

                <a class="btn btn-primary" href="agregar_mp_formula.php?codigo=<?php echo $codigo; ?>&descripcion_producto=<?php echo $descripcion_producto; ?>&fecha=<?php echo $fecha; ?>"
>
        <i class="fa fa-plus"></i> Agregar Materia Prima
    </a>

    <br>
    <br>

    <form action="importar_csv.php?codigo=<?php echo $codigo ?>&descripcion_producto=<?php echo $descripcion_producto ?>&fecha=<?php echo $fecha ?>" method="post" enctype="multipart/form-data">
  <label for="archivo_csv">Seleccionar archivo CSV:</label>
  <input type="file" name="archivo_csv" id="archivo_csv">
  <input type="submit" value="Importar">
    </form>

    <form action="importar_excel.php?codigo=<?php echo $codigo ?>&descripcion_producto=<?php echo $descripcion_producto ?>&fecha=<?php echo $fecha ?>" method="post" enctype="multipart/form-data">
  <label for="archivo_excel">Seleccionar archivo Excel:</label>
  <input type="file" name="archivo_excel" id="archivo_excel" accept=".xlsx, .xls">
  <input type="submit" value="Importar">
</form>


<br>

<form action="product_functions.php" method="POST">
  <input type="hidden" name="accion" value="eliminar_datos">
  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
  <input type="hidden" name="descripcion_producto" value="<?php echo $descripcion_producto; ?>">
  <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">

  <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar todos los datos de la tabla?')">Eliminar todos los datos</button>
</form>

<div style="display: flex; align-items: center;">
  <h1 style="margin-right: 20px;">PRODUCTO <?php echo $codigo; ?></h1>
  <h1 style="margin-left: 600px;">Fecha: <?php echo $fecha; ?></h1>
</div>


    <table class="table table-striped table-dark table_id" id="table_id">


      <thead>
        <tr>
        <th style="text-align: center;">ID</th>
        <th class="text-center">Codigo</th>
        <th class="text-center">Materia Prima</th>
        <th class="text-center">Costo/Kg</th>
        <th class="text-center">Kg/Batch</th>
        <th class="text-center">Costo MP</th>
        <th class="text-center">Eliminar</th>





        </tr>
      </thead>
      <tbody>
      <?php
      $totalPeso = 0;
      $totalPrecio = 0; // agregar esta variable    
      $conexion = mysqli_connect("localhost", "root", "", "alcon");
      // Obtener datos de las materias primas de la fórmula
      $SQL = "SELECT 
      formula.id,
      materia_prima.codigo,
      materia_prima.descripcion,
      formula.peso,
      formula.fecha,
      (SELECT precio FROM precio_mp WHERE precio_mp.mp = materia_prima.codigo AND linea_precio = 6) AS precio
  FROM formula 
  INNER JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo
  WHERE codigo_producto = $codigo 
  AND fecha = '$fecha'";
  $dato = mysqli_query($conexion, $SQL);

  $fechaAnterior = null; // Variable para almacenar la fecha anterior

if ($dato->num_rows > 0) {
  while ($fila = mysqli_fetch_array($dato)) {
    $totalPeso += $fila['peso'];
    $totalPrecio += $fila['precio'];
    $costoMP = $fila['precio'] * $fila['peso'];
    $totalCostoMP += $costoMP;
    // Agregar condición para establecer un valor de 0 en la columna 'Kg/Batch'
    if (empty($fila['peso']) || $fila['peso'] == 0) {
      $fila['peso'] = 0;
    }

    // Verificar si la fecha es igual a la fecha anterior
    if ($fila['fecha'] != $fechaAnterior) {
      ?>
      <?php
      $fechaAnterior = $fila['fecha']; // Actualizar la fecha anterior
  }
    ?>

  <tr>
    <td class="text-center"><?php echo $fila['id']; ?></td>
    <td class="text-center"><?php echo $fila['codigo']?> </td>
    <td class="text-center"><?php echo $fila['descripcion']; ?></td>
    <td class="text-center"><?php echo '$' . number_format($fila['precio'], 0); ?></td>
    <td class="text-center"><?php echo number_format($fila['peso'], 2); ?><a class="btn btn-warning" href="cambiar_peso.php?id=<?php echo $fila['id'] ?>&codigo_mp=<?php echo $fila['codigo'] ?>&codigo_producto=<?php echo $codigo; ?>&descripcion_producto=<?php echo $descripcion_producto ?>"
>
                  <i class="fas fa-pencil-alt"></i></a>

                  <td class="text-center"><?php echo '$' . number_format($costoMP, 0); ?></td>

              <td class="text-center">

                <a class="btn btn-danger" href="eliminar_mp_formula.php?id=<?php echo $fila['id'] ?>&codigo_producto=<?php echo $codigo; ?>&descripcion_producto=<?php echo $descripcion_producto ?>&fecha=<?php echo $fecha ?>"
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
        <tfoot>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-center">Total: <?php echo number_format($totalPeso, 2); ?></td>
        <td class="text-center">Total: <?php echo number_format($totalCostoMP, 2); ?></td>        <td></td>
    </tr>
</tfoot>

    </table>

<br>

<?php
$maquila = 105000;
$etiqueta_empaque = 25050;
$administracion_impuestos = 117298;

$totalPorTonelada = ($totalCostoMP + $maquila + $etiqueta_empaque + $administracion_impuestos) ;
echo "<strong>Maquila:</strong> " . ($maquila) . "<br>\n";
echo "<strong>Etiqueta y Empaque:</strong> " . ($etiqueta_empaque) . "<br>\n";
echo "<strong>Administracion e Impuestos:</strong> " . ($administracion_impuestos) . "<br><br>\n";

echo "<strong>El costo por tonelada es de:</strong> " . number_format($totalPorTonelada, 2, '.', ',') . "<br>\n";

?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



<script src="../js/page.js"></script>
<script src="../js/buscador.js"></script>
<script src="../js/user.js"></script>

</body>

</html>
