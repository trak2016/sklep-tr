
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

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">Twój komputer</a>

                <div class="navbar-header">
                    <div class="btn-group">
                        <button type="button" class="navbar-toggle btn btn-default dropdown-toggle" data-toggle="collapse dropdown #bs-example-navbar-collapse-1">
                            <span class="sr-only">Rozwiń nawigację</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>    
                        </button>

                    </div>  
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">


                        <li>
                            <!--<a href="../Controller/koszyk.php">Koszyk</a>-->
                        </li>
                        <li>
                            <!--<a href="../Controller/logout.php">Wyloguj</a>-->
                        </li>
                    </ul>
                </div>
            </div>       

        </nav>



        <div class="container-fluid" style="margin-top: 50px">
            <?php
// Nawiązanie polaczenia z bazą danych.
            require_once '../../connection.php';

            session_start();

//
            if ($_GET['obud'] != NULL) {
                $_SESSION['obud'][] = $_GET['obud'];
                $_SESSION['plyta'][] = $_GET['plyta'];
                 
                $_SESSION['zasilacz'][] = $_GET['zasilacz'];
                $_SESSION['procesor'][] = $_GET['procesor'];
                 
                $_SESSION['pamiec'][] = $_GET['pam'];
                 
            }

            echo "Zawartość koszyka <br>";

            $ilosc = count($_SESSION['obud']);
            $cenaSum = 0;
            for ($n = 0; $n <count($_SESSION['obud']); $n++) {
                $cenaZestawu = 0;

                echo "<div class=\"panel panel-info\">";
                $obudo = $_SESSION['obud'][$n];
                if ($obudo) {
                    $db = $pdo->prepare("SELECT * FROM Produkt WHERE idProdukt = $obudo");
                    $db->execute();
                    // $obudo = $db->fetchColumn(1);
                    $row = $db->fetchAll();
                    foreach ($row as $obudo) {

                        $obudCe = $obudo['Cena'];
                        echo "<strong>Obudowa: </strong> " . $obudo['Nazwa'] . "<br>";
                    }
                    $cenaZestawu += $obudCe;
                }
//      
                $plyt = $_SESSION ['plyta'][$n];
                if ($plyt) {
                    $db = $pdo->prepare("SELECT * FROM Produkt WHERE idProdukt = $plyt");
                    $db->execute();
                    $row = $db->fetchAll();
                    foreach ($row as $plytG) {
                        $cenaPlGl = $plytG['Cena'];
                        echo "<strong>Płyta: </strong> " . $plytG['Nazwa'] . "<br> ";
                    }
                     $cenaZestawu +=  $cenaPlGl;
                }


                $zasilacz = $_SESSION['zasilacz'][$n];
                if ($zasilacz) {

                    $db = $pdo->prepare("SELECT * FROM Produkt WHERE idProdukt = $zasilacz");
                    $db->execute();
                    $row = $db->fetchAll();
                    foreach ($row as $Zasi) {
                        $cenaZas = $Zasi['Cena']; //Przepisywanie do zmiennej ceny wybranego zasilacza
                        echo "<strong>Zasilacz:  </strong>" . $Zasi['Nazwa'] . "<br>";
                    }
                     $cenaZestawu += $cenaZas;
                }


                $procesor = $_SESSION['procesor'][$n];
                if ($procesor) {

                    $db = $pdo->prepare("SELECT * FROM Produkt WHERE idProdukt = $procesor");
                    $db->execute();
                    $row= $db->fetchAll();
                    foreach ($row as $Proces) {
                        $cenaPro = $Proces['Cena'];
                        echo "<strong>Procesor:  </strong>" . $Proces['Nazwa'] . "<br> ";
                    }
                     $cenaZestawu += $cenaPro;
                }

                $pamiec = $_SESSION['pamiec'][$n];
                if ($pamiec) {

                    $db = $pdo->prepare("SELECT * FROM Produkt WHERE idProdukt = $pamiec");
                    $db->execute();
                    $row = $db->fetchAll();
                    //print_r($db);  
                    foreach ($row as $Pamie) {
                        $cenaPamiec = $Pamie['Cena'];
                        echo "<strong>Pamięć:  </strong>" . $Pamie['Nazwa'] . " <br> ";
                    }
                    $cenaZestawu +=  $cenaPamiec;
                }
                 echo"<div class=\"panel-footer\">". $cenaZestawu."zł</div>";
                echo"</div>";
               
                 $cenaSum += $cenaZestawu;
                   echo "<br>";
            }
            echo "<div style=\"text-align: right;  color: red; font-size: 20px;\">Suma : ". $cenaSum." zł</div>";
            echo"<br>";
            
            ?>


            <a href="resetKosz.php"> <button>Zresetuj Koszyk</button></a>

        </div>

    </body>
</html>



