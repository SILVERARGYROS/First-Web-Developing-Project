<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q10 Page</title>
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
        
        <h3>Ερώτημα Q10:<br>
        Για κάθε δήμο της περιφέρειας X, παρουσιάστε τη μέση θερμοκρασία, τη μέση υγρασία, την
        ταχύτητα και τη διεύθυνση του ανέμου, για την ημερομηνία Y</h3>

        <h1>Παρακαλώ εισάγεται όνομα περιφέρειας Χ
            και ημερομηνία Y:<br><br>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
                Περιφέρεια:<input type="text" name="περιφέρεια"></input><br>
                Ημερομηνία:<input type="date" name="ημερομηνία"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['περιφέρεια'];
                $a2 = $_GET['ημερομηνία'];
                if($a1 and $a2)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT Δήμοι.όνομα_Δήμου, Μ_Δεδομένα.μέση_θερμοκρασία, Μ_Δεδομένα.μέση_υγρασία, Μ_Δεδομένα.μέση_ταχύτητα_ανέμου, Μ_Δεδομένα.διευθ_ανέμου 
                    FROM   Δήμοι, Μ_Δεδομένα, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ
                    WHERE  Δήμοι.όνομα_περιφέριας = '$a1' 
                    AND    ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
                    AND    ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
                    AND    ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
                    AND    ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
                    AND    Μ_Δεδομένα.ημερομηνία = '$a2';")
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
                <th>όνομα_Δήμου</th>
                <th>μέση_θερμοκρασία</th>
                <th>μέση_υγρασία</th>
                <th>μέση_ταχύτητα_ανέμου</th>
                <th>διευθ_ανέμου</th>
            </tr>
            <?php
                if(isset($_GET["submit"]))
                {
                    $a1 = $_GET['περιφέρεια'];
                    $a2 = $_GET['ημερομηνία'];
                    if($a1 and $a2)
                    {
                        // Loop on rows in the result set.
                        for($ri = 0; $ri < $rows; $ri++) {
                            echo "<tr>\n";
                            $row = pg_fetch_array($result, $ri);
                            echo "<td>", $row["όνομα_Δήμου"], "</td>
                            <td>", $row["μέση_θερμοκρασία"], "</td>	
                            <td>", $row["μέση_υγρασία"], "</td>	
                            <td>", $row["μέση_ταχύτητα_ανέμου"], "</td>	
                            <td>", $row["διευθ_ανέμου"], "</td>	
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