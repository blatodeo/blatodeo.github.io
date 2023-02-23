<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

    header("Location: ../_sesion/index.php");
    die();
}






$id = $_GET['id'];
$conexion = mysqli_connect("localhost", "root", "", "alcon");
$consulta = "SELECT * FROM linea WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);

?>


<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Linea</title>


    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body id="page-top">


    <form action="functions_linea.php" method="POST">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">

                            <br>
                            <br>
                            <h3 class="text-center">Editar linea</h3>
                            <div class="form-group">
                                <label for="linea" class="form-label">Linea *</label>
                                <input type="text" id="linea" name="linea" class="form-control" value="<?php echo $usuario['linea']; ?>" required>
                                <input type="hidden" name="accion" value="editar_linea">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">

                            </div>
                            <br>

                            <div class="mb-3">

                                <button type="submit" class="btn btn-success">Editar</button>
                                <a href="lineas.php" class="btn btn-danger">Cancelar</a>

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