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
    <title>Listado de proveedores</title>
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
          <h2>Listado de proveedores</h2>
          <hr>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>NIT</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = $mysql->prepare("SELECT * FROM proveedores ORDER BY nombre ASC");
                $query->execute();
                $rows = $query->fetchAll();
                foreach ($rows as $row) {
              ?>
              <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['nombre']?></td>
                <td><?=$row['nit']?></td>
                <td><?=$row['telefono']?></td>
                <td><?=$row['direccion']?></td>
                <td>
                  <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                    <a href="<?=APP_URL?>dashboard/proveedores/editar.php?id=<?=$row['id']?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil"></span></a>

                    <?php
                      $queryCount = $mysql->prepare("SELECT * FROM registros WHERE proveedor = :id");
                      $queryCount->execute([':id' => $row['id']]);
                      $rowCount = $queryCount->rowCount();
                      if ($rowCount > 0) {
                    ?>
                      <button id="Pop<?=$row['id']?>" type="button" class="btn btn-sm btn-info" data-toggle="popover" title="Prohibido eliminar" data-content="Este proveedor está anidado a <?=$rowCount?> documento(s)"><span class="glyphicon glyphicon-info-sign"></span></button>
                      <script type="text/javascript">
                      document.addEventListener('DOMContentLoaded',function(){
                        $('#Pop<?=$row['id']?>').popover();
                      })
                      </script>
                    <?php }else{ ?>
                      <a href="<?=APP_URL?>dashboard/proveedores/delete.php?id=<?=$row['id']?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                    <?php } ?>

                  <?php } ?>
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
