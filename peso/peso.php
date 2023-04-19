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
    <title>Peso</title>
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

if(isset($_GET['codigo']) && isset($_GET['descripcion'])) {
    $codigo = $_GET['codigo'];
    $descripcion = $_GET['descripcion'];
    
    // aquí puedes agregar el resto del código
  
  
    $conexion = mysqli_connect("localhost", "root", "", "alcon");
    $SQL = "SELECT peso.id, peso.peso, materia_prima.codigo, materia_prima.descripcion, peso.fecha
    FROM peso 
    INNER JOIN materia_prima ON peso.mp = materia_prima.codigo 


    WHERE codigo = '$codigo'";


    $dato = mysqli_query($conexion, $SQL);


  if ($dato->num_rows > 0) {
    ?>
    <a class="btn btn-warning" href="../mp/mp.php"> Regresa a Materia Prima
                <i class="fa-solid fa-delete-left"></i></a>

                <a class="btn btn-primary" href="agregar_peso.php?codigo=<?php echo $codigo ; ?>&descripcion=<?php echo $descripcion; ?> ">
        <i class="fa fa-plus"></i> Agregar Peso
    </a>




    <table class="table table-striped table-dark table_id" id="table_id"">
      <thead>
        <tr>
          <th>ID</th>
          <th>Peso</th>
          <th>Codigo MP</th>
          <th>Fecha</th>
          <th>Acciones</th>


        </tr>
      </thead>
      <tbody>

      <h1>Pesos de <?php echo $descripcion;  ?></h1>

        <?php
        while ($fila = mysqli_fetch_array($dato)) {
                      // Imprime la variable $fila para verificar que se esté recibiendo correctamente

          ?>


          <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['peso'] . ' Kg'  ; ?></td>
            <td><?php echo $fila['codigo'] ?></td>
            <td><?php echo $fila['fecha'] ?></td>

            <td>
                <a class="btn btn-warning" href="editar_peso.php?codigo=<?php echo $codigo ; ?>&descripcion=<?php echo $descripcion;?>&id=<?php echo $fila['id']; ?> ">
                  <i class="fa fa-edit"></i> </a>

                <a class="btn btn-danger" href="eliminar_peso.php?codigo=<?php echo $codigo ; ?>&descripcion=<?php echo $descripcion;?>&id=<?php echo $fila['id']; ?> ">
                  <i class="fa fa-trash"></i></a>


              </td>

          </tr>
          <?php
        }
        ?>
      </tbody>
      
    </table>
    
    <?php
  } else {
    echo "No se encontraron detalles para la materia prima con código $codigo.";
  
?>
    <a class="btn btn-warning" href="../mp/mp.php"> Regresa a Materia Prima
                <i class="fa-solid fa-delete-left"></i></a>

                <a class="btn btn-primary" href="agregar_peso.php?codigo=<?php echo $codigo ; ?>&descripcion=<?php echo $descripcion; ?> ">
        <i class="fa fa-plus"></i> Agregar Peso
    </a>

<?php
}
?>

<?php
} else {


  echo "No se especificó ningún código de materia prima.";
?>

<a class="btn btn-warning" href="../mp/mp.php"> Regresa a Materia Prima
                <i class="fa-solid fa-delete-left"></i></a>

                <a class="btn btn-primary" href="agregar_peso.php?codigo=<?php echo $codigo ; ?>&descripcion=<?php echo $descripcion; ?> ">
        <i class="fa fa-plus"></i> Agregar Peso
    </a>


<?php
}
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



<script src="../js/page.js"></script>
<script src="../js/buscador.js"></script>
<script src="../js/user.js"></script>

</body>

</html>
