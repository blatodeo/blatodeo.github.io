<?php

// Importar la biblioteca PhpSpreadsheet
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
error_reporting(0);

// Establecer los detalles de la conexión
$host = 'localhost'; // Cambia esto si tu base de datos está en un servidor remoto
$username = 'root';
$password = '';
$database = 'alcon';

// Crear la conexión
$conexion = mysqli_connect($host, $username, $password, $database);

// Verificar si la conexión se estableció correctamente
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}


// Obtener el código del producto y la descripción a través de la URL
$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];
$fecha = $_GET['fecha'];

// Verificar si se ha enviado un archivo CSV
if (isset($_FILES['archivo_excel'])) {
  // Procesar el archivo Excel
  $archivo_excel = $_FILES['archivo_excel']['tmp_name'];

  // Leer el archivo Excel usando una biblioteca como PhpSpreadsheet



  // Cargar el archivo Excel
  $spreadsheet = IOFactory::load($archivo_excel);

  // Obtener la hoja de cálculo activa
  $worksheet = $spreadsheet->getActiveSheet();

  // Obtener el valor del código de gestión del producto
  $codigo_gestion = $worksheet->getCell('B4')->getValue();

// Verificar si el código de gestión coincide con el código de producto
if ($codigo_gestion == $codigo) {
    // Procesar las filas de la composición de la fórmula
    $highestRow = $worksheet->getHighestRow();
    for ($row = 19; $row <= $highestRow; $row++) {
      $codigo_mp = $worksheet->getCell('A' . $row)->getValue();
      $peso = $worksheet->getCell('E' . $row)->getValue();

      // Insertar los datos en la tabla 'formula'
      $sqlInsertar = "INSERT INTO formula (codigo_producto, codigo_mp, peso, fecha) VALUES ('$codigo', '$codigo_mp', '$peso', '$fecha')";
      mysqli_query($conexion, $sqlInsertar);
    }
  
    // Redirigir al usuario a la página "detalles_producto.php"
    header("Location: detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha");
    exit();
  } else {
    die("Este código de producto no coincide con la fórmula.");
  }  
}
  ?>
