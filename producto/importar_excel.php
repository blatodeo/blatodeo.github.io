<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
error_reporting(0);
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// Obtener el código del producto y la descripción a través de la URL
$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];
$fecha = $_GET['fecha'];

// Verificar si se ha enviado un archivo CSV
if (isset($_FILES['archivo_excel'])) {
  // Procesar el archivo Excel
  $archivo_excel = $_FILES['archivo_excel']['tmp_name'];

  // Leer el archivo Excel usando una biblioteca como PhpSpreadsheet

  // Importar la biblioteca PhpSpreadsheet


  // Cargar el archivo Excel
  $spreadsheet = IOFactory::load($archivo_excel);

  // Obtener la hoja de cálculo activa
  $worksheet = $spreadsheet->getActiveSheet();

  // Obtener el valor del código de gestión del producto
  $codigo_gestion = $worksheet->getCell('C4')->getValue();

  // Verificar si el código de gestión coincide con el código de producto
  if ($codigo_gestion == $codigo) {
    // Procesar las filas de la composición de la fórmula
    $highestRow = $worksheet->getHighestRow();
    for ($row = 19; $row <= $highestRow; $row++) {
      $codigo_mp = $worksheet->getCell('A' . $row)->getValue();
      $peso = $worksheet->getCell('E' . $row)->getValue();

      // Insertar los datos en la tabla 'formula'
      // Agrega aquí tu código para insertar los datos en la tabla 'formula'
    }

    // Redirigir al usuario a la página "detalles_producto.php"
    header("Location: detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha");
    exit();
  } else {
    die("Este código de producto no coincide con la fórmula.");
  }
} else {
  die("No se ha enviado ningún archivo Excel.");
}
?>
