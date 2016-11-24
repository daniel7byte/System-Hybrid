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
    <title>Editar Proveedor</title>
  </head>
  <body>
    <em>
      <?php
        $query = $mysql->prepare("UPDATE proveedores SET
          nombre = :nombre,
          nit = :nit,
          telefono = :telefono,
          direccion = :direccion
          WHERE id = :id");
        $query->execute([
          ':nombre' => $_POST['nombre'],
          ':nit' => $_POST['nit'],
          ':telefono' => $_POST['telefono'],
          ':direccion' => $_POST['direccion'],
          ':id' => $_POST['id']
        ]);
        echo "Editado!";
      ?>
      <script type="text/javascript">
        setTimeout(function(){ window.location = '<?=APP_URL?>dashboard/proveedores/index.php'; }, 1000);
      </script>
    </em>
    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
