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
    <title>Marcado de Error</title>
  </head>
  <body>
    <em>
      <?php
        $query = $mysql->prepare("UPDATE registros SET error = :error WHERE id = :id");
        $query->execute([
          ':error' => 1,
          ':id' => $_GET['id']
        ]);
        echo "Marcado como error!";
      ?>
      <script type="text/javascript">
        setTimeout(function(){ window.location = '<?=APP_URL?>dashboard/registros/index.php'; }, 1000);
      </script>
    </em>
    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
