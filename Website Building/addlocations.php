<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Add Location Page</title>
    </head>

    <body>
        <?php include 'login.php'?>
        <!--Topbar Navigation Code-->
        <div class="topnav">
            <a class="button" href="homePage.php">db1u10</a>
            <div class="topnav-right">
                <a href="viewnav.php">Προβολή</a>
                <a href="addnav.php">Προσθήκη Εγγραφής</a>
                <a href="delnav.php">Διαγραφή Εγγραφής</a>
                <a href="addallfiles.php">Προσθήκη Αρχείων</a>
                <a href="settings.php">Ρυθμίσεις</a>
            </div>
        </div>
        <!--Topbar Navigation Code-->

        <h3>Προσθήκη Δήμου</h3>
        <h1>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
            Παρακαλώ συμπληρώστε όλα τα ακόλουθα πεδία.<br><br>

            όνομα_περιφέριας:
            <input type="text" name="όνομα_περιφέριας"></input><br>
            όνομα_νομού:
            <input type="text" name="όνομα_νομού"></input><br>
            όνομα_Δήμου:
            <input type="text" name="όνομα_Δήμου"></input><br>
            γεωγ_πλάτος:
            <input type="number" step=any name="γεωγ_πλάτος"></input><br>
            γεωγ_μήκος:
            <input type="number" step=any name="γεωγ_μήκος"></input><br><br>
            Μετεορολογικός Σταθμός (συσχέτιση):
            <input type="text" step=any name="Σταθμός"></input><br>

            <button type="reset" value="reset" name="resetfields">Καθαρισμός Πεδίων</button>
            <input type="submit" value="Υποβολή" name="submit"></input>
        </h1>  
        <p style='color: red'>   
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['όνομα_περιφέριας'];
                $a2 = $_GET['όνομα_νομού'];
                $a3 = $_GET['όνομα_Δήμου'];
                $a4 = $_GET['γεωγ_πλάτος'];
                $a5 = $_GET['γεωγ_μήκος'];
                $a6 = $_GET['Σταθμός'];

                if($a1 && $a2 && $a3 && $a4 && $a5) {  

                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                    or die ("Αποτυχία Σύνδεσης!");

                    $result = pg_query($link, "SELECT * FROM Δήμοι WHERE όνομα_περιφέριας='$a1' AND όνομα_νομού='$a2' AND όνομα_Δήμου='$a3' 
                    AND γεωγ_πλάτος=$a4 AND γεωγ_μήκος=$a5;");
                    $rows = pg_num_rows($result);
                    if($rows>0)
                    {
                        echo "Το στοιχείο που επιχειρήσατε να προσθέσετε υπάρχει ήδη στη βάση!";
                    }
                    else
                    {
                        if($a6)
                        {
                            //checking if station exists
                            $result = pg_query($link, "SELECT * FROM Μ_Σταθμοί WHERE όνομα_μετεωρ_σταθμού = '$a6';") or die("Αυτός ο Σταθμός δεν είναι διαθέσιμος!");
                            $rows = pg_num_rows($result);
                            if($rows>0) 
                            {
                                //finding stationID
                                $row = pg_fetch_array($result, 0);
                                $stationID = $row["id"];

                                //inserting location
                                $query = "INSERT INTO Δήμοι(id, όνομα_περιφέριας, όνομα_νομού, όνομα_Δήμου, γεωγ_πλάτος, γεωγ_μήκος) VALUES (default,'$a1','$a2','$a3',$a4,$a5);";
                                $result = pg_query($link, $query) or die("Αποτυχία προσθήκης στοιχείου!"); 

                                //finding locationID
                                $result = pg_query($link, "SELECT * FROM Δήμοι WHERE όνομα_περιφέριας='$a1' AND όνομα_νομού='$a2' AND όνομα_Δήμου='$a3' 
                                AND γεωγ_πλάτος=$a4 AND γεωγ_μήκος=$a5;");
                                $row = pg_fetch_array($result, 0);
                                $locationID = $row["id"];

                                //inserting relation
                                $result = pg_query($link, "INSERT INTO ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ (idΜΣ, idΔήμοι) VALUES ($stationID, $locationID);");
                                echo "Το στοιχείο και η συσχέτισή του προστέθηκαν επιτυχώς.";
                            }
                        }
                        else
                        {
                            $query = "INSERT INTO Δήμοι(id, όνομα_περιφέριας, όνομα_νομού, όνομα_Δήμου, γεωγ_πλάτος, γεωγ_μήκος) VALUES (default,'$a1','$a2','$a3',$a4,$a5);";
                            $result = pg_query($link, $query) or die("Αποτυχία προσθήκης στοιχείου!"); 
                            echo "Το στοιχείο προστέθηκε επιτυχώς.";
                        }
                    }
                    pg_close($link);
                }
                else
                {
                    echo "Παρακαλώ συμπληρώστε όλα τα απαραίτητα πεδία!\n";
                }
            }      
            clearstatcache();
        ?>
        </p>
    </body>
</html>