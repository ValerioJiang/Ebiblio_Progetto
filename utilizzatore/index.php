<?php
require_once('/xampp/htdocs/ebiblio/utilizzatore/utiliz_partials/menu.php');
?>

<div>

<?php
  if(isset($_GET['email'])){
    session_start();
    $_SESSION['Utilizzatore']=$_GET['email'];

  }
  echo "Ciaoooo";
?>

</div>

<?php
  require_once('/xampp/htdocs/ebiblio/utilizzatore/utiliz_partials/footer.php');
  ?>