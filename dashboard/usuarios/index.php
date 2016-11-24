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
    <link rel="stylesheet" href="<?=APP_URL?>resources/datatables/css/jquery.dataTables.min.css">
    <title>Listado de usuarios</title>
    <style media="screen">
      tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
      }
    </style>
  </head>
  <body style="padding-top: 60px;">

    <?php include('../layouts/navbar.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>Listado de documentos</h2>
          <hr>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>ROL</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = $mysql->prepare("SELECT * FROM usuarios ORDER BY id DESC");
                $query->execute();
                $rows = $query->fetchAll();
                foreach ($rows as $row) {
              ?>
              <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['usuario']?></td>
                <td><?=$row['rol']?></td>
                <td>
                  <a href="<?=APP_URL?>dashboard/usuarios/delete.php?id=<?=$row['id']?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="<?=APP_URL?>resources/js/jquery-1.12.3.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
