<?php session_start(); 
//Here starts the cart


$conexion = mysqli_connect("localhost", "root", "", "alcon");
$SQL = "SELECT * FROM materia_prima ";
$dato = mysqli_query($conexion, $SQL);

if ($dato->num_rows > 0) {
	while ($fila = mysqli_fetch_array($dato)) {



		if (isset($_SESSION['carrito'])) {
			$carrito_mio = $_SESSION['carrito'];
			if (isset($_POST['descripcion'])) {
				$descripcion = $_POST['descripcion'];
				$coste_kg = $_POST['coste_kg'];
				$cantidad = $_POST['cantidad'];
				$num = 0;
				$carrito_mio[] = array("descripcion" => $descripcion, "coste_kg" => $coste_kg, "cantidad" => $cantidad);
			}
		} else {
			$descripcion = $_POST['descripcion'];
			$coste_kg = $_POST['coste_kg'];
			$cantidad = $_POST['cantidad'];
			$carrito_mio[] = array("descripcion" => $descripcion, "coste_kg" => $coste_kg, "cantidad" => $cantidad);
		}

	}
}
$_SESSION['carrito']=$carrito_mio;

//Here finishes the cart


header("Location: ".$_SERVER['HTTP_REFERER']."");
?>



