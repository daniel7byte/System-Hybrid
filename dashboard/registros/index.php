<?php
  require_once('../../config/parameters.php');
  require_once('../../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario'])){
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
    <title>Listado de documentos</title>
    <style media="screen">
      tfoot input {
        width: 99%;
		min-width: 60px;
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
          <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
              <tr>
                <!--th>#</th-->
                <th>Fecha</th>
                <th>E/S</th>
                <th>T. Documento</th>
                <th>Consecutivo</th>
                <th>Ref</th>
                <th>Cant</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <th>Descripcion</th>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>Ref. Admin</th>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>Contabilizado Admin</th>
                <?php } ?>

                <th>Error</th>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>F. Creacion</th>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN' OR $_SESSION['rol'] == 'USER'){ ?>
                  <th>ID. Usuario</th>
                <?php } ?>

                <th>Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!--th>#</th-->
                <th>Fecha</th>
                <th>E/S</th>
                <th>T. Documento</th>
                <th>Consecutivo</th>
                <th>Ref</th>
                <th>Cant</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <th>Descripcion</th>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>Ref. Admin</th>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>Contabilizado Admin</th>
                <?php } ?>

                <th>Error</th>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>F. Creacion</th>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN' OR $_SESSION['rol'] == 'USER'){ ?>
                  <th>ID. Usuario</th>
                <?php } ?>

                <th>Acciones</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
                #if($_SESSION['rol'] == 'ADMIN'){
                  $query = $mysql->prepare("SELECT * FROM registros ORDER BY id DESC");
                #}else{
                #  $query = $mysql->prepare("SELECT * FROM registros WHERE idUsuario = '".$_SESSION['id']."' ORDER BY id DESC");
                #}
                $query->execute();
                $rows = $query->fetchAll();
                foreach ($rows as $row) {
              ?>
              <tr>
                <!--td><?#=$row['id']?></td-->
                <td><?=$row['fechaManual']?></td>
                <td><?=$row['eS']?></td>
                <td><?=$row['tipoDocumento']?></td>
                <td><?=$row['consecutivoManual']?></td>
                <td><?=$row['referencia']?></td>
                <td><?=$row['cantidad']?></td>
                <td>
                  <?php
                    $queryProv = $mysql->prepare("SELECT * FROM proveedores WHERE id = :id");
                    $queryProv->execute([':id' => $row['proveedor']]);
                    $result = $queryProv->fetchAll();
                    foreach ($result as $rowProv) {
                      echo $rowProv['nombre'];
                    }
                  ?>
                </td>
                <td><?=$row['estado']?></td>
                <td><?=$row['descripcion']?></td>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                <td><?=$row['refAdmin']?></td>
                <?php } ?>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <td>
                    <?php if($row['contabilizadoAdmin']){?>
                      <span class="label label-sm label-success">SI <span class="glyphicon glyphicon-ok-sign"></span></span>
                    <?php }else{ ?>
                      <span class="label label-sm label-danger">NO <span class="glyphicon glyphicon-remove-sign"></span></span>
                    <?php } ?>
                  </td>
                <?php } ?>

                <td>
                  <?php if($row['error']){?>
                    <span class="label label-sm label-danger">SI <span class="glyphicon glyphicon-remove-sign"></span></span>
                  <?php }else{ ?>
                    <span class="label label-sm label-success">NO <span class="glyphicon glyphicon-ok-sign"></span></span>
                  <?php } ?>
                </td>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <td><?=$row['fechaCreacion']?></td>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN' OR $_SESSION['rol'] == 'USER'){ ?>
                  <td>
                    <?php
                    $queryUser = $mysql->prepare("SELECT * FROM usuarios WHERE id = :id");
                    $queryUser->execute([':id' => $row['idUsuario']]);
                    $info = $queryUser->fetchAll();
                    foreach ($info as $key) {
                      echo $key['usuario'];
                    }
                    ?>
                  </td>
                <?php } ?>

                <td>
                  <a href="<?=APP_URL?>dashboard/registros/errorStatus.php?id=<?=$row['id']?>" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-warning-sign"></span></a>
                  <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                    <a href="<?=APP_URL?>dashboard/registros/editar.php?id=<?=$row['id']?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="<?=APP_URL?>dashboard/registros/delete.php?id=<?=$row['id']?>" onclick="return confirm('¿Seguro que quiere eliminar este registro?');" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
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
    <script src="<?=APP_URL?>resources/datatables/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#myTable tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
        } );

        // DataTable
        var table = $('#myTable').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
		
		
		$( "input[placeholder|='Fecha']" ).attr('type', 'date');
		$( "input[placeholder|='F. Creacion']" ).attr('type', 'date');
		
    } );
    </script>
  </body>
</html>
