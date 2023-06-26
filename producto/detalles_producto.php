<?php

date_default_timezone_set('America/Bogota');


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


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alcon";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
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
        <script src="https://kit.fontawesome.com/af4606bedd.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">


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

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>

<br>
<br>



<?php
$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];
$fecha = $_GET['fecha'];

// Imprimir la variable $fecha

// Obtener las dos fechas anteriores
$conexion = mysqli_connect("localhost", "root", "", "alcon");
$SQL = "SELECT DISTINCT fecha FROM formula WHERE codigo_producto = $codigo AND fecha < '$fecha' ORDER BY fecha DESC LIMIT 2";
$resultado = mysqli_query($conexion, $SQL);

// Procesar el resultado de la consulta
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fecha_anterior = $fila['fecha'];
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>




        <a class="btn btn-secondary" href="fechas_formula.php?codigo=<?php echo $_GET['codigo']; ?>&descripcion_producto=<?php echo $_GET['descripcion_producto']; ?>&fecha=<?php echo $_GET['fecha']; ?>">
          Regresar a Fechas Formula                
        <i class="fa-solid fa-delete-left"></i></a>

                <a class="btn btn-primary" href="agregar_mp_formula.php?codigo=<?php echo $codigo; ?>&descripcion_producto=<?php echo $descripcion_producto; ?>&fecha=<?php echo $fecha; ?>"
>
        <i class="fa fa-plus"></i> Agregar Materia Prima
    </a>

    <br>
    <br>

    <form action="importar_csv.php?codigo=<?php echo $codigo ?>&descripcion_producto=<?php echo $descripcion_producto ?>&fecha=<?php echo $fecha ?>" method="post" enctype="multipart/form-data">
  <label for="archivo_csv">Seleccionar archivo CSV:</label>
  <input type="file" name="archivo_csv" id="archivo_csv">
  <input type="submit" value="Importar">
    </form>

    <form action="importar_excel.php?codigo=<?php echo $codigo ?>&descripcion_producto=<?php echo $descripcion_producto ?>&fecha=<?php echo $fecha ?>" method="post" enctype="multipart/form-data">
  <label for="archivo_excel">Seleccionar archivo Excel:</label>
  <input type="file" name="archivo_excel" id="archivo_excel" accept=".xlsx, .xls">
  <input type="submit" value="Importar">
    </form>


<br>

<form action="product_functions.php" method="POST">
  <input type="hidden" name="accion" value="eliminar_datos">
  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
  <input type="hidden" name="descripcion_producto" value="<?php echo $descripcion_producto; ?>">
  <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">

  <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar todos los datos de la tabla?')">Eliminar todos los datos</button>
</form>

<div style="display: flex; align-items: center;">
  <h1 style="margin-right: 20px;">PRODUCTO <?php echo $codigo; ?></h1>
  <h1 style="margin-left: 600px;">Fecha: <?php echo $fecha; ?></h1>
</div>





<?php

// Consulta para obtener los datos de ID, Codigo y Materia Prima
$consulta_info = "SELECT 
                    formula.id,
                    materia_prima.codigo,
                    materia_prima.descripcion,
                    (SELECT precio FROM precio_mp WHERE precio_mp.mp = materia_prima.codigo AND linea_precio = 6) AS precio
                  FROM formula 
                  INNER JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo
                  WHERE codigo_producto = '$codigo'  
                  AND fecha = '$fecha'";

// Ejecutar consulta para obtener los datos de ID, Codigo y Materia Prima
$resultado_info = $conn->query($consulta_info);

// Obtener datos de ID, Codigo y Materia Prima
$datos_info = array();
if ($resultado_info->num_rows > 0) {
    while ($fila_info = $resultado_info->fetch_assoc()) {
        $datos_info[] = $fila_info;
    }
}

// Consultas
$consulta1 = "SELECT peso FROM formula WHERE codigo_producto = '10204' AND fecha = '$fecha_anterior' AND peso IS NOT NULL";
$consulta2 = "SELECT peso FROM formula WHERE codigo_producto = '10204' AND fecha = '$fechas_anteriores[1]' AND peso IS NOT NULL";
$consulta3 = "SELECT peso FROM formula WHERE codigo_producto = '10204' AND fecha = '$fecha' AND peso IS NOT NULL";

// Ejecutar consultas
$resultado1 = $conn->query($consulta1);
$resultado2 = $conn->query($consulta2);
$resultado3 = $conn->query($consulta3);

// Obtener datos de los pesos de las consultas
$datos1 = array();
if ($resultado1->num_rows > 0) {
    while ($fila1 = $resultado1->fetch_assoc()) {
        $datos1[] = $fila1["peso"];
    }
} else {
    $datos1[] = "No hay datos";
}

$datos2 = array();
if ($resultado2->num_rows > 0) {
    while ($fila2 = $resultado2->fetch_assoc()) {
        $datos2[] = $fila2["peso"];
    }
} else {
    $datos2[] = "No hay datos";
}

$datos3 = array();
if ($resultado3->num_rows > 0) {
    while ($fila3 = $resultado3->fetch_assoc()) {
        $datos3[] = $fila3["peso"];
    }
} else {
    $datos3[] = "No hay datos";
}
?>
<!-- Crear tabla HTML -->



    <table class="table table_id table-light table-blue" id="table_id">
        
        <tr>
            <th style="border: 1px solid black; text-align: center;" class="text-center"  colspan="1"></th>
            <th style="border: 1px solid black; text-align: center;" class="text-center"  colspan="1"></th>
            <th style="border: 1px solid black; text-align: center;" class="text-center"  colspan="1"></th>
            <th style="border: 1px solid black; text-align: center;" class="text-center"  colspan="1"></th>
            <th style="border: 1px solid black; text-align: center;" class="text-center" style="background-color: #64a377;" colspan="2">
                <?php
                $codigo = $_GET['codigo'];
                $descripcion_producto = $_GET['descripcion_producto'];
                $fecha = $_GET['fecha'];

                // Obtener la segunda fecha anterior a la de la segunda columna
                $conexion = mysqli_connect("localhost", "root", "", "alcon");
                $SQL = "SELECT DISTINCT fecha FROM formula WHERE codigo_producto = $codigo AND fecha < '$fecha' ORDER BY fecha DESC LIMIT 2";
                $resultado = mysqli_query($conexion, $SQL);

                // Procesar el resultado de la consulta
                if ($resultado) {
                    $fechas_anteriores = [];
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $fechas_anteriores[] = $fila['fecha'];
                    }

                    if (count($fechas_anteriores) >= 2) {
                        $fecha_anterior = $fechas_anteriores[1];
                        echo "Fecha costeo: $fecha_anterior<br>";
                    }
                } else {
                    echo "Error en la consulta: " . mysqli_error($conexion);
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conexion);
                ?>
            </th>
            <th style="border: 1px solid black; text-align: center;" class="text-center" colspan="2" style="background-color: #fad2b2;">
                <?php
                $codigo = $_GET['codigo'];
                $descripcion_producto = $_GET['descripcion_producto'];
                $fecha = $_GET['fecha'];

                // Imprimir la variable $fecha
                //echo "Fecha actual: $fecha<br>";

                // Obtener las dos fechas anteriores
                $conexion = mysqli_connect("localhost", "root", "", "alcon");
                $SQL = "SELECT DISTINCT fecha FROM formula WHERE codigo_producto = $codigo AND fecha < '$fecha' ORDER BY fecha DESC LIMIT 1";
                $resultado = mysqli_query($conexion, $SQL);

                // Procesar el resultado de la consulta
                if ($resultado) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $fecha_anterior = $fila['fecha'];
                        echo "Fecha costeo: $fecha_anterior<br>";
                    }
                } else {
                    echo "Error en la consulta: " . mysqli_error($conexion);
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conexion);
                ?>
            </th>
            <th style="border: 1px solid black; text-align: center;" class="text-center" style="background-color: #84abca;" colspan="2">Fecha costeo: <?php echo $fecha; ?></th>
            <th style="border: 1px solid black; text-align: center;" class="text-center"></th>
        </tr>
    <tr>
        <th style="border: 1px solid black; text-align: center;">ID</th>
        <th style="border: 1px solid black; text-align: center;">Codigo</th>
        <th style="border: 1px solid black; text-align: center;">Materia Prima</th>
        <th style="border: 1px solid black; text-align: center;">Precio</th>
        <th style="border: 1px solid black; text-align: center;">Kg/Batch</th>
        <th style="border: 1px solid black; text-align: center;">Costo MP</th>
        <th style="border: 1px solid black; text-align: center;">Kg/Batch</th>
        <th style="border: 1px solid black; text-align: center;">Costo MP</th>
        <th style="border: 1px solid black; text-align: center;">Kg/Batch</th>
        <th style="border: 1px solid black; text-align: center;">Costo MP</th>
        <th style="border: 1px solid black; text-align: center;">Eliminar</th>

    </tr>

            

    <?php 
    // Consulta para obtener los datos de ID, Codigo y Materia Prima
$consulta_info = "SELECT 
formula.id,
materia_prima.codigo,
materia_prima.descripcion,
(SELECT precio FROM precio_mp WHERE precio_mp.mp = materia_prima.codigo AND linea_precio = 6) AS precio
FROM formula 
INNER JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo
WHERE codigo_producto = '$codigo'  
AND fecha = '$fecha'";

// Ejecutar consulta para obtener los datos de ID, Codigo y Materia Prima
$resultado_info = $conn->query($consulta_info);

// Obtener datos de ID, Codigo y Materia Prima
$datos_info = array();
if ($resultado_info->num_rows > 0) {
while ($fila_info = $resultado_info->fetch_assoc()) {
$datos_info[] = $fila_info;
}
}

// Consultas
$consulta1 = "SELECT formula.peso, materia_prima.codigo, materia_prima.descripcion FROM formula LEFT JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo WHERE formula.codigo_producto = '$codigo' AND formula.fecha = '$fechas_anteriores[1]' AND formula.peso IS NOT NULL; ";
$consulta2 = "SELECT formula.peso, materia_prima.codigo, materia_prima.descripcion FROM formula LEFT JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo WHERE formula.codigo_producto = '$codigo' AND formula.fecha = '$fechas_anteriores[0]' AND formula.peso IS NOT NULL; ";
$consulta3 = "SELECT formula.peso, materia_prima.codigo, materia_prima.descripcion FROM formula LEFT JOIN materia_prima ON formula.codigo_mp = materia_prima.codigo WHERE formula.codigo_producto = '$codigo' AND formula.fecha = '$fecha' AND formula.peso IS NOT NULL;";


// Ejecutar consultas
$resultado1 = $conn->query($consulta1);
$resultado2 = $conn->query($consulta2);
$resultado3 = $conn->query($consulta3);
$resultado4 = $conn->query($consulta1);


// Obtener datos de los pesos de las consultas
$datos1 = array();
if ($resultado1->num_rows > 0) {
while ($fila1 = $resultado1->fetch_assoc()) {
    $datos1[] = $fila1["codigo"];
    $datos1[] = $fila1["descripcion"];
    $datos1[] = $fila1["peso"];
}
} else {
$datos1[] = "No hay datos";
}

$datos2 = array();
if ($resultado2->num_rows > 0) {
while ($fila2 = $resultado2->fetch_assoc()) {
    $datos2[] = $fila2["peso"];
}
} else {
$datos2[] = "No hay datos";
}

$datos3 = array();
if ($resultado3->num_rows > 0) {
while ($fila3 = $resultado3->fetch_assoc()) {
    $datos3[] = $fila3["peso"];
}
} else {
$datos3[] = "No hay datos";
}

$datos4 = array();
if ($resultado4->num_rows > 0) {
while ($fila4 = $resultado4->fetch_assoc()) {
    $datos4[] = $fila4["peso"];
}
} else {
$datos4[] = "No hay datos";
}


$totalPeso1 = 0;
$totalPeso2 = 0;
$totalPeso3 = 0;

$totalCosto1 = 0;
$totalCosto2 = 0;
$totalCosto3 = 0;




    $maxFilas = count($datos_info);
    for ($i = 0; $i < $maxFilas; $i++): 
    $totalPeso1 += isset($datos4[$i]) ? $datos4[$i] : 0;
    $totalPeso2 += isset($datos2[$i]) ? $datos2[$i] : 0;
    $totalPeso3 += isset($datos3[$i]) ? $datos3[$i] : 0;
    
    $totalCosto1 += isset($datos4[$i]) && isset($datos_info[$i]['precio']) ? $datos4[$i] * $datos_info[$i]['precio'] : 0;
    $totalCosto2 += isset($datos2[$i]) && isset($datos_info[$i]['precio']) ? $datos2[$i] * $datos_info[$i]['precio'] : 0;
    $totalCosto3 += isset($datos3[$i]) && isset($datos_info[$i]['precio']) ? $datos3[$i] * $datos_info[$i]['precio'] : 0;?>
        <tr>
            <td style="border: 1px solid black; text-align: center;" style="color: black;"><?php echo isset($datos_info[$i]['id']) ? $datos_info[$i]['id'] : ""; ?></td>
            <td style="border: 1px solid black; text-align: center; color: black;"><?php echo isset($datos_info[$i]['codigo']) ? $datos_info[$i]['codigo'] : ""; ?>    </td>
            <td style="border: 1px solid black; text-align: center;" style="color: black;"><?php echo isset($datos_info[$i]['descripcion']) ? $datos_info[$i]['descripcion'] : ""; ?></td>
            <td style="border: 1px solid black; text-align: center;" style="color: black;"><?php echo isset($datos_info[$i]['precio']) ? intval(number_format($datos_info[$i]['precio'], 2, '.', '')) : ""; ?></td>
            <!-- Columnas peso y costo MP -->

            <td style="border: 1px solid black; text-align: center; background-color: #64a377; color: black;"><?php echo isset($datos4[$i]) ? $datos4[$i] : ""; ?></td>
            <td style="border: 1px solid black; text-align: center; background-color: #64a377; color: black;"><?php echo isset($datos4[$i]) && isset($datos_info[$i]['precio']) ? number_format($datos4[$i] * $datos_info[$i]['precio'], 0, ',', '.') : ""; ?></td>

            <td style="border: 1px solid black; text-align: center; background-color: #fad2b2; color: black;"><?php echo isset($datos2[$i]) ? $datos2[$i] : ""; ?></td>
            <td style="border: 1px solid black; text-align: center; background-color: #fad2b2; color: black;"><?php echo isset($datos2[$i]) && isset($datos_info[$i]['precio']) ? number_format($datos2[$i] * $datos_info[$i]['precio'], 0, ',', '.') : ""; ?></td>

            <td style="border: 1px solid black; text-align: center; background-color: #84abca; color: black;"><?php echo isset($datos3[$i]) ? $datos3[$i] : ""; ?></td>
            <td style="border: 1px solid black; text-align: center; background-color: #84abca; color: black;"><?php echo isset($datos3[$i]) && isset($datos_info[$i]['precio']) ? number_format($datos3[$i] * $datos_info[$i]['precio'], 0, ',', '.') : ""; ?></td>


            <td style="border: 1px solid black; text-align: center;" class="text-center">
                        <a class="btn btn-danger"
                            href="eliminar_mp_formula.php?id=<?php echo $datos_info[$i]['id'] ?>&codigo_mp=<?php echo ($datos_info[$i]['codigo']) ?>&descripcion_producto=<?php echo ($datos_info[$i]['descripcion']) ?>">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
        </tr>

    <?php endfor; ?>

    <tr>
    <td style="border: 1px solid black; text-align: center;"></td> <!-- Columnas vacías para alinear la celda del total de peso -->
    <td style="border: 1px solid black; text-align: center;"></td> <!-- Columnas vacías para alinear la celda del total de peso -->
    <td style="border: 1px solid black; text-align: center;"></td> <!-- Columnas vacías para alinear la celda del total de peso -->
    <td style="border: 1px solid black; text-align: center;"></td> <!-- Columnas vacías para alinear la celda del total de peso -->

        <td style="border: 1px solid black; text-align: center; background-color: #64a377; color: black;">Total Peso:<?php echo $totalPeso1; ?></td>
        <td style="border: 1px solid black; text-align: center; background-color: #64a377; color: black;">Total Costo:<?php echo number_format($totalCosto1, 0, ',', '.'); ?></td>

        <td style="border: 1px solid black; text-align: center; background-color: #fad2b2; color: black;">Total Peso:<?php echo $totalPeso2; ?></td>
        <td style="border: 1px solid black; text-align: center; background-color: #fad2b2; color: black;">Total Costo:<?php echo number_format($totalCosto2, 0, ',', '.'); ?></td>

        <td style="border: 1px solid black; text-align: center; background-color: #84abca; color: black;">Total Peso:<?php echo $totalPeso3; ?></td>
        <td style="border: 1px solid black; text-align: center; background-color: #84abca color: black;">Total Costo:<?php echo number_format($totalCosto3, 0, ',', '.'); ?></td>


        <td style="border: 1px solid black; text-align: center;"></td> <!-- Columnas vacías para alinear la celda del total de peso -->
    </tr>

</table>


<br>

<style>
  .tabla {
        margin-bottom: 20px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;

    }


    th {
        background-color: darkgrey;
    }

    th[colspan="2"] {
        background-color: grey;
    }


    .costo-tonelada {
        color: green;
    }
</style>

<?php
$maquila = 105000;
$etiqueta_empaque = 25050;
$administracion_impuestos = 117298;


$totalPorTonelada = ($totalCostoMP + $maquila + $etiqueta_empaque + $administracion_impuestos);
$costo_kg = ($totalPorTonelada/$totalPeso);


echo '<div class="tabla">
      <table>
        <tr>
            <th colspan="2" style="text-align: center;"><strong>COSTEO IVA:</strong></th>
        </tr>

        <tr>
            <th>CONCEPTO</th>
            <th>MONTO</th>
        </tr>
        <tr>
            <td><strong>Maquila:</strong></td>
            <td>$' . number_format($maquila, 2, '.', ',') . '</td>
        </tr>
        <tr>
            <td><strong>Etiqueta y Empaque:</strong></td>
            <td>$' . number_format($etiqueta_empaque, 2, '.', ',') . '</td>
        </tr>
        <tr>
            <td><strong>Administración e Impuestos:</strong></td>
            <td>$' . number_format($administracion_impuestos, 2, '.', ',') . '</td>
        </tr>
        <tr>
          <td><strong>Costo por KG:</strong></td>
          <td>$' . number_format($costo_kg, 2, '.', ',') . '</td>
        </tr>

        <tr>
            <th colspan="2" style="text-align: center;"><strong>EL COSTO POR TONELADA ES:</strong></th>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;"><span class="costo-tonelada">$' . number_format($totalPorTonelada, 2, '.', ',') . '</span></td>
        </tr>
        
    </table>
    </div>

    <div class="tabla">
    <table>
        <tr>
            <th colspan="2" style="text-align: center;"><strong>PAGO DE CONTADO SIN IVA:</strong></th>
        </tr>

        <tr>
          <th>CONCEPTO</th>
          <th>MONTO</th>
        </tr>
        <tr>
            <td><strong>Precio sugerido por KG:</strong></td>
            <td>$' . number_format($maquila, 2, '.', ',') . '</td>
        </tr>
        <tr>
            <td><strong>Precio de venta sugerido por KG:</strong></td>
            <td>$' . number_format($etiqueta_empaque, 2, '.', ',') . '</td>
        </tr>
        <tr>
            <td><strong>Utilidad real:</strong></td>
            <td>$' . number_format($administracion_impuestos, 2, '.', ',') . '</td>
        </tr>
    </table>
    </div>
    
    <div class="tabla">
    <table>
        <tr>
            <th colspan="2" style="text-align: center;"><strong>COSTO FORMULA POR MP:</strong></th>
        </tr>

        <tr>
          <th>CONCEPTO</th>
          <th>MONTO</th>
        </tr>
        <tr>
            <td><strong>Precio de venta por KG:</strong></td>
            <td>$' . number_format($maquila, 2, '.', ',') . '</td>
        </tr>
        <tr>
            <td><strong>AIU Real:</strong></td>
            <td>$' . number_format($etiqueta_empaque, 2, '.', ',') . '</td>
        </tr>
        <tr>
            <td><strong>AIU Real:</strong></td>
            <td>$' . number_format($administracion_impuestos, 2, '.', ',') . '</td>
        </tr>
    </table>
    </div>';
?>
<?php
// Cerrar conexión
$conn->close();


?>


<script src="../js/page.js"></script>
<script src="../js/buscador.js"></script>
<script src="../js/user.js"></script>
<script src="../js/acciones.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>  </body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</body>

</html>