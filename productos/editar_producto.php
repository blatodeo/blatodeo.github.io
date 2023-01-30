<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

    header("Location: ../_sesion/login.php");
    die();
}






$codigo_producto = $_GET['codigo_producto'];
$conexion = mysqli_connect("localhost", "root", "", "alcon");
$consulta = "SELECT * FROM producto WHERE codigo_producto = $codigo_producto";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);

?>


<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>


    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body id="page-top">


    <form action="product_functions.php" method="POST">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">

                            <br>
                            <br>
                            <h3 class="text-center">Editar materia prima</h3>
                            <div class="form-group">
                                <label for="linea" class="form-label">Linea *</label>
                                <input type="text" id="linea" name="linea" class="form-control" value="<?php echo $usuario['linea']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion:</label><br>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="" value="<?php echo $usuario['descripcion']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="coste_ton">Coste/Tonelada:</label><br>
                                <input type="number" name="coste_ton" id="coste_ton" class="form-control" value="<?php echo $usuario['coste_ton']; ?>" required>
                                <input type="hidden" name="accion" value="editar_producto">
                                <input type="hidden" name="codigo_producto" value="<?php echo $codigo_producto; ?>">
                            </div>


                            <br>

                            <div class="mb-3">

                                <button type="submit" class="btn btn-success">Editar</button>
                                <a href="productos.php" class="btn btn-danger">Cancelar</a>

                            </div>
                        </div>
                    </div>

    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </form>
</body>

</html>