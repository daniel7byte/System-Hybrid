<?php
  require_once('../../config/parameters.php');
  require_once('../../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario']) && $_SESSION['rol'] == 'ADMIN'){
    header('Location: ' . APP_URL . 'index.php');
    exit;
  }
  $query = $mysql->prepare("SELECT * FROM proveedores WHERE id = :id");
  $query->execute([':id' => $_GET['id']]);
  $row = $query->fetchObject();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/css/flatly.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap-select/css/bootstrap-select.min.css">
    <title>Editar Proveedor</title>
  </head>
  <body style="padding-top: 60px;">

    <?php include('../layouts/navbar.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>Formulario de registro</h2>
          <hr>
          <div class="well">
            <form class="form-horizontal" action="editarSQL.php" method="post" autocomplete="off">
              <input type="hidden" name="id" value="<?=$_GET['id']?>">
              <fieldset>

                <div class="form-group">
                  <label for="nombre" class="col-lg-2 control-label">Nombre</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$row->nombre?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="nit" class="col-lg-2 control-label">NIT</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="nit" name="nit" value="<?=$row->nit?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="telefono" class="col-lg-2 control-label">Telefono</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?=$row->telefono?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="direccion" class="col-lg-2 control-label">Direccion</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?=$row->direccion?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Editar</button>
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
    <script src="<?=APP_URL?>resources/bootstrap-select/js/bootstrap-select.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap-select/js/i18n/defaults-es_ES.min.js" charset="utf-8"></script>
  </body>
</html>
