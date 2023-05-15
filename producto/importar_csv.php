<?php
// Obtener el código del producto y la descripción a través de la URL
$codigo = $_GET['codigo'];
$descripcion_producto = $_GET['descripcion_producto'];

// Verificar si se ha enviado un archivo CSV
if (isset($_FILES['archivo_csv'])) {
  // Procesar el archivo CSV
  $archivo_csv = $_FILES['archivo_csv']['tmp_name'];
  if (($gestor = fopen($archivo_csv, "r")) !== FALSE) {
    // Conectar a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "alcon");

    // Iniciar transacción
    mysqli_begin_transaction($conexion);

    try {
      // Saltar la primera línea (encabezado)
      fgetcsv($gestor);

      // Recorrer el contenido del archivo CSV y agregar los datos a la tabla 'formula'
      while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $codigo_mp = $datos[0];
        $fecha = date('Y-m-d H:i:s');

        $sql = "INSERT INTO formula (codigo_producto, codigo_mp, fecha) VALUES ('$codigo', '$codigo_mp',  '$fecha')";
        mysqli_query($conexion, $sql);
      }

      // Confirmar la transacción
      mysqli_commit($conexion);

      // Cerrar la conexión a la base de datos
      mysqli_close($conexion);

      // Redirigir al usuario a la página "detalles_producto.php"
      header("Location: detalles_producto.php?codigo=$codigo&descripcion_producto=$descripcion_producto");
      exit();
    } catch (Exception $e) {
      // Revertir la transacción en caso de error
      mysqli_rollback($conexion);
      die("Error al importar datos: " . $e->getMessage());
    }
  } else {
    die("No se ha podido abrir el archivo CSV.");
  }
}
?>
