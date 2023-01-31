<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Add Data Page</title>
    </head>

    <body>
        <?php include 'login.php'?>
        <!--Topbar Navigation Code-->
        <div class="topnav">
            <a class="button" href="index.php">db1u10</a>
            <div class="topnav-right">
                <a href="viewnav.php">Προβολή</a>
                <a href="addnav.php">Προσθήκη Εγγραφής</a>
                <a href="addfilenav.php">Προσθήκη Αρχείου</a>
                <a href="delnav.php">Διαγραφή Εγγραφής</a>
                <a href="settings.php">Ρυθμίσεις</a>
            </div>
        </div>
        <!--Topbar Navigation Code-->

        <h3>Προσθήκη Δεδομένων</h3>
        <h1>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
            Παρακαλώ συμπληρώστε όλα τα ακόλουθα πεδία.<br><br>

            ημερομηνία:
            <input type="date" name="ημερομηνία"></input><br>
            μέση_θερμοκρασία:
            <input type="number" step=any name="μέση_θερμοκρασία"></input><br>
            μέγιστη_θερμοκρασία:
            <input type="number" step=any name="μέγιστη_θερμοκρασία"></input><br>
            ελάχιστη_θερμοκρασία:
            <input type="number" step=any name="ελάχιστη_θερμοκρασία"></input><br>
            μέση_υγρασία:
            <input type="number" step=any name="μέση_υγρασία"></input><br>
            μέγιστη_υγρασία:
            <input type="number" step=any name="μέγιστη_υγρασία"></input><br>
            ελάχιστη_υγρασία:
            <input type="number" step=any name="ελάχιστη_υγρασία"></input><br>
            μέση_ατμοσφ_πίεση:
            <input type="number" step=any name="μέση_ατμοσφ_πίεση"></input><br>
            μέγιστη_ατμοσφ_πίεση:
            <input type="number" step=any name="μέγιστη_ατμοσφ_πίεση"></input><br>
            ελάχιστη_ατμοσφ_πίεση:
            <input type="number" step=any name="ελάχιστη_ατμοσφ_πίεση"></input><br>
            ημερήσια_βροχόπτωση:
            <input type="number" step=any name="ημερήσια_βροχόπτωση"></input><br>
            μέση_ταχύτητα_ανέμου:
            <input type="number" step=any name="μέση_ταχύτητα_ανέμου"></input><br>
            διευθ_ανέμου:
            <input type="text" name="διευθ_ανέμου"></input><br>
            μέγιστη_ριπή_ανέμου:
            <input type="number" step=any name="μέγιστη_ριπή_ανέμου"></input><br><br>
            Μετεορολογικός Σταθμός (συσχέτιση):
            <input type="text" step=any name="Σταθμός"></input><br>

            <button type="reset" value="reset" name="resetfields">Καθαρισμός Πεδίων</button>
            <input type="submit" value="Υποβολή" name="submit"></input>
        </h1>  
        <p style='color: red'>   
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['ημερομηνία'];
                $a2 = $_GET['μέση_θερμοκρασία'];
                $a3 = $_GET['μέγιστη_θερμοκρασία'];
                $a4 = $_GET['ελάχιστη_θερμοκρασία'];
                $a5 = $_GET['μέση_υγρασία'];
                $a6 = $_GET['μέγιστη_υγρασία'];
                $a7 = $_GET['ελάχιστη_υγρασία'];
                $a8 = $_GET['μέση_ατμοσφ_πίεση'];
                $a9 = $_GET['μέγιστη_ατμοσφ_πίεση'];
                $a10 = $_GET['ελάχιστη_ατμοσφ_πίεση'];
                $a11 = $_GET['ημερήσια_βροχόπτωση'];
                $a12 = $_GET['μέση_ταχύτητα_ανέμου'];
                $a13 = $_GET['διευθ_ανέμου'];
                $a14 = $_GET['μέγιστη_ριπή_ανέμου'];
                $a15 = $_GET['Σταθμός'];
                
                if($a1 && $a2 && $a3 && $a4 && $a5 && $a6 && $a7 && $a8 && $a9 && $a10 && $a11 && $a12 && $a13 && $a14) {  

                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Αποτυχία Σύνδεσης!");

                    $result = pg_query($link, "SELECT * FROM Μ_Δεδομένα WHERE ημερομηνία='$a1' AND μέση_θερμοκρασία=$a2 AND μέγιστη_θερμοκρασία=$a3 
                    AND ελάχιστη_θερμοκρασία=$a4 AND μέση_υγρασία=$a5 AND μέγιστη_υγρασία=$a6 AND ελάχιστη_υγρασία=$a7 AND μέση_ατμοσφ_πίεση=$a8 AND μέγιστη_ατμοσφ_πίεση=$a9 AND ελάχιστη_ατμοσφ_πίεση=$a10 AND ημερήσια_βροχόπτωση=$a11 AND μέση_ταχύτητα_ανέμου=$a12 AND διευθ_ανέμου='$a13' AND μέγιστη_ριπή_ανέμου=$a14;");
                    $rows = pg_num_rows($result);
                    if($rows>0)
                    {
                        echo "Το στοιχείο που επιχειρήσατε να προσθέσετε υπάρχει ήδη στη βάση!";
                    }
                    else{

                        if($a15)
                        {
                            //checking if station exists
                            $result = pg_query($link, "SELECT * FROM Μ_Σταθμοί WHERE όνομα_μετεωρ_σταθμού = '$a15';") or die("Αυτός ο Σταθμός δεν είναι διαθέσιμος!");
                            $rows = pg_num_rows($result);
                            if($rows>0) 
                            {
                                //finding stationID
                                $row = pg_fetch_array($result, 0);
                                $stationID = $row["id"];

                                //inserting data
                                $query = "INSERT INTO Μ_Δεδομένα(id, ημερομηνία, μέση_θερμοκρασία, μέγιστη_θερμοκρασία, ελάχιστη_θερμοκρασία, μέση_υγρασία, μέγιστη_υγρασία, ελάχιστη_υγρασία, μέση_ατμοσφ_πίεση, μέγιστη_ατμοσφ_πίεση, ελάχιστη_ατμοσφ_πίεση, ημερήσια_βροχόπτωση, μέση_ταχύτητα_ανέμου, διευθ_ανέμου, μέγιστη_ριπή_ανέμου) VALUES (default,'$a1',$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,'$a13',$a14);";
                                $result = pg_query($link, $query) or die("Αποτυχία προσθήκης στοιχείου!"); 

                                //finding dataID
                                $result = pg_query($link, "SELECT * FROM Μ_Δεδομένα WHERE ημερομηνία='$a1' AND μέση_θερμοκρασία=$a2 AND μέγιστη_θερμοκρασία=$a3 
                                AND ελάχιστη_θερμοκρασία=$a4 AND μέση_υγρασία=$a5 AND μέγιστη_υγρασία=$a6 AND ελάχιστη_υγρασία=$a7 AND μέση_ατμοσφ_πίεση=$a8 AND μέγιστη_ατμοσφ_πίεση=$a9 AND ελάχιστη_ατμοσφ_πίεση=$a10 AND ημερήσια_βροχόπτωση=$a11 AND μέση_ταχύτητα_ανέμου=$a12 AND διευθ_ανέμου='$a13' AND μέγιστη_ριπή_ανέμου=$a14;");
                                $row = pg_fetch_array($result, 0);
                                $dataID = $row["id"];

                                //inserting relation
                                $result = pg_query($link, "INSERT INTO KATAΓΡΑΦΕΣ (idΜΣ, idΜΔ) VALUES ($stationID, $dataID);");
                                echo "Το στοιχείο και η συσχέτισή του προστέθηκαν επιτυχώς.";
                            }
                        }
                        else
                        {
                            $query = "INSERT INTO Μ_Δεδομένα(id, ημερομηνία, μέση_θερμοκρασία, μέγιστη_θερμοκρασία, ελάχιστη_θερμοκρασία, μέση_υγρασία, μέγιστη_υγρασία, ελάχιστη_υγρασία, μέση_ατμοσφ_πίεση, μέγιστη_ατμοσφ_πίεση, ελάχιστη_ατμοσφ_πίεση, ημερήσια_βροχόπτωση, μέση_ταχύτητα_ανέμου, διευθ_ανέμου, μέγιστη_ριπή_ανέμου) VALUES (default,'$a1',$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,'$a13',$a14);";
                            $result = pg_query($link, $query) or die("Αποτυχία προσθήκης στοιχείου!\n"); 
                            echo "Το στοιχείο προστέθηκε επιτυχώς.";
                        }
                    }
                    pg_close($link);
                }
                else
                {
                    echo "Παρακαλώ συμπληρώστε όλα τα πεδία!\n";
                }
            }      
            clearstatcache();
        ?>
        </p>
    </body>
</html>