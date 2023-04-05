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
<?php include "../navbar/html.php" ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/af4606bedd.js" crossorigin="anonymous"></script>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../css/fontawesome-all.min.css">
  <link rel="stylesheet" href="../css/styles.css">

  
  <style type="text/css">
.pag_btn {


  border-radius: 4px;
  margin: 4px;
  padding: 5px;

  cursor: pointer;
  border: none;
 }
  
 .pag_btn_des {

  border-radius: 4px;
  margin: 4px;
  padding: 5px;
  font-size: 14pt;
  cursor: pointer;
  border: none;
 }
  
 .pag_num {


  border-radius: 4px;
  margin: 4px;
  padding: 5px;
  
  cursor: pointer;
  border: none;
  
 }
</style>

  <title>Productos</title>
</head>




<br>



<div class="container is-fluid">



  <div class="col-xs-12">
    <h1>Lista de Productos</h1>
    <br>
    <div>
      <a class="btn btn-success" href="excel.php">Excel
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>
       <a class="btn btn-success" href="pdf_mp.php">PDF
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>
       <a class="btn btn-primary" href="agregar_producto.php"> Nuevo Producto 
        <i class="fa fa-plus" aria-hidden="true"></i>
      </a>
      <a class="btn btn-primary" href="../linea_producto/lineas_producto.php"> Ver Lineas 
        <i class="fa-solid fa-grip-lines" aria-hidden="true"></i>
      </a>
      <a class="btn btn-primary" href="../formula/formula.php">
                  Ver Formulas</a>





    </div>
    <br>

    <!--<div class="container-fluid">
      <form class="d-flex">
        <input class="form-control me-2 light-table-filter" data-table="table_id" type="text"
         placeholder="Buscar con JS">
         <hr>
      </form>-->



    <br>


    </form>



    <table class="table table-striped table-dark table_id" id="table_id">


      <thead>
        <tr>
        <th>Codigo</th>
        <th>Linea</th>
        <th>Descripcion</th>
        <th>Acciones</th>
        <th>Detalles</th> <!-- Nueva columna -->


        </tr>
      </thead>
      <tbody>

        <?php

        $conexion = mysqli_connect("localhost", "root", "", "alcon");
        $SQL = "SELECT producto.codigo, producto.descripcion_producto, linea_producto.linea
        FROM producto 
        INNER JOIN linea_producto ON producto.linea = linea_producto.id"  ;
        $dato = mysqli_query($conexion, $SQL);

        if ($dato->num_rows > 0) {
          while ($fila = mysqli_fetch_array($dato)) {

        ?>
            <tr>
              <td><?php echo $fila['codigo']; ?></td>
              <td><?php echo $fila['linea']; ?></td>
              <td><?php echo $fila['descripcion_producto']; ?></td>




              <td>
                <a class="btn btn-warning" href="editar_producto.php?codigo=<?php echo $fila['codigo'] ?> ">
                  <i class="fa fa-edit"></i> </a>

                <a class="btn btn-danger" href="eliminar_producto.php?codigo=<?php echo $fila['codigo'] ?>">
                  <i class="fa fa-trash"></i></a>



              </td>
              <td>
    <a class="btn btn-primary" href="detalles_producto.php?codigo=<?php echo $fila['codigo']; ?>&descripcion_producto=<?php echo $fila['descripcion_producto']; ?>"
>
        <i class="fa fa-eye"></i> Ver formula
    </a>
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
    <!--<div id="paginador" class=""></div> -->

  
<script src="../js/page.js"></script>
<script src="../js/buscador.js"></script>
<script src="../js/user.js"></script>
<script src="../js/acciones.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>  </body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</html>