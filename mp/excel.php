<?php

require_once("../conexion/_db.php");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
?>


<table class="table table-striped table-dark " id="table_id">


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
        }
