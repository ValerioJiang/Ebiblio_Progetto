<?php


include('/xampp/htdocs/ebiblio/main_partials/menu.php');


$bibliotecaCon = new BibliotecaController();
$postoCon = new PostoLetturaController();
$prenotazioneCon = new PrenotazionePostoLetturaController();



?>


<div class="container-fluid " style="  
background: url('/ebiblio/images/scaffa.jpg') no-repeat  ;
">


  <div class="container" style="background-color: white;">
    <br>
      <div class="container">
          <h2>Classifiche</h2>
          </br>
          </br>
          <h5>Classifica posti lettura meno utilizzati</h5> 

         
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Biblioteca</th>
                <th>Percentuale posti usati rispetto al totale</th>
                <?php
                  
                  $biblio_res = $bibliotecaCon->list();
                  $arr_res = array();
                  
                  for($j = 0; $j < count($biblio_res); $j++){
                    
                    $prenotazione_res=$prenotazioneCon->createStatisticaPosto($biblio_res[$j]['Nome']);

                    if($prenotazione_res[0]['Biblioteca']== NULL||$prenotazione_res[0]['Percentuale']==NULL){

                    }
                    else{
                      $arr_res[]=$prenotazione_res[0];
                    }
                  }

                  
                  for($i=0; $i<count($arr_res); $i++){
                    $min = $i;
                      for($k = $i+1; $k <count($arr_res); $k++){
                        if((float)$arr_res[$k]['Percentuale'] < (float)$arr_res[$min]){
                            $min =  $k;
                        }
                      }
                      $temp = $arr_res[$min];
                      $arr_res[$min] = $arr_res[$i];
                      $arr_res[$i] = $temp;
                  }
                  
                  for($l = 0; $l < count($arr_res); $l++){
                    echo '<tr>';
                    echo '<td>'.$arr_res[$l]['Biblioteca'].'<td>';
                    echo '<td>'.$arr_res[$l]['Percentuale'].'%<td>';
                    echo '<tr>';
                  }
              

                  

                  


              
                ?>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

    </div>
  </div>

  <?php
  include('/xampp/htdocs/ebiblio/main_partials/footer.php');
  ?>