<?php
  require_once('../../config/parameters.php');
  require_once('../../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario']) && $_SESSION['rol'] == 'ADMIN'){
    header('Location: ' . APP_URL . 'index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/css/flatly.min.css">
    <title>Crear Proveedor</title>
  </head>
  <body style="padding-top: 60px;">

    <?php include('../layouts/navbar.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>Formulario de registro</h2>
          <hr>
          <div class="well">
            <form class="form-horizontal" action="crearSQL.php" method="post" autocomplete="off">
              <fieldset>

                <div class="form-group">
                  <label for="nombre" class="col-lg-2 control-label">Nombre</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" required autofocus>
                  </div>
                </div>

                <div class="form-group">
                  <label for="nit" class="col-lg-2 control-label">NIT</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="nit" name="nit" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="telefono" class="col-lg-2 control-label">Telefono</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="telefono" name="telefono" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="direccion" class="col-lg-2 control-label">Direccion</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="direccion" name="direccion" >
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Limpiar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
