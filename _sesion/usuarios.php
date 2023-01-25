<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

  header("Location: login.php");
  die();
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/brands.js" integrity="sha384-sCI3dTBIJuqT6AwL++zH7qL8ZdKaHpxU43dDt9SyOzimtQ9eyRhkG3B7KMl6AO19" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <link rel="stylesheet" href="../css/fontawesome-all.min.css">
  <link rel="stylesheet" href="../css/styles.css">
  <title></title>
</head>


<div class="container is-fluid">



  <br>
  <div class="col-xs-12">
    <h1>Bienvenido Usuario <?php echo $_SESSION['nombre']; ?></h1>
    <br>

    <h1>Lista de usuarios</h1>
    <br>
    <div>
      <a class="btn btn-success" href="registro.php">Nuevo Usuario <i class="fa fa-plus" aria-hidden="true"></i>
      </a>
      <a class="btn btn-warning" href="cerrarSesion.php">Log Out <i class="fa fa-power-off" aria-hidden="true"></i></a>
      <a class="btn btn-primary" href="../mp/mp.php">Materia Prima <i class="fa fa-box" aria-hidden="true"></i> </a>

    </div>
    
    <br>
    




    <br>


    </form>



    <table class="table table-striped table-dark " id="table_id">


      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Fecha</th>
          <th>Acciones</th>

        </tr>
      </thead>
      <tbody>

        <?php

        $conexion = mysqli_connect("localhost", "root", "", "alcon");
        $SQL = "SELECT * FROM usuario ";
        $dato = mysqli_query($conexion, $SQL);

        if ($dato->num_rows > 0) {
          while ($fila = mysqli_fetch_array($dato)) {

        ?>
            <tr>
              <td><?php echo $fila['id']; ?></td>
              <td><?php echo $fila['nombre']; ?></td>
              <td><?php echo $fila['correo']; ?></td>
              <td><?php echo $fila['fecha']; ?></td>




              <td>
                <a class="btn btn-warning" href="editar_usuario.php?id=<?php echo $fila['id'] ?> ">
                  <i class="fa fa-edit"></i></a>

                <a class="btn btn-danger" href="eliminar_usuario.php?id=<?php echo $fila['id'] ?>">
                  <i class="fa fa-trash"></i></a>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


</html>