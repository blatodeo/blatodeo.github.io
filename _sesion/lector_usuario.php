<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

  header("Location: index.php");
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

  <title>Usuarios (Lector)</title>
</head>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
    <img class="alcon-logo" src="../img/alcon-logo.png"></img>
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Carrito(0)</a>
            </li>
            <li class="nav-item">
                <div class="alert alert-success">
                    Pantalla de mensaje...
                    <a href="#" class="badge badge-success">Ver carrito</a>
                </div>
            </li>

        </ul>
    </div>
</nav>
<br>
<br>
<br>
</header>



<div class="container is-fluid">



  <br>
  <div class="col-xs-12">
    <h1>Bienvenido Lector <?php echo $_SESSION['nombre']; ?></h1>
    <br>

    <h1>Lista de usuarios</h1>
    <br>
    <div>
      <a class="btn btn-warning" href="cerrarSesion.php">Log Out <i class="fa fa-power-off" aria-hidden="true"></i></a>
      <a class="btn btn-dark" href="../mp/lector_mp.php">Materia Prima <i class="fa fa-box" aria-hidden="true"></i> </a>
      <a class="btn btn-success" href="excel_lector_usuario.php">Excel
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>
       <a class="btn btn-success" href="pdf_usuario_lector.php">PDF
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>

    </div>
    
    <br>
    




    <br>

    <!--<div class="container-fluid">
      <form class="d-flex">
        <input class="form-control me-2 light-table-filter" data-table="table_id" type="text"
         placeholder="Buscar con JS">
         <hr>
      </form>
    </div> -->




      <br>


    <table class="table table-striped table-dark table_id" id="table_id">


      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Fecha</th>
          <th>Rol</th>

        </tr>
      </thead>
      <tbody>

        <?php

        $conexion = mysqli_connect("localhost", "root", "", "alcon");
        $SQL="SELECT usuario.id, usuario.nombre, usuario.correo, usuario.password,
        usuario.fecha, permisos.rol FROM usuario
        LEFT JOIN permisos ON usuario.rol = permisos.id";
                $dato = mysqli_query($conexion, $SQL);

        if ($dato->num_rows > 0) {
          while ($fila = mysqli_fetch_array($dato)) {

        ?>
            <tr>
              <td><?php echo $fila['id']; ?></td>
              <td><?php echo $fila['nombre']; ?></td>
              <td><?php echo $fila['correo']; ?></td>
              <td><?php echo $fila['fecha']; ?></td>
              <td><?php echo $fila['rol']; ?></td>





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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="../js/buscador.js"></script>
    <script src="../js/page.js"></script>
    <script src="../js/acciones.js"></script>
    <script src="../js/user.js"></script>




</html>