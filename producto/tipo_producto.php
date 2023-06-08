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

?>

<!DOCTYPE html>
<html lang="en">

<?php include "../navbar/html.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/af4606bedd.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/af4606bedd.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">

    <style>
        .table thead,
        .table tfoot {
            background-color: #455a64;
            color: azure;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            margin-top: 50px; /* Modificación para mover el título hacia abajo */
        }

        .date-button {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .date-button button {
            margin: 0 5px;
        }
    </style>
</head>


<?php

$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];
?>

<body>
<a class="btn btn-secondary" href="productos.php">
          MAQUILA               
        <i class="fa-solid fa-delete-left"></i></a>

        <a class="btn btn-primary" href="agregar_fecha.php?codigo=<?php echo $_GET['codigo']; ?>&descripcion_producto=<?php echo $_GET['descripcion_producto']; ?>">
          COMERCIALES              
        <i class="fa-solid fa-plus"></i></a>


    <div class="container">
        <h2 class="title">Seleccione una lista de productos</h2> <!-- Modificación para cambiar a un encabezado de nivel 2 (h2) -->
        <div class="date-button">
        <?php
$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];

$conexion = mysqli_connect("localhost", "root", "", "alcon");
$SQL = "SELECT DISTINCT fecha FROM formula WHERE codigo_producto = $codigo AND fecha IS NOT NULL";
$dato = mysqli_query($conexion, $SQL);

if ($dato->num_rows > 0) {
    while ($fila = mysqli_fetch_array($dato)) {
        $fecha = $fila['fecha'];
        // Resto de tu código para mostrar las fechas
        ?>
        <!-- Tu código HTML/PHP para mostrar las fechas -->

              <a class="btn btn-primary" href="detalles_producto.php?codigo=<?php echo $_GET['codigo']; ?>&descripcion_producto=<?php echo $_GET['descripcion_producto']; ?>&fecha=<?php echo urlencode($fila['fecha']); ?>">
                  Fecha: <?php echo $fila['fecha']; ?>
              </a>

              <?php
    }
} else {
    // No se encontraron fechas registradas
    echo "Aún no se han registrado fechas";
}
?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="../js/page.js"></script>
    <script src="../js/buscador.js"></script>
    <script src="../js/user.js"></script>
</body>

</html>
