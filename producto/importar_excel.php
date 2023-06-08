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

// Verificar si se ha enviado un archivo EXCEL
if (isset($_FILES['archivo_excel'])) {
  // Procesar el archivo Excel
  $archivo_excel = $_FILES['archivo_excel']['tmp_name'];

  // Leer el archivo Excel usando una biblioteca como PhpSpreadsheet
  // Cargar el archivo Excel
  $spreadsheet = IOFactory::load($archivo_excel);

  // Obtener la hoja de cálculo activa
  $worksheet = $spreadsheet->getActiveSheet();

  // Obtener el valor del código de gestión del producto
  $encontrado = false; // Variable para verificar si se encontró algún código de gestión válido
  $highestRow = $worksheet->getHighestRow();
  $codigo_gestion = null;

  // Recorrer todas las filas del archivo Excel y buscar coincidencia del código de gestión
  for ($row = 2; $row <= $highestRow; $row++) {
    $codigo_gestion = $worksheet->getCell('B' . $row)->getValue();

    if ($codigo_gestion == $codigo) {
      $encontrado = true;
      echo $codigo;
      echo $codigo_gestion;


      break;
    }
  }

  if ($encontrado) {
    // Procesar las filas de la segunda tabla
    $composicion_start_row = $row + 9; // Fila donde comienza la segunda tabla
    $composicion_end_row = $composicion_start_row + 30; // Fila donde termina la segunda tabla

        for ($row = $composicion_start_row; $row <= $composicion_end_row; $row++) {
            $codigo_mp = $worksheet->getCell('A' . $row)->getValue();
            $peso = $worksheet->getCell('E' . $row)->getValue();      // Insertar los datos en la tabla 'formula'

      $sqlInsertar = "INSERT INTO formula (codigo_producto, codigo_mp, peso, fecha) VALUES ('$codigo', '$codigo_mp', '$peso', '$fecha')";
      mysqli_query($conexion, $sqlInsertar);

    // Redirigir al usuario a la página "detalles_producto.php"
    header("Location: detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto&fecha=$fecha");
    }
    exit();

  } else {
    die("No se encontró ningún código de gestión válido para el producto.");
  }
}  
  ?>
