<?php

require_once ("../conexion/_db.php");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
?>


<table class="table table-striped table-dark " id= "table_id">

                   
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
$SQL = "SELECT usuario.id, usuario.nombre, usuario.correo,
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
}
