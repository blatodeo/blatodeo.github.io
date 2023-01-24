<?php

$codigo = $_GET['codigo'];
$conexion = mysqli_connect("localhost", "root", "", "alcon");
$consulta = "SELECT * FROM materia_prima WHERE codigo = $codigo";
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


    <form action="../includes/_functions.php" method="POST">
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
                                <label for="coste_kg">Coste/Kg:</label><br>
                                <input type="coste_kg" name="coste_kg" id="coste_kg" class="form-control" value="<?php echo $usuario['coste_kg']; ?>" required>
                                <input type="hidden" name="accion" value="editar_mp">
                                <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                            </div>


                            <br>

                            <div class="mb-3">

                                <button type="submit" class="btn btn-success">Editar</button>
                                <a href="mp.php" class="btn btn-danger">Cancelar</a>

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