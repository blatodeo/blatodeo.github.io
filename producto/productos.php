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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
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

  <title></title>
</head>

<div class="container is-fluid">



  <br>
  <div class="col-xs-12">
    <h1>Lista de Productos</h1>
    <br>
    <div>
      <a class="btn btn-primary" href="agregar_mp.php">Nuevo Producto<i class="fa fa-plus" aria-hidden="true"></i></a>
      <a class="btn btn-warning" href="../_sesion/cerrarSesion.php">Log Out <i class="fa fa-power-off" aria-hidden="true"></i></a>
      <a class="btn btn-dark" href="../mp/mp.php">Materia Prima <i class="fa fa-user" aria-hidden="true"></i> </a>
      <a class="btn btn-dark" href="../_sesion/usuarios.php">Usuarios <i class="fa fa-user" aria-hidden="true"></i> </a>
      <a class="btn btn-success" href="excel.php">Excel
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>
       <a class="btn btn-success" href="pdf_mp.php">PDF
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>



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
        <th>Formulacion</th>
        <th>Coste/Unidad</th>
        <th>Coste/Total</th>
        <th>Acciones</th>

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
              <td><?php echo $fila['formulacion']; ?></td>
              <td><?php echo $fila['coste_unidad']; ?></td>
              <td><?php echo $fila['coste_tonelada']; ?></td>




              <td>
                <a class="btn btn-warning" href="editar_mp.php?codigo=<?php echo $fila['codigo'] ?> ">
                  <i class="fa fa-edit"></i> </a>

                <a class="btn btn-danger" href="eliminar_mp.php?codigo=<?php echo $fila['codigo'] ?>">
                  <i class="fa fa-trash"></i></a>

                  <a class="btn btn-danger" href="eliminar_mp.php?codigo=<?php echo $fila['codigo'] ?>">
                  Calcular precio total</a>


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


</html>