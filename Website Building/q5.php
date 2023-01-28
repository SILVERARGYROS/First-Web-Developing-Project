<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 View Fires Page</title>
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

        <h3>Ερώτημα Q5:<br>
        Να παρουσιάσετε τα ονόματα των μετεωρολογικών σταθμών που δυσλειτούργησαν έστω
        και μία φορά στη χρονιά X. Ως δυσλειτουργία ορίζεται η ύπαρξη καταγραφής τιμών NULL
        σε οποιοδήποτε όργανο του μετεωρολογικού σταθμού.
        </h3>   

        <h1>Παρακαλώ εισάγεται Χρονιά Χ:
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
                <input type="number" name="Χρονιά"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['Χρονιά'];
                if($a1)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT DISTINCT όνομα_μετεωρ_σταθμού
                    FROM   Μ_Σταθμοί, Μ_Δεδομένα, ΚΑΤΑΓΡΑΦΕΣ
                    WHERE  ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
                    AND    ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id 
                    AND    (Μ_Δεδομένα.ημερομηνία >= '$a1-01-01'
                    AND     Μ_Δεδομένα.ημερομηνία <= '$a1-12-31')
                    AND (Μ_Δεδομένα.μέση_θερμοκρασία IS NULL
                    OR Μ_Δεδομένα.μέγιστη_θερμοκρασία IS NULL 
                    OR Μ_Δεδομένα.ελάχιστη_θερμοκρασία IS NULL 
                    OR Μ_Δεδομένα.μέση_υγρασία IS NULL 
                    OR Μ_Δεδομένα.μέγιστη_υγρασία IS NULL
                    OR Μ_Δεδομένα.ελάχιστη_υγρασία IS NULL 
                    OR Μ_Δεδομένα.μέση_ατμοσφ_πίεση IS NULL
                    OR Μ_Δεδομένα.μέγιστη_ατμοσφ_πίεση IS NULL 
                    OR Μ_Δεδομένα.ελάχιστη_ατμοσφ_πίεση IS NULL
                    OR Μ_Δεδομένα.ημερήσια_βροχόπτωση IS NULL
                    OR Μ_Δεδομένα.μέση_ταχύτητα_ανέμου IS NULL
                    OR Μ_Δεδομένα.διευθ_ανέμου IS NULL
                    OR Μ_Δεδομένα.μέγιστη_ριπή_ανέμου IS NULL); ")
                    or die("Αποτυχία Προβολής\n");
    
                    $rows = pg_num_rows($result);
                }
                else
                {
                    echo "Παρακαλώ συμπληρώστε όλα τα πεδία!\n";
                }
            }
        ?>
        <table border="1">
            <tr>
                <th>όνομα_μετεωρ_σταθμού</th>
            </tr>
            <?php
                if(isset($_GET["submit"]))
                {
                    $a1 = $_GET['Χρονιά'];
                    if($a1)
                    {
                        // Loop on rows in the result set.
                        for($ri = 0; $ri < $rows; $ri++) {
                            echo "<tr>\n";
                            $row = pg_fetch_array($result, $ri);
                            echo "<td>", $row["όνομα_μετεωρ_σταθμού"], "</td>
                            </tr>
                            ";
                        }
                        pg_close($link);
                    }
                }
            ?>
    </table>
       
    </body>
</html>