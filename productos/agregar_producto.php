<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

  header("Location: ../_sesion/login.php");
  die();
}


?>






<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>

	<link rel="stylesheet" href="../css/es.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body id="page-top">


<form  action="product_functions.php" method="POST">
<div id="login" >
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    
                            <br>
                            <br>
                            <h3 class="text-center">Nuevo Producto</h3>
                            <div class="form-group">
                            <label for="codigo_producto" class="form-label">Codigo *</label>
                            <input type="text"  id="codigo_producto" name="codigo_producto" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="linea">Linea:</label><br>
                                <input type="text" name="linea" id="linea" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                  <label for="descripcion" class="form-label">Descripcion *</label>
                                <input type="text"  id="descripcion" name="descripcion" class="form-control" required>
                                
                            </div>
                            <div class="form-group">
                                  <label for="coste_ton" class="form-label">Coste/Tonelada *</label>
                                <input type="number"  id="coste_ton" name="coste_ton" class="form-control" >
                                
                            </div>

                      
                        
                           <br>

                                <div class="mb-3">
                                    
                               <input type="submit" value="Guardar"class="btn btn-success" 
                               name="agregar_producto">
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