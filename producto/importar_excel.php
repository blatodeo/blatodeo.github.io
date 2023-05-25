<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




session_start();
error_reporting(0);

require 'PHPExcel/PHPExcel.php';

// Obtener el código del producto y la descripción a través de la URL
$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];
$fecha = $_GET['fecha'];

// Verificar si se ha enviado un archivo Excel
if (isset($_FILES['archivo_excel'])) {
  // Obtener el archivo Excel y cargarlo en PHPExcel
  $archivo_excel = $_FILES['archivo_excel']['tmp_name'];
  $objPHPExcel = PHPExcel_IOFactory::load($archivo_excel);

  // Seleccionar la primera hoja del archivo
  $hoja = $objPHPExcel->getActiveSheet();

  // Obtener el número de filas y columnas
  $ultimaColumna = $hoja->getHighestColumn();
  $ultimaFila = $hoja->getHighestRow();

  // Conectar a la base de datos
  $conexion = mysqli_connect("localhost", "root", "", "alcon");

  // Iniciar transacción
  mysqli_begin_transaction($conexion);

  try {
    // Eliminar los datos existentes en la tabla 'formula' para el producto y fecha específicos
    $sqlEliminar = "DELETE FROM formula WHERE codigo_producto = '$codigo' AND fecha = '$fecha'";
    mysqli_query($conexion, $sqlEliminar);

    // Recorrer las filas del archivo Excel y agregar los datos a la tabla 'formula'
    for ($fila = 2; $fila <= $ultimaFila; $fila++) {
      $codigo_mp = $hoja->getCell('A' . $fila)->getValue();
      $peso = $hoja->getCell('E' . $fila)->getValue();

      $sqlInsertar = "INSERT INTO formula (codigo_producto, codigo_mp, peso, fecha) VALUES ('$codigo', '$codigo_mp', '$peso', '$fecha')";
      mysqli_query($conexion, $sqlInsertar);
    }

    // Confirmar la transacción
    mysqli_commit($conexion);

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir al usuario a la página "detalles_producto.php"
    header("Location: detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha");
    exit();
  } catch (Exception $e) {
    // Revertir la transacción en caso de error
    mysqli_rollback($conexion);
    die("Error al importar datos: " . $e->getMessage());
  }
}
?>
