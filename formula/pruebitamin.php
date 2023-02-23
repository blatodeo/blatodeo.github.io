<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if( $validar == null || $validar = ''){

  header("Location: index.php");
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

<div class="container is-fluid">

<br>

<br>
<div class="container is-fluid">


<div class="col-xs-12">
  		<h1>Bienvenido Administrador <?php echo $_SESSION['nombre']; ?></h1>
      <br>
		<h1>Lista de usuarios</h1>
    <br>
  <!-- <p> Mostrar cantidad de <select name="sel" id="value"> 
        <option value="1">1 Registro</option>
        <option value="2">2 Registros</option>
        <option value="3">3 Registros</option>
    </select>
    <br>-->
    <div>
      <a class="btn btn-success" href="excel_lector_usuario.php">Excel
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>
       <a class="btn btn-success" href="pdf_usuario_lector.php">PDF
       <i class="fa fa-table" aria-hidden="true"></i>
       </a>
       <a class="btn btn-primary" href="registro.php"> Nuevo Usuario 
        <i class="fa fa-plus" aria-hidden="true"></i>
      </a>


    </div>


<!-- Aquí puedes escribir tu comentario 
    <div class="container-fluid"> 
  <form class="d-flex">
			<form action="" method="GET">
			<input class="form-control me-2" type="search" placeholder="Buscar con PHP" 
			name="busqueda"> <br>
			<button class="btn btn-outline-info" type="submit" name="enviar"> <b>Buscar </b> </button> 
			</form>
  </div>-->
  <?php
//$conexion=mysqli_connect("localhost","root","","r_user"); 
//$where="";

//if(isset($_GET['enviar'])){
  //$busqueda = $_GET['busqueda'];


	//if (isset($_GET['busqueda']))
	//{
		//$where="WHERE user.correo LIKE'%".$busqueda."%' OR nombre  LIKE'%".$busqueda."%'
    //OR telefono  LIKE'%".$busqueda."%'";
	//}
  
//}


//?>
   


			</form>
     <!-- <div class="container-fluid">
  <form class="d-flex">
      <input class="form-control me-2 light-table-filter" data-table="table_id" type="text" 
      placeholder="Buscar con JS">
      <hr>
      </form>
  </div>  -->

  <br>


      <table class="table table-striped table-dark table_id " id="table_id">
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
$SQL = "SELECT formula.id, formula.codigo_producto, producto.codigo, producto.descripcion_producto, formula.codigo_mp, materia_prima.descripcion, materia_prima.coste_kg FROM formula
LEFT JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo  LEFT JOIN producto ON formula.codigo_producto = producto.codigo " ;
$dato = mysqli_query($conexion, $SQL);

if ($dato->num_rows > 0) {
  while ($fila = mysqli_fetch_array($dato)) {

?>
<tr>
        <td><?php echo $fila['id']; ?></td>
        <td><?php echo $fila['codigo_producto']. ' - ' .$fila['descripcion_producto']; ?></td>
        <td><?php echo $fila['codigo_mp']. ' - ' .$fila['descripcion']; ?></td>
        <td><?php echo $fila['coste_kg']; ?></td>




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
  <!-- <div id="paginador" class=""></div>-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



<script src="../js/page.js"></script>
<script src="../js/buscador.js"></script>
<script src="../js/user.js"></script>




</html>