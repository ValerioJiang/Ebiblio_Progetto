<?php
                        require_once('/xampp/htdocs/ebiblio/volontario/main_partials/menu.php');
                        $consCon = new ConsegnaController();
                        if(isset($_GET['restit'])){
                            $cons_upd = $consCon -> updateRest($_SESSION['email'],$_GET['codConsegna']);
                            
                            echo "<script type='text/javascript'>alert('Disdetta con successo');
                                    window.location = 'http://localhost/ebiblio/volontario'; 
                                  </script>";
                        }
?>