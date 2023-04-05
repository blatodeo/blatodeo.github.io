<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if( $validar == null || $validar = ''){

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
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/page.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script>$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})</script>
<!-- Navigation -->





<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
    <a class="navbar-brand" href="../_sesion/usuarios.php">
      <img src="../img/alcon-logo.png" alt="..." height="70">
    </a>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link"  href="../_sesion/usuarios.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../mp/mp.php">Materia Prima</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../producto/productos.php">Productos</a>
        </li>
        <li class="nav-item">
            <!-- Button trigger modal -->

            <li class="nav-item">
  <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#exampleModal"> 
    <i class="fa-solid fa-power-off"></i>
  </a>
</li>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Cerrar Sesion?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres cerrar sesion?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button onclick="location.href='../_sesion/index.php'" type="button" class="btn btn-primary">Sí</button>
      </div>
    </div>
  </div>
</div>


          </ul>
        </li>
        </ul>
    </div>
  </div>
</nav>