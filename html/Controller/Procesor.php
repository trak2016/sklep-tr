<?php 

require_once '../../connection.php'; 


   $plyglo = $_GET['plyglo'];
  $PrSpr = array(); // Tablica do zapisywania wybranych nazw
    //SELECT umożliwiający wydobycie odpowiednich płyt w powiązaniu do grup Obudowy
  $grupaPr = $pdo->prepare("Select * From ListaGrup");
                        $grupaPr->execute();
?>
          
                         
                        <label for="procesor">Procesor</label><br>
                     
                        <select  class="btn btn-primary  btn-block" id="procesor" onchange=" myFunctionPr()">
                             <option value="">-- wybierz --</option>
                        <?php

                        
                        foreach ($grupaPr as $row) {
                          if ($row[idProdukt] == $plyglo){  
                           $procesor = $pdo->prepare("select distinct P.idProdukt, P.Nazwa, LG.idGrupaProduktow From Kategoria as K inner Join Produkt as P
on K.Produkt_idProdukt = P.idProdukt inner Join ListaGrup as LG
on P.idProdukt = LG.idProdukt WHERE NazwaK = 'Procesor'and LG.idGrupaProduktow = $row[idGrupaProduktow]");
                        $procesor->execute();
                        
     foreach ($procesor as $row) {                    
                        
   if(in_array($row['Nazwa'], $PrSpr)){                     

   }
   else {                    
                            echo("<option value=\"" . $row['idProdukt'] . "\">" . $row['Nazwa'] . "</option>");
                         $PrSpr[]= $row['Nazwa'] ;   
                            }
                      
   }
   }
                             
                          }
                        
                        ?>
                    </select>
                        

                    <div class="ProcesorBox">
                        <?php
                        $ProcesorG = $pdo->prepare("select * From Kategoria as K inner Join Produkt as P on K.Produkt_idProdukt= P.idProdukt WHERE NazwaK = 'Procesor'");
                        $ProcesorG->execute();
                        foreach ($ProcesorG as $row) {
                                                        echo"<div id=\"content\">";
                            echo("<div id = \"" . $row['idProdukt'] . "\" class=\"procesor\" style=\"display: none\">");
                            echo "<br>";
                            echo "<div class=\"panel panel-info\">";
                            echo "<div class=\"panel-heading\">";
                            echo "".$row['Nazwa']."";
                              echo"</div>";
                               echo "<div class=\"panel-boody\">";
                            echo "Opis: <br>". $row['Opis']."<br>";
                            echo"</div>";
                             echo "<div class=\"panel-footer\">";
                            echo "cena: ". $row['Cena']."zł.</br>";
                           echo"</div>";
                            
                               echo"</div>";
                                echo"</div>";
                               echo"</div>";
                        }
   
                        ?>
                    </div>  