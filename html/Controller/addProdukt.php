
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sklep internetowy</title> 
        <link href="../Content/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Content/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="../Content/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../Content/css/style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="../Content/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../plik.js"></script>


    </head>
    <body>

      <div class="zawartosc">
 <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Grupowanie "marki" i przycisku rozwijania mobilnego menu -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Rozwiń nawigację</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index_admin.php">Twój Komputer</a>
    </div>

    <!-- Grupowanie elementów menu w celu lepszego wyświetlania na urządzeniach moblinych -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li><a href="../View/logout.php">Wyloguj</a></li>
             <li>
      </ul>
        <ul class="nav navbar-nav">
            <li>
                    <a href="../addProdukt.php">Nowy Produkt</a>
                        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

        <?php
        /*
     
         */
require_once '../../connection.php';

        $nazwa = $_POST['NazwaP'];

        $iloscSztuk = $_POST['iloscSztuk'];
        $opis = $_POST['opis'];
        $cena = $_POST['cena'];
        $kategoria = $_POST['kategoria'];
    //    $kategoria1 = $_POST['kategoria1'];

//Dodawanie Produktu
        $pdo->exec("INSERT INTO Produkt (Nazwa, iloscSztuk, Opis, Cena) VALUES ('$nazwa','$iloscSztuk','$opis','$cena')");
//Wydobywanie id nowo dodanego produktu
        $pr = $pdo->prepare("SELECT idProdukt FROM Produkt ORDER BY idProdukt DESC LIMIT 1");
        $pr->execute();

        $idPr = $pr->fetchColumn(0);


//Dodawanie Kategori do Produktu
        $pdo->exec("INSERT INTO Kategoria (NazwaK, Produkt_idProdukt) VALUES ('$kategoria','$idPr')");
        
////Dodawanie nowej kategori
//        if($kategoria1!=''){
//       
//            $pdo->exec("INSERT INTO Kategoria (NazwaK, Produkt_idProdukt) VALUES ('$kategoria1','$idPr')");
//         
//        }
//        

// Dodawanie istniejących grup do produktu

        $gru = $pdo->prepare("select * From GrupaProduktow");
        $gru->execute();
        
        
        $i = 1;
//
//  echo "<br>";
//            echo "<br>";

        
      $db = $pdo->prepare("SELECT idGrupaProduktow FROM ListaGrup ORDER BY idGrupaProduktow DESC LIMIT 1");
        $db->execute();  
         $idGR = $db->fetchColumn(0);
 
        
        for($i;$i<=$idGR;$i++){
        
    if (isset($_POST[$i])) {
       
               
          
                  echo '<br>'.$i;
              
                
                $pdo->exec("INSERT INTO ListaGrup (idProdukt, idGrupaProduktow) VALUES ('$idPr','$i')");

            
                //Przypisywanie grup do konkretnego produktu.
            
           
        }
        }
// Dodawanie Nie istniejącej grupy do bazy danych
// Przypisanei grupy do Produktu.
        $licz = $_POST['licz'];

        for ($k = 1; $k <= $licz; $k++) {

            $G = 'N' . $k;
            $GK = $_POST[$G];
            if ($GK != '') {
                echo $GK;
                //Dodawanie Nowej grupy do bazy danych    
                $pdo->exec("INSERT INTO GrupaProduktow (NazwaG) VALUES ('$GK')");
                //Pobieranie idGrupy nowo dodanej grupy
                $gr = $pdo->prepare("SELECT idGrupaProduktow FROM GrupaProduktow ORDER BY idGrupaProduktow DESC LIMIT 1");
                $gr->execute();
                $idGrP = $gr->fetchColumn(0);

//        //Dodanie Produktu do grupy.Lub Grupy do produktu.
                $pdo->exec("INSERT INTO ListaGrup (idProdukt, idGrupaProduktow) VALUES ('$idPr','$idGrP')");
            }
        }

        ?>       
Dodałeś nowy produkt: <br>
<?php
echo $nazwa."<br>";
echo "W ilości: ".$iloscSztuk; 
?>
    


    </body>
</html>
