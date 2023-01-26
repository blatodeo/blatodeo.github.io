<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

  header("Location: ../_sesion/login.php");
  die();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="../css/fontawesome-all.min.css">
  <link rel="stylesheet" href="../css/styles.css">
  <title></title>
</head>

<div class="container is-fluid">



  <br>
  <div class="col-xs-12">
    <h1>Lista de materia prima</h1>
    <br>
    <div>
      <a class="btn btn-warning" href="../_sesion/cerrarSesion.php">Log Out <i class="fa fa-power-off" aria-hidden="true"></i></a>
      <a class="btn btn-dark" href="../_sesion/lector_usuario.php">Usuarios <i class="fa fa-user" aria-hidden="true"></i> </a>
      <a class="btn btn-success" href="lector_excel.php">Excel
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>


    </div>
    <br>


    <div class="container-fluid">
      <form class="d-flex">
        <input class="form-control me-2 light-table-filter" data-table="table_id" type="text"
         placeholder="Buscar con JS">
         <hr>
      </form>




    <br>


    </form>



    <table class="table table-striped table-dark table_id">


      <thead>
        <tr>
          <th>Codigo</th>
          <th>Linea</th>
          <th>Descripcion</th>
          <th>Coste/Kg</th>

        </tr>
      </thead>
      <tbody>

        <?php

        $conexion = mysqli_connect("localhost", "root", "", "alcon");
        $SQL = "SELECT * FROM materia_prima ";
        $dato = mysqli_query($conexion, $SQL);

        if ($dato->num_rows > 0) {
          while ($fila = mysqli_fetch_array($dato)) {

        ?>
            <tr>
              <td><?php echo $fila['codigo']; ?></td>
              <td><?php echo $fila['linea']; ?></td>
              <td><?php echo $fila['descripcion']; ?></td>
              <td><?php echo $fila['coste_kg']; ?></td>




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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="../js/buscador.js"></script>


</html>