<?php
require_once('/xampp/htdocs/ebiblio/utilizzatore/utiliz_partials/menu.php');
?>

<div>

<?php
  if(isset($_GET['email'])){
    $utiliz_con = new UtilizzatoreController();
    

    session_start();
    $_SESSION['Utilizzatore']=$_GET['email'];

  }
  echo "Ciaoooo";
?>

</div>

<?php
  require_once('/xampp/htdocs/ebiblio/utilizzatore/utiliz_partials/footer.php');
  ?>